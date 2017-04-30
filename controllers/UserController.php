<?php

namespace app\controllers;

use app\models\BlogUserSearch;
use app\models\Post;
use app\models\PostComment;
use app\models\RegisterForm;
use app\models\UpdateForm;
use app\models\UsersMessages;
use function PHPSTORM_META\elementType;
use Yii;
use app\models\BlogUser;
use yii\base\ErrorException;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for Users model.
 */
class UserController extends Controller
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
                    'delete-user' => ['POST']
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['users-list', 'delete-user'],
                'rules' => [
                    [
                        'actions' => ['users-list','delete-user'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($role, $action)
                        {
                            if($this->isAdmin())
                            {
                                return true;
                            }

                            return $this->redirect(['../site/error','405', 'You are not allowed!']);

                        }
                    ]
                ],
            ],
        ];
    }

    public static function isAdmin()
    {
        $userId = \Yii::$app->user->identity->id;
        $role = \Yii::$app->db->createCommand("SELECT item_name FROM auth_assignment WHERE user_id=$userId")->queryScalar();

        return $role == 'admin';
    }
    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
        $id = \Yii::$app->user->identity->id;

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BlogUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = new UpdateForm();
        $id = \Yii::$app->user->identity->id;
        $user = $this->findModel($id);

        //default values
        $model->username = $user->username;
        $model->email = $user->email;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if (isset($_POST['UpdateForm']))
        {
            $model->attributes = $_POST['UpdateForm'];

            if($model->validate())
            {
                $user->username = $model->username;

                $user->email = $model->email;

                $user->password = md5($model->password);

                $user->update();

                $this->redirect(['view', 'id' => $user->id]);
            }
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateImage()
    {
        $id = \Yii::$app->user->identity->id;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {

            //get the instance of the image
            $image = UploadedFile::getInstance($model, 'image');
            //get image name
            $model->image = $image->baseName . '.' . $image->extension;
            //go through validation and if OK -> save
            if($model->save())
            {
                //all is OK. Upload Image
                $image->saveAs('../web/images/' . $model->image);
                //redirect to view profile
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('update-image', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        \Yii::$app->db->createCommand("SET foreign_key_checks = 0;")->execute();

        \Yii::$app->db->createCommand("DELETE FROM auth_assignment WHERE user_id=$id")->execute();

        \Yii::$app->db->createCommand("DELETE FROM post_comments WHERE author_id=$id")->execute();

        Post::deleteAll('user_id = ' . $id);

        $this->findModel($id)->delete();

        \Yii::$app->db->createCommand("SET foreign_key_checks = 1;")->execute();

        return $this->redirect(['site/index']);
    }

    public function actionUsersList()
    {
        $users = BlogUser::find()->all();

        return $this->render('users-list',['usersList' => $users]);
    }

    public function actionDeleteUser($id)
    {
        \Yii::$app->db->createCommand("SET foreign_key_checks = 0;")->execute();

        \Yii::$app->db->createCommand("DELETE FROM auth_assignment WHERE user_id=$id")->execute();

        $this->findModel($id)->delete();

        $userPosts = (new Query())->select('*')
                                    ->from('posts')
                                    ->where(['user_id' => $id])
                                    ->all();

        foreach ($userPosts as $post)
        {
            $post_id = $post['post_id'];
            \Yii::$app->db->createCommand("DELETE FROM post_comments WHERE post_id=$post_id AND author_id=$id")->execute();
        }

        Post::deleteAll('user_id = ' . $id);

        \Yii::$app->db->createCommand("SET foreign_key_checks = 1;")->execute();

        return $this->redirect('users-list');
    }

    public function actionMessage($id)
    {
        $currMessage = UsersMessages::find()->where(['message_id' => $id])->one();

        return $this->renderAjax('message',[
            'msg' => $currMessage
        ]);
    }

    public function actionDeleteMessage($id)
    {
        UsersMessages::deleteAll('message_id = ' . $id);

        return false;
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function getMessages()
    {
        $messages = UsersMessages::find()->all();

        return $messages;
    }

    public static function numberOfPosts()
    {
        $userId = \Yii::$app->user->identity->id;

        $nums = \Yii::$app->db->createCommand("SELECT COUNT(*)                                            
                                               FROM posts
                                               WHERE user_id=$userId
                                              ")->queryScalar();
        return $nums;
    }

    public static function userPosts()
    {
        $id = \Yii::$app->user->identity->id;
        $queryResult = \Yii::$app->db->createCommand("SELECT title, date_create, post_id
                                                             FROM posts
                                                             WHERE user_id=$id")->queryAll();

        return $queryResult;
    }
}
