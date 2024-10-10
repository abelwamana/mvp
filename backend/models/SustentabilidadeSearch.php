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
            [['Id', 'ano', 'ID_recomendacoes', 'ID_boas_praticas', 'ID_arquivo'], 'integer'],
            [['estrategia', 'entidade', 'fotografia', 'documento'], 'safe'],
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
            'ano' => $this->ano,
            'ID_recomendacoes' => $this->ID_recomendacoes,
            'ID_boas_praticas' => $this->ID_boas_praticas,
            'ID_arquivo' => $this->ID_arquivo,
        ]);

        $query->andFilterWhere(['like', 'estrategia', $this->estrategia])
            ->andFilterWhere(['like', 'entidade', $this->entidade])
            ->andFilterWhere(['like', 'fotografia', $this->fotografia])
            ->andFilterWhere(['like', 'documento', $this->documento]);

        return $dataProvider;
    }
}
