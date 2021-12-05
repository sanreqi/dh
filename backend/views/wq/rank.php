<?php
/* @var $this \yii\web\View */
/* @var $number */
/* @var $qi */
$this->title = '围棋排列计算';
?>

<div class="modal fade" id="wq-blacklist-modal" tabindex="-1" aria-labelledby="wq-blacklist-modal-label" aria-hidden="true">

</div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="number" value="<?= $number; ?>" placeholder="数量">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-2">搜索</button>
    </div>
</form>

<?php !empty($number) && $qi->run(); ?>

