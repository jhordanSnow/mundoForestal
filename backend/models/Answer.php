<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property int $IdAnswer
 * @property int $IdAdmin
 * @property int $IdQuestion
 * @property string $Answer
 * @property string $Photo
 *
 * @property Admin $admin
 * @property Question $question
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFile;

    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdAdmin', 'IdQuestion', 'Answer'], 'required'],
            [['IdAdmin', 'IdQuestion'], 'integer'],
            [['Answer'], 'string'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['Photo'], 'string', 'max' => 255],
            [['IdAdmin'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['IdAdmin' => 'IdUsuario']],
            [['IdQuestion'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['IdQuestion' => 'IdQuestion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdAnswer' => 'Id Answer',
            'IdAdmin' => 'Id Admin',
            'IdQuestion' => 'Id Question',
            'Answer' => 'Respuesta',
            'Photo' => 'Photo',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['IdUsuario' => 'IdAdmin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['IdQuestion' => 'IdQuestion']);
    }
}
