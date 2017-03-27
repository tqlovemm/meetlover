<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "meet_lover_limit_age".
 *
 * @property integer $id
 * @property string $age
 */
class LimitAge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_limit_age';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['age'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'age' => 'Age',
        ];
    }
}
