<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Post;
use yii\helpers\Url;

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
        $m_post = new Post;
        $post = $m_post->getAll();
        return $this->render('index',[
            'post' => $post,
        ]);
    }

    public function actionMyblog()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['auth/login']);
        } 

        $m_post = new Post;
        $post = $m_post->getByUser(Yii::$app->user->id);

        return $this->render('myblog', [
            'post' => $post,
            'author' => Yii::$app->user->identity->name,
        ]);
    }

    public function afterAction($action, $result)
    {
        Url::remember();
        return parent::afterAction($action, $result);
    }
}
