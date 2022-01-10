<?php
namespace common\models;

use common\behaviors\LogBehavior;
use common\helper\Tools;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string truename
 * @property string mobile
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property integer $is_delete
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
//            LogBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['username'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE, 'is_delete' => Constants::IS_DELETE_NO]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function search($params, $count = false) {
        $query = new Query();
        $query->from('user')->where(['status' => self::STATUS_ACTIVE]);
        //keywords
        if (isset($params['username']) & !empty($params['username'])) {
            $query->andWhere(['like', 'username', $params['username']]);
        }

        if ($count) {
            return $query->count();
        }

        Tools::constructPage($query, $params);
        return $query->all();
    }

    public static function findByIdAttr($id, $attribute) {
        if (empty($id)) {
            return '';
        }
        $user = User::find()->where(['id' => $id])->one();
        if (empty($user)) {
            return '';
        }
        return $user->hasAttribute($attribute) ? $user->getAttribute($attribute) : '';
    }

    /**
     * 同步user表数据到user_info表
     */
    public function syncUserToInfo() {
        $userInfo = UserInfo::find()->where(['uid' => $this->id])->one();
        if (!empty($userInfo)) {
            //已经存在
            return false;
        }

        $model = new UserInfo();
        $model->uid = $this->id;
        !empty($this->truename) && $model->truename = $this->truename;
        !empty($this->mobile) && $model->mobile = $this->mobile;
        return $model->save();
    }

    public function saveDetailBasic($post) {
        $userInfo = UserInfo::find()->where(['uid' => $this->id])->one();
        if (empty($userInfo)) {
            //做兼容
            $this->syncUserToInfo();
        }
        $transaction = Yii::$app->db->beginTransaction();
        $this->truename = trim($post['truename']);
        $userInfo->truename = trim($post['truename']);

        if (isset($post['identity_card']) && !empty(trim($post['identity_card']))) {
            $identityCard = trim($post['identity_card']);
            $idInfo = Tools::getInfoByIdentity($identityCard);
            if (!empty($idInfo)) {
                //优先用身份证匹配的出生日期和性别
                $userInfo->identity_card = $identityCard;
                $userInfo->gender = $idInfo['gender'];
                $userInfo->birth_date = $idInfo['birth_date'];
            }
        }
        //身份证未能匹配
        if (!isset($idInfo) || $idInfo === false) {
            if (isset($post['gender']) && $post['gender'] !== NULL) {
                $userInfo->gender = $post['gender'];
            }
            if (isset($post['birth_date']) && !empty($post['birth_date'])) {
                $userInfo->birth_date = $post['birth_date'];
            }
        }

        try {
            if ($this->save() && $userInfo->save()) {
                $transaction->commit();
                return true;
            } else {
                $transaction->rollBack();
                return false;
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }
}
