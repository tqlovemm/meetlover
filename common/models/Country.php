<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meet_lover_country".
 *
 * @property integer $id
 * @property integer $countryID
 * @property string $country
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meet_lover_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryID'], 'integer'],
            [['country'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'countryID' => 'Country ID',
            'country' => 'Country',
        ];
    }
}
