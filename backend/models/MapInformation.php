<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mapinformation".
 *
 * @property int $IdMapInformation
 * @property int $IdPlant
 * @property string $Polygon
 *
 * @property Plant $plant
 */
class Mapinformation extends \yii\db\ActiveRecord
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
            [['Polygon'], 'string'],
            [['IdPlant'], 'exist', 'skipOnError' => true, 'targetClass' => Plant::className(), 'targetAttribute' => ['IdPlant' => 'IdPlant']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdMapInformation' => 'Id Map Information',
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
