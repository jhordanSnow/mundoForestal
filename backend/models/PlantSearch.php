<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Plant;

/**
 * PlantSearch represents the model behind the search form of `backend\models\Plant`.
 */
class PlantSearch extends Plant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdPlant', 'IdFamily'], 'integer'],
            [['Name', 'ScientificName', 'Description'], 'safe'],
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
        $query = Plant::find();

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
            'IdPlant' => $this->IdPlant,
            'IdFamily' => $this->IdFamily,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'ScientificName', $this->ScientificName])
            ->andFilterWhere(['like', 'Description', $this->Description]);

        return $dataProvider;
    }
}
