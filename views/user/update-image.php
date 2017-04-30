<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Update Image";
/* @var $this yii\web\View */
/* @var $model app\models\BlogUser */
/* @var $form ActiveForm */
?>
<div class="user-update">

    <?= Html::encode($this->title); ?>

    <?php $form = ActiveForm::begin([
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'image')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Back', 'update', ['class' => 'btn btn-danger']); ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-update -->
