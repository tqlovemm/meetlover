<?php

namespace frontend\modules\user\controllers;

use Yii;
use frontend\modules\user\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;

class InformationController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','save-sex'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','save-sex'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(){

        return $this->render("index");
    }

    public function actionSaveSex($sex){

        $user_id = Yii::$app->user->id;
        $model = User::findOne($user_id);
        if(!empty($model)){

            $model->sex = $sex;
            if($model->update()){

                return $this->render('user-profile');
            }
            return var_dump($model->errors);
        }
    }

}