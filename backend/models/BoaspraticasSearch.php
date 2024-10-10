<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Boaspraticas;

/**
 * BoaspraticasSearch represents the model behind the search form of `backend\models\Boaspraticas`.
 */
class BoaspraticasSearch extends Boaspraticas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'provinciaID', 'municipioID', 'comunaID', 'recomendacoesID', 'estrategia_de_sustentabilidadeID', 'arquivoID', 'aprovado'], 'integer'],
            [['boapratica', 'justificacao', 'area', 'localidade', 'latitude', 'longitude', 'entidadepropoente', 'entidadeimplementadora', 'fotografia'], 'safe'],
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
        $query = Boaspraticas::find();

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
            'provinciaID' => $this->provinciaID,
            'municipioID' => $this->municipioID,
            'comunaID' => $this->comunaID,
            'recomendacoesID' => $this->recomendacoesID,
            'estrategia_de_sustentabilidadeID' => $this->estrategia_de_sustentabilidadeID,
            'arquivoID' => $this->arquivoID,
            'aprovado' => $this->aprovado,
        ]);

        $query->andFilterWhere(['like', 'boapratica', $this->boapratica])
            ->andFilterWhere(['like', 'justificacao', $this->justificacao])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'localidade', $this->localidade])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'entidadepropoente', $this->entidadepropoente])
            ->andFilterWhere(['like', 'entidadeimplementadora', $this->entidadeimplementadora])
            ->andFilterWhere(['like', 'fotografia', $this->fotografia]);

        return $dataProvider;
    }
}
