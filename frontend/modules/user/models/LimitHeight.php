<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "meet_lover_limit_height".
 *
 * @property integer $id
 * @property string $height
 */
class LimitHeight extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_limit_height';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['height'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'int' => 'ID',
            'height' => 'Height',
        ];
    }
}
