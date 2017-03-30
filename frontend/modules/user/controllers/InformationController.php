<?php

namespace frontend\modules\user\controllers;

use Yii;
use common\models\City;
use common\Qiniu\QiniuUploader;
use frontend\modules\user\models\UserImages;
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
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class InformationController extends Controller
{
    public $layout = "/basic";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index','profile','heterosexual-profile','upload','check-photos','success','upload-image','set-avatar','get-avatar',
                            'lists','province-lists','delete-img',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex($sex=''){

        $user_id = Yii::$app->user->id;
        $model = User::findOne($user_id);
        if($model->sex!=0){
            return $this->redirect('information/profile');
        }
        if($sex==''){
            return $this->render("index");
        }else{
            if(!empty($model)){
                $model->sex = $sex;
                if($model->update()){
                    return $this->redirect('information/profile');
                }
                return var_dump($model->errors);
            }
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
            'province'=>ArrayHelper::map(Province::find()->select('provinceID,province')->asArray()->all(),'provinceID','province'),
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
                'province'=>ArrayHelper::map(Province::find()->select('provinceID,province')->all(),'provinceID','province'),
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

        $count = UserImages::find()->where(['user_id'=>Yii::$app->user->id])->count();
        if($count>=9){
            return $this->redirect("check-photos");
        }
        return $this->render('upload');
    }

    public function actionDeleteImg($id){
        $model = UserImages::findOne($id);
        if($model->deleteImg()){
            $qn = new QiniuUploader('files',Yii::$app->params['qnak1'],Yii::$app->params['qnsk1']);
            $ret = $qn->delete('meetlover',$model->img_path);
            return var_dump($ret);
        }else{
            var_dump($model->errors);
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

    public function actionCheckPhotos(){

        $data = UserImages::find()->where(['user_id'=>Yii::$app->user->id])->orderBy('type desc')->addOrderBy('created_at desc');
        $photos = Yii::$app->tools->Pagination($data);
        return $this->render('check-photos',[
            'model' => $photos['result'],
            'pages' => $photos['pages'],
        ]);
    }

    public function actionSetAvatar($id){
        $userImgModel = UserImages::findOne($id);

            try{
                if($userImgModel->type!=2){
                    UserImages::updateAll(['type'=>1],['user_id'=>Yii::$app->user->id]);
                }
            }catch (Exception $e){
                throw new NotFoundHttpException($e->getMessage());
            }finally{
                $userImgModel->type = 2;
                if($userImgModel->update()){
                    echo "设为头像";
                }else{
                    echo json_encode($userImgModel->errors);
                }
            }


    }

    public function actionGetAvatar(){
        $pre_url = Yii::$app->params['meetlover'];
        $model = UserImages::findOne(['user_id'=>Yii::$app->user->id]);
        if(!empty($model)){
            echo "<img src='".$pre_url.$model->getAvatar()."'>";
        }else{
            echo "<img src='/images/guest.png'>";
        }
    }

    public function actionLists($id)
    {
        $localCount = City::find()
            ->where(['fatherId' => [$id]])
            ->count();
        $branches = City::find()
            ->where(['fatherId' => [$id]])
            ->all();
        if ($localCount > 0) {
            foreach ($branches as $branche) {
                echo "<option value='" . $branche->cityID . "'>" . $branche->city . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }
    public function actionProvinceLists($id)
    {
        $localCount = Province::find()
            ->where(['fatherId' => [$id]])
            ->count();
        $branches = Province::find()
            ->where(['fatherId' => [$id]])
            ->all();
        if ($localCount > 0) {
            foreach ($branches as $branche) {
                echo "<option value='" . $branche->provinceID . "'>" . $branche->province . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }

}