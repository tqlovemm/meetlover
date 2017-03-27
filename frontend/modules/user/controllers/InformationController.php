<?php

namespace frontend\modules\user\controllers;

use common\Qiniu\QiniuUploader;
use frontend\modules\user\models\UserImages;
use Yii;
use common\models\Constellation;
use common\models\Education;
use common\models\JobSorts;
use common\models\Province;
use common\models\Salary;
use common\models\Smokeanddrink;
use frontend\modules\user\models\HeterosexualProfile;
use frontend\modules\user\models\LimitAge;
use frontend\modules\user\models\LimitHeight;
use frontend\modules\user\models\LimitMarry;
use frontend\modules\user\models\LimitWeight;
use frontend\modules\user\models\UserProfile;
use frontend\modules\user\models\User;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class InformationController extends Controller
{
    public $layout = "/basic";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','save-sex','profile','heterosexual-profile','upload'],
                'rules' => [
                    [
                        'actions' => ['index','save-sex','profile','heterosexual-profile','upload'],
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
                return $this->redirect('profile');
            }
            return var_dump($model->errors);
        }
    }

    public function actionProfile(){

        $user = User::findOne(Yii::$app->user->id);
        $profile = UserProfile::findOne(Yii::$app->user->id);
        if(empty($profile)){
            $profile = new UserProfile();
        }elseif($profile->status!=0){
            return $this->redirect('heterosexual-profile');
        }

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            $user->save(false);
            $profile->save(false);
            return $this->redirect('heterosexual-profile');
        }

        return $this->render('user-profile',[
            'user'=>$user,
            'profile'=>$profile,
            'constellation'=>ArrayHelper::map(Constellation::find()->select('id,constellation')->asArray()->all(),'id','constellation'),
            'province'=>ArrayHelper::map(Province::find()->select('province')->asArray()->all(),'province','province'),
            'job'=>ArrayHelper::map(JobSorts::find()->select('job')->asArray()->all(),'job','job'),
            'ageChoice'=>ArrayHelper::map(LimitAge::find()->select('id,age')->asArray()->all(),'id','age'),
            'heightChoice'=>ArrayHelper::map(LimitHeight::find()->select('id,height')->asArray()->all(),'id','height'),
            'weightChoice'=>ArrayHelper::map(LimitWeight::find()->select('id,weight')->asArray()->all(),'id','weight'),
            'education'=>ArrayHelper::map(Education::find()->select('id,education')->where(['status'=>10])->all(),'id','education'),
            'salary'=>ArrayHelper::map(Salary::find()->select('id,salary')->where(['status'=>10])->asArray()->all(),'id','salary'),
            'marry'=>array_filter(ArrayHelper::map(LimitMarry::find()->select('id,marry')->all(),'id','marry')),
            'sd'=>ArrayHelper::map(Smokeanddrink::find()->select('id,smokeanddrink')->where(['status'=>10])->all(),'id','smokeanddrink'),
            'marryTime'=>array_filter(ArrayHelper::map(LimitMarry::find()->select('id,hope_marry_time')->all(),'id','hope_marry_time')),
        ]);
    }

    public function actionHeterosexualProfile(){

        $model = HeterosexualProfile::findOne(Yii::$app->user->id);
        if(empty($model)){
            $model = new HeterosexualProfile();
        }elseif($model->status==10){
            return $this->redirect('success');
        }

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                return $this->redirect('success');
            }
        } else {
            return $this->render('heterosexual-profile',[
                'model'=>$model,
                'province'=>ArrayHelper::map(Province::find()->select('province')->all(),'province','province'),
                'education'=>ArrayHelper::map(Education::find()->select('id,education')->all(),'id','education'),
                'salary'=>ArrayHelper::map(Salary::find()->select('id,salary')->all(),'id','salary'),
                'sd'=>ArrayHelper::map(Smokeanddrink::find()->select('id,smokeanddrink')->all(),'id','smokeanddrink'),
            ]);
        }
    }

    public function actionSuccess(){

        return $this->render('success');
    }

    public function actionUpload(){
        $model = UserImages::find()->where(['user_id'=>Yii::$app->user->id])->asArray()->all();
        return $this->render('upload',['model'=>$model]);
    }

      public function actionDeleteImg($id){

          $qn = new QiniuUploader('files',Yii::$app->params['qnak1'],Yii::$app->params['qnsk1']);
          $model = UserImages::findOne($id);
          if($model->delete()){
              $ret = $qn->delete('meetlover',$model->img_path);
              return $ret;
          }
      }

    /**
     * @return boolean
     */
    public function actionUploadImage(){

        $pre_url = Yii::$app->params['meetlover'];
        $url = $_FILES;$html = '';
        $qn = new QiniuUploader('files',Yii::$app->params['qnak1'],Yii::$app->params['qnsk1']);
        $mkdir = date('Y').'/'.date('m').'/'.date('d').'/'.Yii::$app->user->id;
        $model = new UserImages();

        foreach ($url['files']['tmp_name'] as $img){

            $lenth = $model::find()->where(['user_id'=>Yii::$app->user->id])->count();
            if($lenth>8){
                echo "<script>alert('对不起！您已经存在上传图片9张！')</script>";
                break;
            }

            $qiniu = $qn->upload_multi('meetlover',"meet_lover/user_images/$mkdir",$img);
            $_model = clone $model;
            $_model->img_path = $qiniu['key'];

            if(!$_model->save()){
                return var_dump($_model->errors);
            }else{
                $html .= <<<EOF
<img onclick='imgRemove($_model->id,this)' class='weui_uploader_file img-responsive' src=$pre_url$_model->img_path />
EOF;
            }
        }

        return $html;
    }


}