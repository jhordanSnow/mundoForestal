<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plantcharacteristic".
 *
 * @property int $IdPlant
 * @property int $IdCharacteristic
 * @property string $Value
 *
 * @property Characteristic $characteristic
 * @property Plant $plant
 */
class Plantcharacteristic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plantcharacteristic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdPlant', 'IdCharacteristic', 'Value'], 'required'],
            [['IdPlant', 'IdCharacteristic'], 'integer'],
            [['Value'], 'string', 'max' => 255],
            [['IdCharacteristic'], 'exist', 'skipOnError' => true, 'targetClass' => Characteristic::className(), 'targetAttribute' => ['IdCharacteristic' => 'IdCharacteristic']],
            [['IdPlant'], 'exist', 'skipOnError' => true, 'targetClass' => Plant::className(), 'targetAttribute' => ['IdPlant' => 'IdPlant']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdPlant' => 'Id Plant',
            'IdCharacteristic' => 'Id Characteristic',
            'Value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristic()
    {
        return $this->hasOne(Characteristic::className(), ['IdCharacteristic' => 'IdCharacteristic']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlant()
    {
        return $this->hasOne(Plant::className(), ['IdPlant' => 'IdPlant']);
    }

    public static function primaryKey(){
      return ['Value'];
    }
}
