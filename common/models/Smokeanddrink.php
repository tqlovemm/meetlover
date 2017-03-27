<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meet_lover_smokeanddrink".
 *
 * @property integer $id
 * @property string $smokeanddrink
 */
class Smokeanddrink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_smokeanddrink';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['smokeanddrink'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'smokeanddrink' => 'Smokeanddrink',
        ];
    }
}
