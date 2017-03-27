<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meet_lover_job_sorts".
 *
 * @property integer $id
 * @property string $job
 */
class JobSorts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_job_sorts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job'], 'required'],
            [['job'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job' => 'Job',
        ];
    }
}
