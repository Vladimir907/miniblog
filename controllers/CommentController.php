<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use app\models\Comment;
use app\models\User;

class CommentController extends \yii\web\Controller
{
    public function actionCreate($post_id)
    {
        $model = new Comment();
        $model->post_id = $post_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([Url::previous()]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([Url::previous()]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect([Url::previous()]);
    }

    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
