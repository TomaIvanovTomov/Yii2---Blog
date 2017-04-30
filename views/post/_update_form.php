<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'fieldConfig' => [
            'template' => "<div class='col-md-12'>{label}{input}</div>
                               <div class='col-md-12'>{error}</div>",
        ]
    ]); ?>

    <div class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title text-center">
                            <em>Update your post</em>
                        </div>
                    </div>
                    <div class="panel-body bg-color" style="padding-top: 0;">
                        <div class="form-group">
                            <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'content')->textarea(['rows' => '10', 'style' => 'text-align: justify']) ?>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <?= Html::submitButton('Update', ['class' => 'btn btn-primary form-control']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
