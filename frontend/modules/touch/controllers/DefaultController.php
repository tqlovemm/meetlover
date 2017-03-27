<?php

namespace frontend\modules\touch\controllers;
use Yii;
use frontend\models\SignupForm;
use frontend\tests\unit\models\SignupFormTest;
use yii\web\Controller;

/**
 * Default controller for the `touch` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layout = "main";
    public function actionIndex()
    {
        $detect = new \Mobile_Detect();
        if(!$detect->isMobile()&&!$detect->isTablet()){
            return $this->redirect(["/"]);
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['/user/information']);
                }
            }
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionAbout(){

        $detect = new \Mobile_Detect();
        if(!$detect->isMobile()&&!$detect->isTablet()){
            return $this->redirect(["/site/about"]);
        }
        return $this->render('about');
    }
    public function actionContact(){

        $detect = new \Mobile_Detect();
        if(!$detect->isMobile()&&!$detect->isTablet()){
            return $this->redirect(["/site/contact"]);
        }
        return $this->render('contact');
    }
}
