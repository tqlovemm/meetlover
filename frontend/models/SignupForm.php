<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $cellphone;
    public $email;
    public $password;
    public $sms_code;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
           // ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['cellphone', 'trim'],
            ['cellphone', 'required'],
            ['cellphone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This cellphone has already been taken.'],
            //['cellphone', 'getMobile','on' => ['default','login_sms_mobile']],
            ['cellphone', 'integer', 'on' => ['login_sms_code']],
            ['cellphone', 'match', 'pattern'=>'/1[3456789]{1}\d{9}$/', 'on' => ['default','login_sms_code'], 'message'=>'手机号不合法'],
            ['cellphone', 'string', 'min'=>6,'max' => 11, 'on' => ['default','login_sms_code']],

            ['sms_code', 'required'],
            ['sms_code', 'filter', 'filter' => 'trim'],
            //['smsCode', 'required','on' => ['default','login_sms_code'], 'message' => '验证码不可为空！'],
            ['sms_code', 'integer','on' => ['default','login_sms_code']],
            ['sms_code', 'string', 'min'=>4,'max' =>4,'on' => ['default','login_sms_code']],
            //['sms_code', 'getSmsCode','on' => ['default','login_sms_code']],

            //['email', 'trim'],
            //['email', 'required'],
            //['email', 'email'],
            //['email', 'string', 'max' => 255],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

/*            ['confirm_password','required'],
            [['confirm_password'], 'compare','compareAttribute'=>'password','message'=>'两次输入密码不一致'],*/
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username = $this->cellphone;
        $user->cellphone = $this->cellphone;
        //$user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
