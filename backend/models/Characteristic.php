<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "characteristic".
 *
 * @property int $IdCharacteristic
 * @property string $Name
 */
class Characteristic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['Name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdCharacteristic' => 'Id Characteristic',
            'Name' => 'Name',
        ];
    }
}
