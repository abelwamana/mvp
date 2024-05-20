<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Doccomunicacao;

/**
 * DoccomunicacaoSearch represents the model behind the search form of `backend\models\Doccomunicacao`.
 */
class DoccomunicacaoSearch extends Doccomunicacao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'provinciaID', 'municipioID', 'classificacaoDocumentoID', 'qtdTotalProduto', 'userID'], 'integer'],
            [['primeiroReporte', 'actualizacao', 'repondente', 'entidade', 'actividade', 'nomeDocumentoArtigo', 'areaTematica', 'descricaoDocumentoArtigo', 'audienciaProduto', 'estado', 'dataConclusao', 'documentoDisponivel', 'documentoCumpreNormasPublicacao', 'documentoValidado', 'anexo', 'hiperlink', 'desafiosImplementacao', 'licoesAprendidas', 'dataMonitoria', 'tecnicoResponsavel', 'recomendacoes', 'estadoCumprimento', 'medidasMitigacaoONG', 'medidasMitigacaoEstado'], 'safe'],
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
 $user = \Yii::$app->user->identity;
        $userEntidade = $user->entidade;
        $isAdmin = \Yii::$app->user->isGuest ? false : \Yii::$app->user->can("Permissão de Administrador");
        if ($isAdmin) {
            // O usuário é um administrador, portanto, eles podem visualizar todos os dados
            $query = Doccomunicacao::find();
        } else {
            // O usuário não é um administrador, eles só podem ver dados de sua própria entidade
            $query = Doccomunicacao::find()->where(['entidade' => $userEntidade]);
        }
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
            'primeiroReporte' => $this->primeiroReporte,
            'actualizacao' => $this->actualizacao,
            'classificacaoDocumentoID' => $this->classificacaoDocumentoID,
            'qtdTotalProduto' => $this->qtdTotalProduto,
            'dataConclusao' => $this->dataConclusao,
            'dataMonitoria' => $this->dataMonitoria,
            'userID' => $this->userID,
        ]);

        $query->andFilterWhere(['like', 'repondente', $this->repondente])
            ->andFilterWhere(['like', 'entidade', $this->entidade])
            ->andFilterWhere(['like', 'actividade', $this->actividade])
            ->andFilterWhere(['like', 'nomeDocumentoArtigo', $this->nomeDocumentoArtigo])
            ->andFilterWhere(['like', 'areaTematica', $this->areaTematica])
            ->andFilterWhere(['like', 'descricaoDocumentoArtigo', $this->descricaoDocumentoArtigo])
            ->andFilterWhere(['like', 'audienciaProduto', $this->audienciaProduto])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'documentoDisponivel', $this->documentoDisponivel])
            ->andFilterWhere(['like', 'documentoCumpreNormasPublicacao', $this->documentoCumpreNormasPublicacao])
            ->andFilterWhere(['like', 'documentoValidado', $this->documentoValidado])
            ->andFilterWhere(['like', 'anexo', $this->anexo])
            ->andFilterWhere(['like', 'hiperlink', $this->hiperlink])
            ->andFilterWhere(['like', 'desafiosImplementacao', $this->desafiosImplementacao])
            ->andFilterWhere(['like', 'licoesAprendidas', $this->licoesAprendidas])
            ->andFilterWhere(['like', 'tecnicoResponsavel', $this->tecnicoResponsavel])
            ->andFilterWhere(['like', 'recomendacoes', $this->recomendacoes])
            ->andFilterWhere(['like', 'estadoCumprimento', $this->estadoCumprimento])
            ->andFilterWhere(['like', 'medidasMitigacaoONG', $this->medidasMitigacaoONG])
            ->andFilterWhere(['like', 'medidasMitigacaoEstado', $this->medidasMitigacaoEstado]);

        return $dataProvider;
    }
}
