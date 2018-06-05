<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "botanicalfamily".
 *
 * @property int $IdFamily
 * @property string $Name
 *
 * @property Plant[] $plants
 */
class Botanicalfamily extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'botanicalfamily';
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
            'IdFamily' => 'Id Family',
            'Name' => 'Familia botánica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlants()
    {
        return $this->hasMany(Plant::className(), ['IdFamily' => 'IdFamily']);
    }
}
