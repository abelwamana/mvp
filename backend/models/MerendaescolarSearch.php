<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Merendaescolar;

/**
 * MerendaescolarSearch represents the model behind the search form of `backend\models\Merendaescolar`.
 */
class MerendaescolarSearch extends Merendaescolar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'nTotalCestas', 'nMeredendaEscolarHomem', 'nMeredendaEscolarMulher', 'userID'], 'integer'],
            [['nTotalCestasTrimestre', 'nomeEscolaMerendaEscolar', 'anexoTermoEntregaMerendaEscolar', 'primeiroReporte', 'actualizacao', 'respondente', 'entidade', 'latitude', 'longitude', 'desafiosImplementacaoONG', 'licoesImplementacaoONG', 'dataVisitaFresan', 'tecnicoResponsavelFresan', 'constatacoesFeitasFresan', 'recomendacoesPrincipaisFresan', 'medidasMitigacaoONG', 'medidasMitigacaoEstado', 'estadoValidacao', 'criadoPor', 'actualizadoPor', 'createdAt', 'UpdatedAt'], 'safe'],
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
        $query = Merendaescolar::find();

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
            'localidadeID' => $this->localidadeID,
            'nTotalCestas' => $this->nTotalCestas,
            'nTotalCestasTrimestre' => $this->nTotalCestasTrimestre,
            'nMeredendaEscolarHomem' => $this->nMeredendaEscolarHomem,
            'nMeredendaEscolarMulher' => $this->nMeredendaEscolarMulher,
            'primeiroReporte' => $this->primeiroReporte,
            'actualizacao' => $this->actualizacao,
            'dataVisitaFresan' => $this->dataVisitaFresan,
            'userID' => $this->userID,
            'createdAt' => $this->createdAt,
            'UpdatedAt' => $this->UpdatedAt,
        ]);

        $query->andFilterWhere(['like', 'nomeEscolaMerendaEscolar', $this->nomeEscolaMerendaEscolar])
            ->andFilterWhere(['like', 'anexoTermoEntregaMerendaEscolar', $this->anexoTermoEntregaMerendaEscolar])
            ->andFilterWhere(['like', 'respondente', $this->respondente])
            ->andFilterWhere(['like', 'entidade', $this->entidade])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'desafiosImplementacaoONG', $this->desafiosImplementacaoONG])
            ->andFilterWhere(['like', 'licoesImplementacaoONG', $this->licoesImplementacaoONG])
            ->andFilterWhere(['like', 'tecnicoResponsavelFresan', $this->tecnicoResponsavelFresan])
            ->andFilterWhere(['like', 'constatacoesFeitasFresan', $this->constatacoesFeitasFresan])
            ->andFilterWhere(['like', 'recomendacoesPrincipaisFresan', $this->recomendacoesPrincipaisFresan])
            ->andFilterWhere(['like', 'medidasMitigacaoONG', $this->medidasMitigacaoONG])
            ->andFilterWhere(['like', 'medidasMitigacaoEstado', $this->medidasMitigacaoEstado])
            ->andFilterWhere(['like', 'estadoValidacao', $this->estadoValidacao])
            ->andFilterWhere(['like', 'criadoPor', $this->criadoPor])
            ->andFilterWhere(['like', 'actualizadoPor', $this->actualizadoPor]);

        return $dataProvider;
    }
}
