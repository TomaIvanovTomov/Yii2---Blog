<?php

namespace app\Controllers;

use Yii;

class RbacController extends \yii\web\Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "updatePost" permission
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = 'Update post';
        $auth->add($deletePost);

        // add "author" role and give this role the "createPost" permission
        $user = $auth->createRole('user');
        $auth->add($user);
        $user->type = '2';
        $auth->addChild($user, $createPost);
        $auth->addChild($user, $updatePost);
        $auth->addChild($user, $deletePost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);

       // //add create rule for updateOwnPost
       // $rule = new AuthorRule();
       // $auth->add($rule);
//
       // //add "updateOwnPost" permission
       // $updateOwnPost = $auth->createPermission('updateOwnPost');
       // $updateOwnPost->description = 'Update Own Post';
       // $auth->add($updateOwnPost);
       // $updateOwnPost->ruleName = $rule->name;
       // $auth->add($updateOwnPost);
//
       // $auth->addChild($updateOwnPost, $updatePost);
       // $auth->addChild($updateOwnPost, $deletePost);
//
       // $auth->addChild($user, $updateOwnPost);

    }
}
