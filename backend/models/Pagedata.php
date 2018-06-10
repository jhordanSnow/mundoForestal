<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pagedata".
 *
 * @property int $IdData
 * @property string $Title
 * @property string $Data
 */
class Pagedata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagedata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Title', 'Data'], 'required'],
            [['Data'], 'string'],
            [['Title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdData' => 'Id Data',
            'Title' => 'Título',
            'Data' => 'Contenido',
        ];
    }
}
