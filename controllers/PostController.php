<?php

namespace app\controllers;

use Yii;
use app\models\Country;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PostController extends Controller 
{
	public function actionView($id) {
		$model = Country::find();
		if($model === null) {
			throw new NotFoundHttpException;
		}

		return $this->render('about', [
			'model' => $model
		])
	}

	public function actionCreate() {
		$model = new Country;

		if($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['about', 'id' => $model->id]);
		} else {
			return $this->redirect('index', [
				'model' => $model
			])
		}
	}
}