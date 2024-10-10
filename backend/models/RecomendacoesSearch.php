<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Recomendacoes;

/**
 * RecomendacoesSearch represents the model behind the search form of `backend\models\Recomendacoes`.
 */
class RecomendacoesSearch extends Recomendacoes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'ID_Boas_Praticas', 'ID_arquivo'], 'integer'],
            [['recomendacao', 'area', 'contexto', 'data', 'justificacao', 'fotografia'], 'safe'],
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
        $query = Recomendacoes::find();

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
            'ID_Boas_Praticas' => $this->ID_Boas_Praticas,
            'ID_arquivo' => $this->ID_arquivo,
        ]);

        $query->andFilterWhere(['like', 'recomendacao', $this->recomendacao])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'contexto', $this->contexto])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'justificacao', $this->justificacao]);

        return $dataProvider;
    }
}
