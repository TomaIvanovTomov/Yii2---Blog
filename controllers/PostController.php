<?php

namespace app\controllers;

use app\models\BlogUser;
use app\models\PostComment;
use app\models\Tag;
use Yii;
use app\models\Post;
use app\models\PostSearch;
use yii\data\Pagination;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],

            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete', 'index', 'view', 'comments', 'feedback', 'search-post', 'integrate-tags', 'search-tag'],
                'rules' => [
                    [
                        'actions' => ['update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($role, $action)
                                           {
                                               if($this->isAdmin())
                                               {
                                                   return true;
                                               }

                                               if($this->isAuthor())
                                               {
                                                    return true;
                                               }

                                               return $this->redirect(['../site/error','405','You do not have permission for this action!']);
                                           }
                    ],
                    [
                        'actions' => ['create', 'comments'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['index', 'view', 'feedback', 'search-post', 'integrate-tags', 'search-tag'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
        ];
    }

    public function isAuthor()
    {
        $userId = \Yii::$app->user->identity->id;
        $post = $this->findModel(\Yii::$app->request->get('id'));

        return $userId == $post->user_id;
    }

    public static function isAdmin()
    {
        $userId = \Yii::$app->user->identity->id;
        $role = \Yii::$app->db->createCommand("SELECT item_name FROM auth_assignment WHERE user_id=$userId")->queryScalar();

        return $role == 'admin';
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $postModel = new \app\models\Post();
        $userModel = new \app\models\BlogUser();

        $posts = $postModel::find()->orderBy(['post_id' => SORT_DESC])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'postModel' => $postModel,
            'userModel' => $userModel,
            'posts' => $posts,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $postModel = Post::find()->where(['post_id' => $id])->one();

        $currUser = BlogUser::find()->where(['id' => $postModel->user_id])->one();

        $postCommentsCount = (new Query())->select('*')
                                            ->from('post_comments')
                                            ->where(['post_id' => $postModel->post_id])
                                            ->all();

        $likesCount = (new Query())->select('*')
                                    ->from('likes')
                                    ->where(['post_id' => $postModel->post_id])
                                    ->all();

        $dislikesCount = (new Query())->select('*')
                                        ->from('dislikes')
                                        ->where(['post_id' => $postModel->post_id])
                                        ->all();

        $tags = $this->tagPostRelations($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'author' => $currUser,
            'postCount' => $postCommentsCount,
            'likesCount' => $likesCount,
            'dislikesCount' => $dislikesCount,
            'tags' => $tags
        ]);
    }

    private function tagPostRelations($post_id)
    {
        $tagPostRelation = (new Query())->select('tag_id')
            ->from('tagpostrelation')
            ->where(['post_id' => $post_id])
            ->all();

        $tags = [];

        foreach ($tagPostRelation as $tag) {
            $tag_name = (new Query())->select('tag_name')
                                    ->from('tags')
                                    ->where(['tag_id' => $tag['tag_id']])
                                    ->one();
            $tags[] = $tag_name;
        }

        $outputString = [];

        foreach ($tags as $tag) {
            $outputString[] = $tag['tag_name'];
        }

        return implode(', ', $outputString);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $id = \Yii::$app->user->identity->id;
        $ddItems = ArrayHelper::map(Tag::find()->all(),'tag_id', 'tag_name');

        if ($model->load(Yii::$app->request->post())) {

            date_default_timezone_set('Europe/Berlin');

            $model->user_id = $id;
            $model->date_create = date('m/d/Y');

            if($model->save())
            {
                $tags = $this->getTags();

                foreach ($tags as $tag)
                {
                    $tag_id = $this->getTagId($tag);
                    \Yii::$app->db->createCommand("INSERT INTO tagpostrelation(tag_id, post_id) VALUES ($tag_id, $model->post_id)")->execute();
                }

                return $this->redirect(['view', 'id' => $model->post_id]);
            }

            throw new \yii\db\Exception("Some problem with DB connection ocurred!");

        } else {
            return $this->render('create', [
                'model' => $model,
                'ddItems' => $ddItems
            ]);
        }
    }

    private function getTags()
    {
        $tags = \Yii::$app->request->post('chosen-tag');
        $tags = trim($tags);
        $tagArray = explode(' ', $tags);
        return $tagArray;
    }

    private function getTagId($param)
    {
        $tag = Tag::find()->where(['tag_name' => $param])->one();
        $tag_id = $tag->tag_id;
        return $tag_id;
    }
    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->post_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    //Search post by title
    public function actionSearchPost($title)
    {
        $post = (new Query())->select('*')
                                ->from('posts')
                                ->where(['title' => $title])
                                ->one();

        if($post)
        {
            return json_encode($post);
        }

        return true;
    }

    //Search posts by tag
    public function actionSearchTag($tag)
    {
        $tag_id = (new Query())->select('tag_id')
                                ->from('tags')
                                ->where(['tag_name' => $tag])
                                ->one();

        $post_ids = (new Query())->select('post_id')
                                    ->from('tagpostrelation')
                                    ->where(['tag_id' => $tag_id])
                                    ->all();
        $posts = [];

        foreach ($post_ids as $post_id)
        {
            $posts[] = (new Query())->select('*')
                                    ->from('posts')
                                    ->where(['post_id' => $post_id])
                                    ->one();


        }

        return json_encode($posts);
    }

    public function actionUpdateComment($id)
    {
        $model = PostComment::find()->where(['comment_id' => $id])->one();

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['comments', 'id' => $model->post_id]);
        }
        else
        {
            if($model->author_id == \Yii::$app->user->identity->id)
            {
                return $this->render('update_comment',[
                    'model' => $model
                ]);
            }

            return $this->redirect(['../site/error','405','You are not allowed!']);
        }

    }

    public function actionComments($id)
    {
        $comments = \Yii::$app->db->createCommand("SELECT *
                                                        FROM post_comments
                                                        WHERE post_id=$id
                                                        ORDER BY comment_id
                                                        DESC ")->queryAll();

        if(\Yii::$app->user->isGuest)
        {
            return $this->redirect(['../site/error', '405', 'You have to be loged in, to see this content!']);
        }

        return $this->render('comments',[
            'comments' => $comments,
        ]);
    }

    public function actionFeedback($target_id, $post_id = null, $status, $flag)
    {
        if(\Yii::$app->request->isAjax)
        {
            $user_id = \Yii::$app->user->identity->id;

            if($flag == 0) {

                $likes = \Yii::$app->db->createCommand("SELECT COUNT(*)
                                                         FROM likes
                                                         WHERE comment_id=$target_id")->queryScalar();

                $dislikes = \Yii::$app->db->createCommand("SELECT COUNT(*)
                                                         FROM dislikes
                                                         WHERE comment_id=$target_id")->queryScalar();

                if (!$this->queryComments($user_id, $target_id, 'likes')
                    &&
                    !$this->queryComments($user_id, $target_id, 'dislikes'))
                {
                    if ($status == 'like')
                    {
                        \Yii::$app->db->createCommand("INSERT INTO likes(user_id, comment_id, post_id)
                                                            VALUES ($user_id, $target_id, 0)")->execute();

                        $likes++;

                    }
                    else if ($status == 'dislike')
                    {
                        \Yii::$app->db->createCommand("INSERT INTO dislikes(user_id, comment_id, post_id)
                                                            VALUES ($user_id, $target_id, 0)")->execute();

                        $dislikes++;
                    }

                }

                if($status == 'like')
                {
                    return $likes;
                }
                else if($status == 'dislike')
                {
                    return $dislikes;
                }

            }
            else if($flag == 1)
            {
                $likes = \Yii::$app->db->createCommand("SELECT COUNT(*)
                                                         FROM likes
                                                         WHERE post_id=$target_id")->queryScalar();

                $dislikes = \Yii::$app->db->createCommand("SELECT COUNT(*)
                                                         FROM dislikes
                                                         WHERE post_id=$target_id")->queryScalar();

                if(!$this->queryPosts($user_id, $target_id, 'likes')
                   &&
                   !$this->queryPosts($user_id, $target_id, 'dislikes'))
                {
                    if ($status == 'like')
                    {
                        \Yii::$app->db->createCommand("INSERT INTO likes(user_id, comment_id, post_id)
                                                            VALUES ($user_id, 0, $target_id)")->execute();

                        $likes++;

                    }
                    else if ($status == 'dislike')
                    {
                        \Yii::$app->db->createCommand("INSERT INTO dislikes(user_id, comment_id, post_id)
                                                            VALUES ($user_id, 0, $target_id)")->execute();

                        $dislikes++;
                    }
                }

                if($status == 'like')
                {
                    return $likes;
                }
                else if($status == 'dislike')
                {
                    return $dislikes;
                }
            }

        }
    }

    private function queryComments($user_id, $comment_id, $table)
    {
        $checkQuery = (new Query())->select('*')
            ->from($table)
            ->where(['user_id' => $user_id, 'comment_id' => $comment_id])
            ->one();

        return $checkQuery;
    }

    private function queryPosts($user_id, $post_id, $table)
    {
        $checkQuery = (new Query())->select('*')
            ->from($table)
            ->where(['user_id' => $user_id, 'post_id' => $post_id])
            ->one();

        return $checkQuery;
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        \Yii::$app->db->createCommand("SET foreign_key_checks = 0;")->execute();

        $this->findModel($id)->delete();

        \Yii::$app->db->createCommand("DELETE FROM likes
                                            WHERE post_id=$id")->execute();

        \Yii::$app->db->createCommand("DELETE FROM dislikes
                                            WHERE post_id=$id")->execute();

        PostComment::deleteAll("post_id=" . $id);



        \Yii::$app->db->createCommand("SET foreign_key_checks = 1;")->execute();

        return $this->redirect(['index']);
    }

    public function actionCreateComment($id)
    {
        $model = new PostComment();

        if($model->load(\Yii::$app->request->post()))
        {
            date_default_timezone_set('Europe/Berlin');

            $model->author_id = \Yii::$app->user->identity->id;
            $model->post_id = $id;
            $model->date_create = date('d/m/Y');

            if($model->save())
            {
                return $this->redirect(['comments', 'id' => $id]);
            }

            throw new \yii\db\Exception("Some problem with DB connection occurred!");

        }
        else
        {
            return $this->render('create-comment',[
                'model' => $model
            ]);
        }
    }

    public function actionDeleteComment($id)
    {
        $post_comment = PostComment::find()->where(['comment_id' => $id])->one();
        $post_id = $post_comment->post_id;

        if (\Yii::$app->user->identity->id == $post_comment->author_id || $this->isAdmin()) {
            \Yii::$app->db->createCommand("SET foreign_key_checks = 0;")->execute();

            $post_comment->delete();

            \Yii::$app->db->createCommand("DELETE FROM likes
                                                WHERE comment_id=$id")->execute();

            \Yii::$app->db->createCommand("DELETE FROM dislikes
                                                WHERE comment_id=$id")->execute();

            \Yii::$app->db->createCommand("SET foreign_key_checks = 1;")->execute();

            return $this->redirect(['comments', 'id' => $post_id]);
        }

        return $this->redirect(['../site/error', '405', 'You are not allowed!']);

    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
