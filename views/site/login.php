<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <!--<h1><?= Html::encode($this->title) ?></h1>!-->

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'method' => 'post',
        'fieldConfig' => [
            'template' => "<div class='col-md-3'>{label}</div>
                           <div class=\"col-md-8 col-md-offset-1\">{input}</div>
                           <div class='col-md-12'>{error}</div> ",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <div class="container">
        <div class="row centerd-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Let your adventure begin!</h3>
                    </div>
                    <div class="panel-body bg-color">
                        <div class="form-horizontal">

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'username..']); ?>

                            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'password..']); ?>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <?= Html::submitButton('Log In!',
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
