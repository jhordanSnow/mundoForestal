<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Terminology;

/**
 * TerminologySearch represents the model behind the search form of `backend\models\Terminology`.
 */
class TerminologySearch extends Terminology
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdTerminology'], 'integer'],
            [['Term', 'Definition', 'Photo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Terminology::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'IdTerminology' => $this->IdTerminology,
        ]);

        $query->andFilterWhere(['like', 'Term', $this->Term])
            ->andFilterWhere(['like', 'Definition', $this->Definition])
            ->andFilterWhere(['like', 'Photo', $this->Photo]);

        return $dataProvider;
    }
}
