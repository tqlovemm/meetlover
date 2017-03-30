<?php

namespace frontend\modules\user\models;

use Yii;
use yii\web\ForbiddenHttpException;

/**
 * This is the model class for table "meet_lover_user_images".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $img_path
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $type
 * @property integer $status
 *
 * @property User $user
 */
class UserImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_user_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'updated_at', 'type', 'status'], 'integer'],
            [['img_path'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'img_path' => 'Img Path',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_at = time();
                $this->updated_at = time();
                $this->user_id = Yii::$app->user->id;
            }else{
                $this->updated_at = time();
            }
            return true;
        } else {
            return false;
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAvatar(){
        $model = self::findOne(['type'=>2]);
        if(!empty($model)){
            $avatar = $model->img_path;
        }elseif(!empty($this->img_path)){
            $avatar = $this->img_path;
        }else{
            $avatar = "images/guest.png";
        }
        return $avatar;
    }


    public function deleteImg(){

        if( $this->user_id == Yii::$app->user->id){
            self::delete();
        }else{
            throw new ForbiddenHttpException('禁止操作');
        }
    }
}
