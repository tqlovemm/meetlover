<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "meet_lover_limit_marry".
 *
 * @property integer $id
 * @property string $marry
 * @property string $hope_marry_time
 */
class LimitMarry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_limit_marry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marry'], 'string', 'max' => 16],
            [['hope_marry_time'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'marry' => 'Marry',
            'hope_marry_time' => 'Hope Marry',
        ];
    }
}
