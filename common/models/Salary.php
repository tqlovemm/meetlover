<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meet_lover_salary".
 *
 * @property integer $id
 * @property integer $salary_id
 * @property string $salary
 */
class Salary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_salary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salary_id'], 'required'],
            [['salary_id'], 'integer'],
            [['salary'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'salary_id' => 'Salary ID',
            'salary' => 'Salary',
        ];
    }
}
