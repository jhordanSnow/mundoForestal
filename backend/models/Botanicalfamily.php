<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "botanicalfamily".
 *
 * @property int $IdFamily
 * @property string $Name
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
            'Name' => 'Name',
        ];
    }
}
