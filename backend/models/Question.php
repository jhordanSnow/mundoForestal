<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $IdQuestion
 * @property int $IdUser
 * @property int $IdCategory
 * @property string $Question
 * @property int $state
 *
 * @property User $user
 * @property Questioncategory $category
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdUser', 'IdCategory', 'Question'], 'required'],
            [['IdUser', 'IdCategory', 'state'], 'integer'],
            [['Question'], 'string'],
            [['IdUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['IdUser' => 'id']],
            [['IdCategory'], 'exist', 'skipOnError' => true, 'targetClass' => Questioncategory::className(), 'targetAttribute' => ['IdCategory' => 'IdCategory']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdQuestion' => 'Id Question',
            'IdUser' => 'Id User',
            'IdCategory' => 'Id Category',
            'Question' => 'Question',
            'state' => 'State',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'IdUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Questioncategory::className(), ['IdCategory' => 'IdCategory']);
    }
}
