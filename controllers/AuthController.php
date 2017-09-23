<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class AuthController extends \yii\web\Controller
{
    /**
     * Login action.
     *
     * @return Response|string
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

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if(Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post()) && $model->signup()) {   
                return $this->goHome();
            }

        }

        return $this->render('signup', ['model'=>$model]);
    }

}
