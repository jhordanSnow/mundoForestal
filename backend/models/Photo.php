<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property int $IdPhoto
 * @property string $Photo
 *
 * @property Plantphoto[] $plantphotos
 * @property Plant[] $plants
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Photo'], 'required'],
            [['Photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdPhoto' => 'Id Photo',
            'Photo' => 'Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantphotos()
    {
        return $this->hasMany(Plantphoto::className(), ['IdPhoto' => 'IdPhoto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlants()
    {
        return $this->hasMany(Plant::className(), ['IdPlant' => 'IdPlant'])->viaTable('plantphoto', ['IdPhoto' => 'IdPhoto']);
    }
}
