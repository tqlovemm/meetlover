<?php
namespace frontend\controllers;

use common\models\User;
use frontend\components\SendTemplateSMS;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
     * @return mixed
     */
    public function actionIndex()
    {
        $detect = new \Mobile_Detect();
        if($detect->isMobile()||$detect->isTablet()){
            return $this->redirect(["touch/default/index"]);
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionCctv(){

        $this->layout = false;
        return $this->render("cctv");
    }

    public function actionCheckMobileExists(){

        $mobile = isset($_POST['mobile'])?$_POST['mobile']:null;
        if(!empty($mobile)){

            $user = User::findByCellphone($mobile);
            if($user){
                $data = array('error_code'=>201,'error_msg'=>"该手机号已经注册,请更换手机号");
            }else{
                $data = array('error_code'=>0,'error_msg'=>"该手机号可以注册");
            }
        }else{
            $data = array('error_code'=>203,'error_msg'=>"手机号不存在");
        }

        echo json_encode($data);

    }

    public function actionSendCode(){

        $session = Yii::$app->session;
        if(!$session->isActive){
            $session->open();
        }

        $mobile = isset($_POST['mobile'])?$_POST['mobile']:null;
        if(!empty($mobile)){
            /*产生随机验证码*/
            $code = mt_rand(1000,9999);
            $send = SendTemplateSMS::send($mobile,array($code,'10'),"157193");
            if($send->statusCode==0){
                $session->set('signup_mobile_number',$mobile);
                $session->set('signup_verification_code',$code);
            }
            $data = array('statusCode'=>0,'statusMsg'=>'短信发送成功，验证码10分钟内有效,请注意查看手机短信。如果未收到短信，请在60秒后重试！');
        }else{
            $data = array('statusCode'=>203,'statusMsg'=>"手机号不存在");
        }

        echo json_encode($data);
    }

    public function actionVerificationMobileCode(){

        $session = Yii::$app->session;
        if(!$session->isActive){
            $session->open();
        }

        $mobile = $session->get("signup_mobile_number");
        $code = $session->get("signup_verification_code");

        if($mobile==$_POST['mobile']&&$code==$_POST['code']){
            $data = array('statusCode'=>0,'statusMsg'=>"验证成功");
        }elseif($mobile!=$_POST['mobile']){
            $data = array('statusCode'=>204,'statusMsg'=>"手机号于验证码不匹配");
        }elseif($code!=$_POST['code']){
            $data = array('statusCode'=>205,'statusMsg'=>"验证码错误");
        }else{
            $data = array('statusCode'=>206,'statusMsg'=>"系统故障请及时联系客服");
        }

        echo json_encode($data);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }



}
