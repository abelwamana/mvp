<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Eventos;

/**
 * EventosSearch represents the model behind the search form of `backend\models\Eventos`.
 */
class EventosSearch extends Eventos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'provinciaID', 'municipioID', 'participantesHomem', 'participantesMulher', 'userID'], 'integer'],
            [['primeiroReporte', 'actualizacao', 'respondente', 'entidade', 'descricaoTema', 'estadoDescricao', 'parceiro', 'dataRelacionadaEstadForum', 'tematicaAbordada', 'orador', 'localLink', 'publicoAlvo', 'anexoForum', 'desafiosONG', 'licoesONG', 'dataVisitaFresan', 'tecnicoResponsavelFresan', 'constantacoeFeitasFresan', 'recomendacoes', 'medidasMitigacaoONG', 'medidasMitigacaoEstado'], 'safe'],
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
            $query = Eventos::find();
        } else {
            // O usuário não é um administrador, eles só podem ver dados de sua própria entidade
            $query = Eventos::find()->where(['entidade' => $userEntidade]);
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
            'primeiroReporte' => $this->primeiroReporte,
            'actualizacao' => $this->actualizacao,
            'provinciaID' => $this->provinciaID,
            'municipioID' => $this->municipioID,
            'dataRelacionadaEstadForum' => $this->dataRelacionadaEstadForum,
            'participantesHomem' => $this->participantesHomem,
            'participantesMulher' => $this->participantesMulher,
            'dataVisitaFresan' => $this->dataVisitaFresan,
            'userID' => $this->userID,
        ]);

        $query->andFilterWhere(['like', 'respondente', $this->respondente])
            ->andFilterWhere(['like', 'entidade', $this->entidade])
            ->andFilterWhere(['like', 'descricaoTema', $this->descricaoTema])
            ->andFilterWhere(['like', 'estadoDescricao', $this->estadoDescricao])
            ->andFilterWhere(['like', 'parceiro', $this->parceiro])
            ->andFilterWhere(['like', 'tematicaAbordada', $this->tematicaAbordada])
            ->andFilterWhere(['like', 'orador', $this->orador])
            ->andFilterWhere(['like', 'localLink', $this->localLink])
            ->andFilterWhere(['like', 'publicoAlvo', $this->publicoAlvo])
            ->andFilterWhere(['like', 'anexoForum', $this->anexoForum])
            ->andFilterWhere(['like', 'desafiosONG', $this->desafiosONG])
            ->andFilterWhere(['like', 'licoesONG', $this->licoesONG])
            ->andFilterWhere(['like', 'tecnicoResponsavelFresan', $this->tecnicoResponsavelFresan])
            ->andFilterWhere(['like', 'constantacoeFeitasFresan', $this->constantacoeFeitasFresan])
            ->andFilterWhere(['like', 'recomendacoes', $this->recomendacoes])
            ->andFilterWhere(['like', 'medidasMitigacaoONG', $this->medidasMitigacaoONG])
            ->andFilterWhere(['like', 'medidasMitigacaoEstado', $this->medidasMitigacaoEstado]);

        return $dataProvider;
    }
}
