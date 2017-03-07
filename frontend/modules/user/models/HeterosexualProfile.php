<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "meet_lover_heterosexual_profile".
 *
 * @property integer $user_id
 * @property integer $heterosexual_height
 * @property integer $heterosexual_weight
 * @property integer $heterosexual_age
 * @property string $heterosexual_education
 * @property integer $heterosexual_annual_income
 * @property string $heterosexual_native_place
 * @property integer $heterosexual_only_child
 * @property integer $heterosexual_smoke
 * @property integer $heterosexual_drink
 * @property integer $created_at
 * @property integer $updated_at
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
            [['user_id', 'heterosexual_height', 'heterosexual_weight', 'heterosexual_age', 'heterosexual_native_place'], 'required'],
            [['user_id', 'heterosexual_height', 'heterosexual_weight', 'heterosexual_age', 'heterosexual_annual_income', 'heterosexual_only_child', 'heterosexual_smoke', 'heterosexual_drink', 'created_at', 'updated_at'], 'integer'],
            [['heterosexual_education'], 'string', 'max' => 32],
            [['heterosexual_native_place'], 'string', 'max' => 16],
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
            'heterosexual_height' => 'Heterosexual Height',
            'heterosexual_weight' => 'Heterosexual Weight',
            'heterosexual_age' => 'Heterosexual Age',
            'heterosexual_education' => 'Heterosexual Education',
            'heterosexual_annual_income' => 'Heterosexual Annual Income',
            'heterosexual_native_place' => 'Heterosexual Native Place',
            'heterosexual_only_child' => 'Heterosexual Only Child',
            'heterosexual_smoke' => 'Heterosexual Smoke',
            'heterosexual_drink' => 'Heterosexual Drink',
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
}
