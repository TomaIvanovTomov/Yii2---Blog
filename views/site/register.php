<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "Register";
?>

<div class="site-register">
    <?php Html::encode($this->title); ?>

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'id' => 'register-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class='col-md-3'>{label}</div>
                           <div class='col-md-8 col-md-offset-1'>{input}</div>
                           \n<div class='col-md-12'>{error}</div> "
        ]
    ]);
    ?>

    <div class="container">
        <div class="row centerd-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Registration for Let`s Blog!</h3>
                    </div>
                    <div class="panel-body bg-color">
                        <div class="form-horizontal">
                            <fieldset>

                                <?= $form->field($model, 'username')->textInput(
                                        [
                                                'autofocus' => true,
                                                'placeholder'=>'username..'
                                        ]
                                ); ?>

                                <?= $form->field($model, 'email')->textInput(['placeholder'=>'email..']); ?>

                                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'password..']) ?>

                                <?= $form->field($model, 'repeat_password')->passwordInput(['placeholder'=>'repeat password..']) ?>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <?= Html::submitButton('Register',
                                            [
                                                'class' => 'btn btn-success form-control',
                                                'name' => 'register-button'
                                            ]);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
