<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "terminology".
 *
 * @property int $IdTerminology
 * @property string $Term
 * @property string $Definition
 * @property string $Photo
 */
class Terminology extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFile;
    public static function tableName()
    {
        return 'terminology';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Term', 'Definition'], 'required'],
            [['Definition'], 'string'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['Term', 'Photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdTerminology' => 'Id Terminology',
            'Term' => 'Término',
            'Definition' => 'Definición',
            'Photo' => 'Foto',
            'imageFile' => 'Foto',
        ];
    }

    public function upload()
    {
      if ($this->imageFile == null){
        return $this->save();
      }

      if ($this->Photo != null){
        unlink(Yii::getAlias('@backend'). '/web/Images/'.$this->Photo);
      }

      $this->Photo = Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
      if ($this->save()){
          return $this->imageFile->saveAs(Yii::getAlias('@backend'). '/web/Images/' . $this->Photo);
      } else {
          return false;
      }
    }
}
