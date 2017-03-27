<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meet_lover_constellation".
 *
 * @property integer $id
 * @property string $constellation
 */
class Constellation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_constellation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['constellation'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'constellation' => 'Constellation',
        ];
    }
}
