<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

?>
<div class="post-view">

    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="full-post-image">
                    <?= Html::img('../images/' . Html::encode($author->image), ['class' => 'img-thumbnail']) ?>
                </div>
                <div class="text-center post-author-info">
                    <?= Html::encode($author->username) ?>
                </div>
                <div class="text-center post-author-info">
                    <?= Html::encode($model->date_create) ?>
                </div>
                <div class="text-center post-author-info">
                    <?= Html::encode($author->email) ?>
                </div>
                <div class="text-center post-author-info">
                    <?= $tags ?>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                <div class="full-post-content">
                    <div class="panel-heading panel-primary text-center style-title">
                        <?= Html::encode($model->title); ?>
                    </div>
                    <div id="full-post-content"">
                        <?= Html::encode($model->content); ?>
                    </div>
                    <div class="panel-footer panel-primary full-cont-footer">
                        <div class="row btns-row">

                            <?php $form = \yii\bootstrap\ActiveForm::begin([
                                'method' => 'post'
                            ]);
                            ?>

                                <div class="col-md-8 text-left">
                                    <div class="btn-holder">
                                        <?php
                                        if(\app\controllers\PostController::isAdmin() || \Yii::$app->user->identity->id == Html::encode($model->user_id))
                                        {
                                            echo Html::a('Edit', ['update', 'id' => Html::encode($model->post_id)],
                                                ['class' => 'btn btn-primary']);

                                            echo Html::a('Delete', ['delete', 'id' => Html::encode($model->post_id)],
                                                ['data-method' => 'POST', 'class' => 'btn btn-danger']);
                                        }
                                        else
                                        {
                                            echo Html::a('Edit', ['update', 'id' => Html::encode($model->post_id)],
                                                ['class' => 'btn btn-primary btn-restrict']);

                                            echo Html::a('Delete', ['delete', 'id' => Html::encode($model->post_id)],
                                                ['class' => 'btn btn-danger btn-restrict']);
                                        }

                                        echo Html::a('Comments [' . count($postCount) . ']', ['comments', 'id' => Html::encode($model->post_id)],
                                            ['class' => 'btn btn-success']);
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-4 text-right">

                                    <?= Html::a('<span class="glyphicon glyphicon-thumbs-up style-vote-up" ></span>',[''],
                                            ['class' => 'like_up',
                                             'data_id' => $model['post_id'],
                                             'data_status' => 'like',
                                             'data_flag' => 1]) ?>

                                    <span id="likes"><?= count($likesCount) ?></span>

                                    <?= Html::a('<span class="glyphicon glyphicon-thumbs-down style-vote-down"></span>',[''],
                                            ['class' => 'dislike_up',
                                            'data_id' => $model['post_id'],
                                            'data_status' => 'dislike',
                                            'data_flag' => 1]) ?>

                                    <span id="dislikes"><?= count($dislikesCount) ?></span>

                                    <?= Html::a('Back', 'index', ['class' => 'btn btn-warning']); ?>

                                </div>

                            <?php \yii\bootstrap\ActiveForm::end(); ?>
                            <?php
                                $this->registerJs("
                                    $('.like_up').on('click', function(event){
                                        event.preventDefault();
                                        var id = $(this).attr('data_id');
                                        var status = $(this).attr('data_status');
                                        var flag = $(this).attr('data_flag');
                                        $.ajax({
                                            url : '".\yii\helpers\Url::to(['feedback'])."?target_id='+id+'&status='+status+'&flag='+flag,
                                            cache : false,
                                            success : function( data ){
                                                $('#likes').html( data );
                                            }
                                        });
                                    });
                                    
                                    $('.dislike_up').on('click', function(event){
                                        event.preventDefault();
                                        var id = $(this).attr('data_id');
                                        var status = $(this).attr('data_status');
                                        var flag = $(this).attr('data_flag');
                                        $.ajax({
                                            url : '".\yii\helpers\Url::to(['feedback'])."?target_id='+id+'&status='+status+'&flag='+flag,
                                            cache : false,
                                            success : function( data ){
                                                $('#dislikes').html( data );
                                            }
                                        });
                                    });
                                ");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
