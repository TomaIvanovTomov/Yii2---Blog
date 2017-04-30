<?php
use \yii\helpers\Html;
?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="users-table">
                <?php
                    foreach ($usersList as $user) {
                        echo "<tr class='data-row'>
                                <td>".$user->username."</td>
                                <td>".$user->email."</td>
                                <td class='text-center'>". \Yii::$app->db->createCommand("SELECT item_name 
                                                                              FROM auth_assignment
                                                                              WHERE user_id=$user->id")->queryScalar()
                                ."</td>
                                <td class='view-profile-datacell'>".
                                    \Yii::$app->db->createCommand("SELECT COUNT(*) FROM posts WHERE user_id=$user->id")->queryScalar()
                                ."</td>
                                <td>".
                                      Html::a('<span class="glyphicon glyphicon-remove-circle">',
                                                                ['delete-user', 'id' => $user->id],
                                                                ['data' => [
                                                                        'confirm' => 'Delete this user permanently ?',
                                                                        'method' => 'post']
                                                                ])
                                ."</td>
                              </tr>";
                    }
                ?>

            </table>
        </div>
        <div class="col-md-1">
            <?= Html::a('Back',['view'],['class' => 'btn btn-warning']) ?>
        </div>
    </div>
</div>