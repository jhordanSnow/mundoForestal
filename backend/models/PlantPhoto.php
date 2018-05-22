<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plantphoto".
 *
 * @property int $IdPlant
 * @property int $IdPhoto
 *
 * @property Photo $photo
 * @property Plant $plant
 */
class PlantPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plantphoto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdPlant', 'IdPhoto'], 'required'],
            [['IdPlant', 'IdPhoto'], 'integer'],
            [['IdPlant', 'IdPhoto'], 'unique', 'targetAttribute' => ['IdPlant', 'IdPhoto']],
            [['IdPhoto'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::className(), 'targetAttribute' => ['IdPhoto' => 'IdPhoto']],
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
            'IdPhoto' => 'Id Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['IdPhoto' => 'IdPhoto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlant()
    {
        return $this->hasOne(Plant::className(), ['IdPlant' => 'IdPlant']);
    }
}
