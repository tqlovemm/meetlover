<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meet_lover_education".
 *
 * @property integer $id
 * @property integer $edu_id
 * @property string $education
 */
class Education extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edu_id'], 'integer'],
            [['education'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'edu_id' => 'Edu ID',
            'education' => 'Education',
        ];
    }
}
