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
    public $photos;

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
            [['Photo'], 'string', 'max' => 255],
            [['photos'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 420],

        ];
    }

    public function upload($idPlant, $listInserted)
    {
      if ($this->validate()) {
        $path = Yii::getAlias('@backend'). '/web/Images/';
        foreach ($this->photos as $file) {
          if (in_array($file->name, $listInserted)){
            $modelPhoto = new Photo();
            $modelPhoto->Photo = Yii::$app->security->generateRandomString() . '.' . $file->extension;
            if ($modelPhoto->save()){
              $modelChar = new PlantPhoto();
              $modelChar->IdPlant = $idPlant;
              $modelChar->IdPhoto = $modelPhoto->IdPhoto;
              if (!$modelChar->save()){
                return false;
              }
            }else{
              return false;
            }
            $file->saveAs($path . $modelPhoto->Photo);
          }
        }
        return true;
      } else {
        return false;
      }
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
