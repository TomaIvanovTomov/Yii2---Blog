<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\UsersMessages */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

//$this->title = 'Contact';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

        <div class="container">
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            <h3 class="panel-title">
                                <em>Find us at:</em>
                            </h3>
                        </div>
                        <div class="panel-body body-color">
                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-xs-offset-2 col-sm-offset-2 col-md-offset-2">
                                        <label>
                                            <h4 class="text-left">Phone:</h4>
                                        </label>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                        <label>
                                            <h4 class="text-danger"><em>0888/ 888 888</em></h4>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-xs-offset-2 col-sm-offset-2 col-md-offset-2">
                                        <label>
                                            <h4 class="text-left">Email:</h4>
                                        </label>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                        <label>
                                            <h4 class="text-danger"><em>letsblog@gmail.com</em></h4>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-xs-offset-2 col-sm-offset-2 col-md-offset-2">
                                        <label>
                                            <h4 class="text-left">Facebook</h4>
                                        </label>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                        <label>
                                            <a href="https://www.facebook.com/toma.tomov.37"><h4 class="text-danger"><em>click!</em></h4></a>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-xs-offset-2 col-sm-offset-2 col-md-offset-2">
                                        <label>
                                            <h4 class="text-left">Skype:</h4>
                                        </label>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                                        <label>
                                            <h4 class="text-danger"><em>lets_blog</em></h4>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <?php $form = ActiveForm::begin([
                        'id' => 'contact-form',
                        'method' => 'post',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                                'template' => "<div class='col-md-3'>{label}</div>
                                               <div class='col-md-9'>{input}</div>
                                               <div class='col-md-9 col-md-offset-3'>{error}</div>"
                        ]
                    ]);
                ?>

                <div class="col-xs-5 col-sm-5 col-md-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><em>Tell us, what is bodering you</em></h3>
                        </div>
                        <div class="panel-body body-color">
                            <fieldset>
                                <div class="row">

                                    <div class="col-md-12">
                                        <?= $form->field($model, 'message_author')->textInput(['class' => 'form-control',
                                            'autofocus' => true,
                                            'placeholder' => 'name..']); ?>
                                    </div>

                                    <div class="col-md-12">
                                        <?= $form->field($model, 'author_email')->textInput(['class' => 'form-control',
                                            'title' => 'How can we reach you :)(Email)',
                                            'placeholder' => 'email..']); ?>
                                    </div>

                                    <div class="col-md-12">
                                        <?= $form->field($model, 'message_title')->textInput(['class' => 'form-control',
                                            'placeholder' => 'title..']); ?>
                                    </div>

                                    <div class="col-md-12">
                                        <?= $form->field($model, 'message_content')->textarea(['class' => 'form-control',
                                            'rows' => 6 ]); ?>
                                    </div>

                                </div>

                                <?php if(\Yii::$app->session->hasFlash('messageSubmited')): ?>

                                    <h3 class="text-center"><strong>Thank you, for your feedback!</strong></h3>

                                <?php endif; ?>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <?= Html::submitButton('Send',
                                            [
                                                'class' => 'btn btn-success form-control',
                                                'name' => 'send_message'
                                            ]);
                                        ?>
                                    </div>
                                </div>

                            </fieldset>
                        </div>
                    </div>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
</div>
