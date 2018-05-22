<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "planttype".
 *
 * @property int $IdType
 * @property string $Name
 * @property string $Description
 *
 * @property Plant[] $plants
 */
class Planttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planttype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['Description'], 'string'],
            [['Name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdType' => 'Id Type',
            'Name' => 'Name',
            'Description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlants()
    {
        return $this->hasMany(Plant::className(), ['IdType' => 'IdType']);
    }
}
