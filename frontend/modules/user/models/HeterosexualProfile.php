<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "meet_lover_heterosexual_profile".
 *
 * @property integer $user_id
 * @property string $heterosexual_height
 * @property string $heterosexual_weight
 * @property string $heterosexual_age
 * @property integer $heterosexual_education
 * @property integer $heterosexual_annual_income
 * @property integer $heterosexual_native_place
 * @property integer $heterosexual_only_child
 * @property integer $heterosexual_smoke
 * @property integer $heterosexual_drink
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property User $user
 */
class HeterosexualProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_heterosexual_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['heterosexual_height','heterosexual_native_place', 'heterosexual_weight', 'heterosexual_age', 'heterosexual_native_place',
                'heterosexual_annual_income','heterosexual_education', 'heterosexual_only_child',
                'heterosexual_smoke', 'heterosexual_drink'], 'required','message'=>"{attribute}不可为空"],
            [['user_id',  'heterosexual_annual_income','heterosexual_education', 'heterosexual_only_child', 'heterosexual_smoke','status', 'heterosexual_drink', 'created_at', 'updated_at'], 'integer'],
            [['heterosexual_height', 'heterosexual_weight', 'heterosexual_age'], 'string', 'max' => 16],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'heterosexual_height' => '对方身高',
            'heterosexual_weight' => '对方体重',
            'heterosexual_age' => '对方年龄',
            'heterosexual_education' => '对方学历',
            'heterosexual_annual_income' => '对方年收入',
            'heterosexual_native_place' => '对方籍贯',
            'heterosexual_only_child' => '是否是独生子女',
            'heterosexual_smoke' => '抽烟情况',
            'heterosexual_drink' => '饮酒情况',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
            $this->status = 10;
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
}
