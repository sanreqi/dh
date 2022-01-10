<?php

namespace common\models;

use common\helper\Tools;
use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property int $uid
 * @property int $mobile
 * @property string $truename
 * @property string $identity_card
 * @property int $gender
 * @property string|null $birth_date
 * @property string $address
 * @property string|null $gradute_date
 * @property string $gradute_school
 * @property int $created_at
 * @property int $updated_at
 */
class UserInfo extends \yii\db\ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER_UNKNOWN = 3;

    public static function getGenderList() {
        return [
            self::GENDER_MALE => '男',
            self::GENDER_FEMALE => '女',
            self::GENDER_UNKNOWN => '未知',
        ];
    }

    public static function getGenderByKey($key) {
        $result = '';
        $list = self::getGenderList();
        if (array_key_exists($key, $list)) {
            $result = $list[$key];
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mobile', 'gender', 'created_at', 'updated_at'], 'integer'],
            [['birth_date', 'gradute_date'], 'safe'],
            [['truename', 'identity_card', 'gradute_school'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'mobile' => 'Mobile',
            'truename' => 'Truename',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date',
            'address' => 'Address',
            'gradute_date' => 'Gradute Date',
            'gradute_school' => 'Gradute School',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        if (!empty($this->birth_date)) {
            $this->birth_date = date('Y-m-d', strtotime($this->birth_date));
        }
    }

    public function setInfoByIdentityCard() {
        if (!empty($this->identity_card)) {
             $info = Tools::getInfoByIdentity($this->identity_card);
             if (!empty($info)) {
                 $this->birth_date = $info['birth_date'];
                 $this->gender = $info['gender'];
             }
        }
    }
}
