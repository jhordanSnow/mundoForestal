<?php

namespace backend\models;

use Yii;

class ChangePass extends User
{
    /**
     * @inheritdoc
     */
      public $currentPassword;
      public $newPassword;
      public $newPasswordConfirm;

      public function rules()
      {
          return [

              [['currentPassword', 'newPassword', 'newPasswordConfirm'], 'required'],
              [['currentPassword'], 'validateCurrentPassword'],

              [['newPassword','newPasswordConfirm'], 'string', 'min' => 6],
              [['newPassword','newPasswordConfirm'], 'filter', 'filter' => 'trim'],
              [['newPasswordConfirm'], 'compare', 'compareAttribute' => 'newPassword', 'message' => 'Las contraseñas no coinciden'],
          ];
      }

      public function attributeLabels(){
        return [
          'currentPassword' => 'Contraseña actual',
          'newPassword' => 'Contraseña nueva',
          'newPasswordConfirm' => 'Confirmar contraseña nueva',
        ];
      }

      public function validateCurrentPassword(){
        if (!$this->verifyPassword($this->currentPassword)){
          $this->addError('currentPassword', 'La contraseña actual no coincide.');
          Yii::$app->session->setFlash('error', 'Ocurrió un error al actualizar la contraseña. La contraseña actual no coincide.');
        }
      }

      public function verifyPassword($password){
        $dbPassword = static::findOne(['username' => Yii::$app->user->identity->username])->password_hash;
        return Yii::$app->security->validatePassword($password, $dbPassword);
      }

}
