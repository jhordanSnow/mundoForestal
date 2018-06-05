<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "questioncategory".
 *
 * @property int $IdCategory
 * @property string $Name
 *
 * @property Question[] $questions
 */
class QuestionCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questioncategory';
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
            'IdCategory' => 'Id Category',
            'Name' => 'Categoria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['IdCategory' => 'IdCategory']);
    }
}
