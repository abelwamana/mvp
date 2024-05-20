<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Reforcoinstitucional;

/**
 * ReforcoinstitucionalSearch represents the model behind the search form of `backend\models\Reforcoinstitucional`.
 */
class ReforcoinstitucionalSearch extends Reforcoinstitucional {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['Id', 'provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'nSessoesPublicoAlvo', 'nHorasSessoes', 'participantesFormacaoHomem', 'participantesFormacaoMulher', 'participantesFormacaoTrimestre', 'qtdEquipEntregues', 'nAnimaisVacinadosCampanha', 'nmeiosDistriEntiCampanhaVacinacao', 'trataGadoForamMapeadosHomem', 'trataGadoForamMapeadosMulher', 'nSessoesRealiFormGado', 'nTotalHorasFormacaoGado', 'participantesFormacaoGadoHomem', 'participantesFormacaoGadoMulher', 'totalCabecaGado', 'nTotalKitDistribuido', 'userID'], 'integer'],
            [['primeiroReporte', 'actualizacao', 'respondente', 'entidade', 'latitude', 'longitude', 'entidadeApoiada', 'apoioCapacitacao', 'temaAbordadoSessoes', 'nSessoesPubliTrimestre', 'anexoProgramaFormacao', 'descricaoEquipamentos', 'anexoTermoEntreEquipamento', 'meiosEntreguEntiCampanhaVacinacaoDesc', 'anexoTermoEntrMeiosCampanhaVacinacao', 'trataGadoForamMapeadosTrim', 'temaAbordadoFormaGado', 'nSessoesRealiFormGadoTrimestre', 'participantesFormacaoGadoTrimestre', 'anexoProgramaFormaGado', 'distriKitVeterinaria', 'composicaoKitVeter', 'anexoKitDistri', 'desafiosImplementacaoONG', 'licoesAprendidasONG', 'dataVisitaFresan', 'tecnicoResponsavelFresan', 'constantacoeFeitasFresan', 'recomendacoes', 'medidasMitigacaoONG', 'medidasMitigacaoEstado'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        
        $user = \Yii::$app->user->identity;
        $userEntidade = $user->entidade;
        $isAdmin = \Yii::$app->user->isGuest ? false : \Yii::$app->user->can("Permissão de Administrador");
        if ($isAdmin) {
            // O usuário é um administrador, portanto, eles podem visualizar todos os dados
            $query = Reforcoinstitucional::find();
        } else {
            // O usuário não é um administrador, eles só podem ver dados de sua própria entidade
            $query = Reforcoinstitucional::find()->where(['entidade' => $userEntidade]);
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
            'comunaID' => $this->comunaID,
            'localidadeID' => $this->localidadeID,
            'nSessoesPublicoAlvo' => $this->nSessoesPublicoAlvo,
            'nSessoesPubliTrimestre' => $this->nSessoesPubliTrimestre,
            'nHorasSessoes' => $this->nHorasSessoes,
            'participantesFormacaoHomem' => $this->participantesFormacaoHomem,
            'participantesFormacaoMulher' => $this->participantesFormacaoMulher,
            'participantesFormacaoTrimestre' => $this->participantesFormacaoTrimestre,
            'qtdEquipEntregues' => $this->qtdEquipEntregues,
            'nAnimaisVacinadosCampanha' => $this->nAnimaisVacinadosCampanha,
            'nmeiosDistriEntiCampanhaVacinacao' => $this->nmeiosDistriEntiCampanhaVacinacao,
            'trataGadoForamMapeadosHomem' => $this->trataGadoForamMapeadosHomem,
            'trataGadoForamMapeadosMulher' => $this->trataGadoForamMapeadosMulher,
            'trataGadoForamMapeadosTrim' => $this->trataGadoForamMapeadosTrim,
            'nSessoesRealiFormGado' => $this->nSessoesRealiFormGado,
            'nSessoesRealiFormGadoTrimestre' => $this->nSessoesRealiFormGadoTrimestre,
            'nTotalHorasFormacaoGado' => $this->nTotalHorasFormacaoGado,
            'participantesFormacaoGadoHomem' => $this->participantesFormacaoGadoHomem,
            'participantesFormacaoGadoMulher' => $this->participantesFormacaoGadoMulher,
            'participantesFormacaoGadoTrimestre' => $this->participantesFormacaoGadoTrimestre,
            'totalCabecaGado' => $this->totalCabecaGado,
            'nTotalKitDistribuido' => $this->nTotalKitDistribuido,
            'dataVisitaFresan' => $this->dataVisitaFresan,
            'userID' => $this->userID,
        ]);

        $query->andFilterWhere(['like', 'respondente', $this->respondente])
                ->andFilterWhere(['like', 'entidade', $this->entidade])
                ->andFilterWhere(['like', 'latitude', $this->latitude])
                ->andFilterWhere(['like', 'longitude', $this->longitude])
                ->andFilterWhere(['like', 'entidadeApoiada', $this->entidadeApoiada])
                ->andFilterWhere(['like', 'apoioCapacitacao', $this->apoioCapacitacao])
                ->andFilterWhere(['like', 'temaAbordadoSessoes', $this->temaAbordadoSessoes])
                ->andFilterWhere(['like', 'anexoProgramaFormacao', $this->anexoProgramaFormacao])
                ->andFilterWhere(['like', 'descricaoEquipamentos', $this->descricaoEquipamentos])
                ->andFilterWhere(['like', 'anexoTermoEntreEquipamento', $this->anexoTermoEntreEquipamento])
                ->andFilterWhere(['like', 'meiosEntreguEntiCampanhaVacinacaoDesc', $this->meiosEntreguEntiCampanhaVacinacaoDesc])
                ->andFilterWhere(['like', 'anexoTermoEntrMeiosCampanhaVacinacao', $this->anexoTermoEntrMeiosCampanhaVacinacao])
                ->andFilterWhere(['like', 'temaAbordadoFormaGado', $this->temaAbordadoFormaGado])
                ->andFilterWhere(['like', 'anexoProgramaFormaGado', $this->anexoProgramaFormaGado])
                ->andFilterWhere(['like', 'distriKitVeterinaria', $this->distriKitVeterinaria])
                ->andFilterWhere(['like', 'composicaoKitVeter', $this->composicaoKitVeter])
                ->andFilterWhere(['like', 'anexoKitDistri', $this->anexoKitDistri])
                ->andFilterWhere(['like', 'desafiosImplementacaoONG', $this->desafiosImplementacaoONG])
                ->andFilterWhere(['like', 'licoesAprendidasONG', $this->licoesAprendidasONG])
                ->andFilterWhere(['like', 'tecnicoResponsavelFresan', $this->tecnicoResponsavelFresan])
                ->andFilterWhere(['like', 'constantacoeFeitasFresan', $this->constantacoeFeitasFresan])
                ->andFilterWhere(['like', 'recomendacoes', $this->recomendacoes])
                ->andFilterWhere(['like', 'medidasMitigacaoONG', $this->medidasMitigacaoONG])
                ->andFilterWhere(['like', 'medidasMitigacaoEstado', $this->medidasMitigacaoEstado]);

        return $dataProvider;
    }
}
