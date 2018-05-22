<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mapinformation".
 *
 * @property int $IdPlant
 * @property string $Polygon
 *
 * @property Plant $plant
 */
class MapInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapinformation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdPlant', 'Polygon'], 'required'],
            [['IdPlant'], 'integer'],
            [['Polygon'], 'string', 'max' => 255],
            [['IdPlant'], 'unique'],
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
            'Polygon' => 'Polygon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlant()
    {
        return $this->hasOne(Plant::className(), ['IdPlant' => 'IdPlant']);
    }
}
