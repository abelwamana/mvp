<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Comuna;

/**
 * ComunaSearch represents the model behind the search form of `backend\models\Comuna`.
 */
class ComunaSearch extends Comuna
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'municipioID'], 'integer'],
            [['nomeComuna'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Comuna::find();

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
            'Id' => $this->Id,
            'municipioID' => $this->municipioID,
        ]);

        $query->andFilterWhere(['like', 'nomeComuna', $this->nomeComuna]);

        return $dataProvider;
    }
}
