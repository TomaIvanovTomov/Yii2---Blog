<?php

namespace app\controllers;

use app\models\BlogUser;
use app\models\RegisterForm;
use app\models\UsersMessages;
use function PHPSTORM_META\elementType;
use Yii;
use yii\base\ErrorException;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\widgets\ActiveForm;
use yii\web\Response;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new \app\models\Post();
        $lastPosts = $model::find()->orderBy(["post_id" => SORT_DESC])->limit(3)->all();

        return $this->render('index', [
            'lastPosts' => $lastPosts
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        $user = new BlogUser();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if(isset($_POST['RegisterForm']))
        {
            $model->attributes = $_POST['RegisterForm'];

            if($model->validate())
            {
                $user->username = Html::encode($model->username);
                $user->password = Html::encode(md5($model->password));
                $user->repeat_password = Html::encode(md5($model->repeat_password));
                $user->email = Html::encode($model->email);

                if($user->save())
                {
                    $role = \Yii::$app->authManager->getRole('user');
                    \Yii::$app->authManager->assign($role, $user->id);

                    \Yii::$app->user->login($user);

                    return $this->redirect('index');
                }
            }
        }

        return $this->render('register',[
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new UsersMessages();

        if($model->load($_POST) && $model->save())
        {
            \Yii::$app->session->setFlash('messageSubmited');
            return $this->redirect('contact');
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAddMessage()
    {
        $message = \Yii::$app->request->get('message');
        $username = \Yii::$app->user->identity->username;

        \Yii::$app->db->createCommand("INSERT INTO chat(message_content, message_author) VALUES (:message, :username)")
                                        ->bindValues([':message' => $message, ':username' => $username])
                                        ->execute();

        $lastMessage = (new Query())->select('*')
            ->from('chat')
            ->orderBy(['message_id' => SORT_DESC])
            ->one();

        return json_encode($lastMessage);
    }

    public function actionLoadMessages()
    {
        $load = (new Query())->select('*')
                                ->from('chat')
                                ->orderBy(['message_id' => SORT_DESC])
                                ->limit(10)
                                ->all();

        return json_encode($load);
    }

}
