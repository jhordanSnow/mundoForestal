<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plant".
 *
 * @property int $IdPlant
 * @property string $Name
 * @property string $ScientificName
 * @property int $IdType
 * @property int $IdFamily
 * @property string $Description
 *
 * @property Mapinformation $mapinformation
 * @property Botanicalfamily $family
 * @property Planttype $type
 * @property Plantcharacteristic[] $plantcharacteristics
 * @property Characteristic[] $characteristics
 * @property Plantphoto[] $plantphotos
 * @property Photo[] $photos
 */
class Plant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'ScientificName', 'IdType', 'IdFamily'], 'required'],
            [['IdType', 'IdFamily'], 'integer'],
            [['Description'], 'string'],
            [['Name', 'ScientificName'], 'string', 'max' => 255],
            [['ScientificName'], 'unique'],
            [['IdFamily'], 'exist', 'skipOnError' => true, 'targetClass' => Botanicalfamily::className(), 'targetAttribute' => ['IdFamily' => 'IdFamily']],
            [['IdType'], 'exist', 'skipOnError' => true, 'targetClass' => Planttype::className(), 'targetAttribute' => ['IdType' => 'IdType']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdPlant' => 'Id Plant',
            'Name' => 'Nombre',
            'ScientificName' => 'Nombre científico',
            'IdType' => 'Tipo de planta',
            'IdFamily' => 'Familia botánica',
            'Description' => 'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMapinformation()
    {
        return $this->hasOne(Mapinformation::className(), ['IdPlant' => 'IdPlant']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamily()
    {
        return $this->hasOne(Botanicalfamily::className(), ['IdFamily' => 'IdFamily']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Planttype::className(), ['IdType' => 'IdType']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantcharacteristics()
    {
        return $this->hasMany(Plantcharacteristic::className(), ['IdPlant' => 'IdPlant']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristics()
    {
        return $this->hasMany(Characteristic::className(), ['IdCharacteristic' => 'IdCharacteristic'])->viaTable('plantcharacteristic', ['IdPlant' => 'IdPlant']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantphotos()
    {
        return $this->hasMany(Plantphoto::className(), ['IdPlant' => 'IdPlant']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['IdPhoto' => 'IdPhoto'])->viaTable('plantphoto', ['IdPlant' => 'IdPlant']);
    }
}
