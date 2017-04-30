<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

//$this->title = "Welcome to your profile, " . ucfirst(\Yii::$app->user->identity->username) . "!";

?>

<div class="user-profile">

    <div class="container">
        <div class="row">

            <div class="col-md-6">

                <div class="col-md-2 profile-picture">

                    <?= Html::img("../images/" . Html::encode($model->image), ['alt'=>'profile', 'class'=>'wide']); ?>

                </div>
                    <?php
                    $roleArray = \Yii::$app->authManager->getRolesByUser($model->id);

                    $role = [];

                    foreach ($roleArray as $k => $value){
                        $role[] = $value;
                    }

                    if($role[0]->name == 'admin'):
                    ?>

                <div class="col-md-6 col-md-offset-1 admin-menu text-center">

                    <div class="menu-head">
                        <h2><strong>Menu</strong></h2>
                    </div>

                    <ul class="menu-options">
                        <li>
                            <strong>Messages</strong>
                        </li>
                        <li>
                            <?= Html::a('<strong>Users List</strong>', 'users-list', ['style' => 'color: black; text-decoration: none;']) ?>
                        </li>
                    </ul>
                </div>
                <?php
                Modal::begin([
                    'header' => '<h2><em>Messages</em></h2>',
                    'headerOptions' => [
                        'class' => 'text-center',
                    ],
                    'id' => 'modal',
                    'size' => 'modal-md',
                ]);

                echo "<div class='content-container' id='userMessages' style='border: 1px solid black'>";
                if(\app\controllers\UserController::getMessages())
                {
                    $messages = \app\controllers\UserController::getMessages();

                    echo "<table class='table table-responsive'>
                                  <thead class='text-center thead-style'>
                                        <td>Title</td>
                                        <td>Author</td>
                                        <td>View</td>
                                  </thead>";

                    foreach ($messages as $message)
                    {
                        echo "<tr>
                                        <td class='text-center'>". $message['message_title'] ."</td>
                                        <td class='text-center'>". $message['message_author'] ."</td>
                                        <td class='text-center'>" . Html::a('<span class=\'glyphicon glyphicon-eye-open\'></span>',
                                ['#'],
                                ['class' => 'view-message',
                                    'data-id' => $message['message_id']]),
                            Html::a('<span class="glyphicon glyphicon-remove"></span>',
                                ['delete-message'],
                                ['class' => 'remove-message',
                                    'data-id' => $message['message_id']])
                            . "</td>
                                      </tr>";
                    }

                    $this->registerJs(
                        "$('.view-message').on('click', function(){
                                        
                                        event.preventDefault();
                                        
                                        var id = $(this).attr('data-id');
                                        
                                        $.ajax({
                                            url : '" . \yii\helpers\Url::to(["message"]) . "?id='+id,
                                            cache : false,
                                            success : function ( data ){
                                                $('#userMessages').html( data );
                                            }
                                        });
                                        
                                    });
                                    
                                    $('.remove-message').on('click', function(){
                                        
                                        event.preventDefault();
                                        
                                        var answer = confirm('Are you sure you want to delete this message?');
                                        
                                        var currMsg = $(this);
                                        
                                        var id = currMsg.attr('data-id');
                                         
                                         if(answer){
                                            $.ajax({
                                                type : 'POST',
                                                url : '" . \yii\helpers\Url::to(["delete-message"]) . "?id='+id,
                                                cache : false,
                                                success : function(callback){
                                                     currMsg.parent().parent().remove();
                                                 }
                                            });
                                         }
                                          
                                    });"
                    );

                    echo "</table>";
                }
                echo "</div>";

                Modal::end();
                ?>

                <?php endif; ?>

            </div>

            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title text-center">
                            <h3>Welcome,  <?= ucfirst(Html::encode(\Yii::$app->user->identity->username)); ?>!</h3>
                        </div>
                    </div>
                    <div class="panel-body" style="background-color: lightgrey; height: 180px;">
                        <table class="table">
                            <tbody>
                                <tr class="active">
                                    <td>
                                        <p class="text-center"><strong>Username:</strong></p>
                                    </td>
                                    <td>
                                        <p class="text-center"><?= Html::label(\Yii::$app->user->identity->username); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-center"><strong>Email:</strong></p>
                                    </td>
                                    <td>
                                        <p class="text-center"><?= Html::label(\Yii::$app->user->identity->email); ?></p>
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        <p class="text-center"><strong>Posts Number:<strong></p>
                                    </td>
                                    <td>
                                        <p class="text-center"><?= \app\controllers\UserController::numberOfPosts(); ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        <div class="panel-footer" style="background-color: royalblue">
                            <?= Html::a("Update", 'update', ['class' => 'btn btn-success']); ?>
                            <?=
                                Html::a("Delete", ['delete', 'id' => \Yii::$app->user->identity->id],
                                                  [
                                                          'data-method' => 'POST',
                                                          'class' => 'btn btn-danger',
                                                          'data' =>
                                                          [
                                                                'confirm' => 'Are you sure? Your profile will be deleted permanently!'
                                                          ]
                                                  ]);
                            ?>
                        </div>
                </div>

                <div class="col-md-12 posts-info">
                    <div class="panel panel-primary">
                        <div class="panel panel-heading text-center">
                            <h2>Your posts</h2>
                        </div>
                        <div class="panel-body-class">
                            <?php
                            $userPosts = \app\controllers\UserController::userPosts();

                            foreach ($userPosts as $post)
                            {
                                echo "<table class='table-posts'>
                                                <tr>
                                                    <td>" . Html::a($post['title'],
                                                                    ['post/view', 'id' => $post['post_id']],
                                                                    ['style' => 'text-decoration: none']) . "</td>
                                                    <td>" . $post['date_create'] . "</td>
                                                </tr>
                                           </table>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>