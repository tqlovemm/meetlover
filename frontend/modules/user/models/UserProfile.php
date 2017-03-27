<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "meet_lover_user_profile".
 *
 * @property integer $user_id
 * @property integer $age
 * @property integer $weight
 * @property integer $height
 * @property integer $constellation
 * @property string $native_place
 * @property string $job
 * @property integer $education
 * @property integer $annual_salary
 * @property integer $somke
 * @property integer $drink
 * @property integer $only_child
 * @property integer $marry
 * @property integer $hope_marry_time
 * @property string $say_to_him
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'age', 'weight', 'height', 'native_place', 'marry'], 'required'],
            [['user_id','constellation',  'age', 'weight','status','education', 'hope_marry_time', 'height', 'annual_salary', 'somke', 'drink', 'only_child', 'marry', 'created_at', 'updated_at'], 'integer'],
            [['say_to_him'], 'string'],
            [['native_place'], 'string', 'max' => 32],
            [['job'], 'string', 'max' => 64],
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
            'age' => 'Age',
            'weight' => 'Weight',
            'height' => 'Height',
            'constellation' => 'Constellation',
            'native_place' => 'Native Place',
            'job' => 'Job',
            'education' => 'Education',
            'annual_salary' => 'Annual Salary',
            'somke' => 'Somke',
            'drink' => 'Drink',
            'only_child' => 'Only Child',
            'marry' => 'Marry',
            'hope_marry_time' => 'Hope Marry Time',
            'say_to_him' => 'Say To Him',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
