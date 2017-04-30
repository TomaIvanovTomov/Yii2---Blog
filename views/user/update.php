<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//$this->title = "Update Information";

/* @var $this yii\web\View */
/* @var $model app\models\BlogUser */
/* @var $form ActiveForm */
?>
<div class="user-update">

    <?php $form = ActiveForm::begin([
            'enableAjaxValidation' => true,
            'method' => 'post',
            'fieldConfig' => [
                    'template' => "<div class='col-md-3'>{label}</div>
                                   <div class='col-md-9'>{input}</div>
                                   <div class='col-md-12'>{error}</div>",
                    'labelOptions' => ['class' => 'control-label'],
            ]
    ]); ?>

    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body body-color">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="col-md-7 col-md-offset-1 resize-label-input">
                            <div class="form-group">
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control'])->label('Username:');?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'email')->textInput(['class' => 'form-control'])->label('Email:');?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control'])->label('Password:');?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= Html::submitButton('Update', ['class' => 'btn btn-primary resize-btn']); ?>
                            </div>
                            <div class="form-group">
                                <?= Html::a('Update Image', 'update-image', ['class' => 'btn btn-success resize-btn']); ?>
                            </div>
                            <div class="form-group">
                                <?= Html::a('Back', 'view', ['class' => 'btn btn-danger resize-btn']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- user-update -->
