<?php

use yii\helpers\Html;
use app\models\BlogUser;
use app\controllers\PostController;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php foreach ($comments as $comment): ?>
                <div class='col-md-3 post-prof-img'>
                    <?php
                        $currUser = BlogUser::find()->where(['id' => $comment['author_id']])->one();

                        $commentID = $comment['comment_id'];

                        $likes = \Yii::$app->db->createCommand("SELECT COUNT(*)
                                                                    FROM likes
                                                                    WHERE comment_id=$commentID")->queryScalar();

                        $dislikes = \Yii::$app->db->createCommand("SELECT COUNT(*)
                                                                    FROM dislikes
                                                                    WHERE comment_id=$commentID")->queryScalar();
                    ?>
                    <?= Html::img('../images/' . $currUser->image, ['class' => 'tall img-circle']) ?>
                    <p class="text-center title-par">
                        <em><strong><?= $currUser->username ?></strong></em>
                    </p>
                </div>
                <div class='col-md-9 col-md-offset-1'>
                    <div class='post-comment'>
                        <p><em><?= $comment['comment_content'] ?></em></p>
                    </div>
                    <div class='comment-options'>
                        <div class='col-md-8'>
                         <?php
                             if(\Yii::$app->user->identity->id == $comment['author_id'] || PostController::isAdmin())
                             {
                                 echo Html::a('Edit',['update-comment', 'id' => $comment['comment_id']]);
                                 echo Html::a('Delete',
                                     ['delete-comment', 'id' => $comment['comment_id']],
                                     ['data' => [
                                                 'confirm' => 'Are you sure?',
                                                 'method' => 'POST'
                                                ]
                                     ]);
                             }
                             echo Html::a('Like',[''],
                                            ['class' => 'like_up',
                                             'data_id' => $comment['comment_id'],
                                             'data_status' => 'like',
                                             'data_flag' => 0]);

                             echo Html::a('Dislike', [''],
                                            ['class' => 'dislike_up',
                                             'data_id' => $comment['comment_id'],
                                             'data_status' => 'dislike',
                                             'data_flag' => 0]);
                          ?>
                        </div>
                        <div class='col-md-4 text-right'>
                            <div class="ajax-helper">
                                <span class='glyphicon glyphicon-hand-up style-vote-up'></span>
                                <span id="likes-<?= $comment['comment_id'] ?>" ><?= $likes ?></span>
                                <span class='glyphicon glyphicon-hand-down style-vote-down'></span>
                                <span id="dislikes-<?= $comment['comment_id'] ?>" ><?= $dislikes ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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
                                $('#likes-'+id).html( data );
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
                                $('#dislikes-'+id).html( data );
                            }
                        });
                    });
                ");
            ?>
        </div>
        <div>
            <?= Html::a('Add Comment', ['create-comment', 'id' => $_GET['id']],['class' => 'btn btn-primary add-comment','style'=>'margin-top: 2%']) ?>
            <?= Html::a('Back', ['view', 'id' => $_GET['id']],['class' => 'btn btn-warning', 'style'=>'margin-top: 2%; float: right']) ?>
        </div>
    </div>
</div>