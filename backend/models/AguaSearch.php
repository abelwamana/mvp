<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Agua;

/**
 * AguaSearch represents the model behind the search form of `backend\models\Agua`.
 */
class AguaSearch extends Agua {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['Id', 'provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'capacidadeUnidadeID', 'anosGarantia', 'nomeCampoAssociadoGrupoID', 'benHomem', 'benMulher', 'totalAFAbrangidos', 'totalSuino', 'totalCaprino', 'totalBovino', 'comissaoHomem', 'comissaoMulher', 'nTecniAcompanham', 'benHomemTransSocial', 'benMulherTransSocial', 'totalAFCorrespondenteTransSocial', 'valorDiarioBeneUnidadeID', 'nDiasTrabalho', 'userID'], 'integer'],
            [['estadoValidacao','primeiroReporte', 'actualizacao', 'respondente', 'entidade', 'latitude', 'longitude', 'infraEstrutura', 'fonteHidraulica', 'fonteHidraulicaAlternativa', 'servicoAssociado', 'novaConstrucao', 'fimAQueSeDestina', 'realizadoTesteQualidadeAgua', 'entidadeResponsavelConstrucao', 'sistemExtracaoAgua', 'especificacoesTecnInfraExtru', 'temPlacaVisibilidade', 'infraAssociadaCampo', 'anexoFichaTecnInfraExtr', 'estadoObra', 'imagemInfra', 'dataConclusaoObra', 'pontoFoiEntregueObra', 'anexoActaEntrega', 'benCorresponTotalPopulacao', 'grupoGestAgua', 'orientacoesMetodologia', 'comissaoRealizaReuniosFreq', 'grupoFazContribuicoes', 'grupoTemPlanoManutencaoPrev', 'grupoTemPlanoManutencaoUrgen', 'grupoFazParteACA', 'grupoEstaAssociadoBMAS', 'existeAcompaMuniEneAgua', 'nTecniParticipamReunioes', 'metodologiaAdoptada', 'criteriosUtilizadoParaSeleBenef', 'anexoTermoPagamento', 'desafiosONG', 'licoesAprendidadasONG', 'dataVisitaFresan', 'tecnicoResponsavelFresan', 'constantacoeFeitasFresan', 'recomendacoes', 'medidasMitigacaoONG', 'medidasMitigacaoEstado'], 'safe'],
            [['capacidadeInfraestrutura', 'totalHaIrrigados', 'valorDiarioBene', 'totalEntregueTranBen'], 'number'],
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
            $query = Agua::find();
        } else {
            // O usuário não é um administrador, eles só podem ver dados de sua própria entidade
            $query = Agua::find()->where(['entidade' => $userEntidade]);
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
            'capacidadeInfraestrutura' => $this->capacidadeInfraestrutura,
            'capacidadeUnidadeID' => $this->capacidadeUnidadeID,
            'anosGarantia' => $this->anosGarantia,
            'nomeCampoAssociadoGrupoID' => $this->nomeCampoAssociadoGrupoID,
            'dataConclusaoObra' => $this->dataConclusaoObra,
            'benHomem' => $this->benHomem,
            'benMulher' => $this->benMulher,
            'totalAFAbrangidos' => $this->totalAFAbrangidos,
            'totalSuino' => $this->totalSuino,
            'totalCaprino' => $this->totalCaprino,
            'totalBovino' => $this->totalBovino,
            'totalHaIrrigados' => $this->totalHaIrrigados,
            'comissaoHomem' => $this->comissaoHomem,
            'comissaoMulher' => $this->comissaoMulher,
            'nTecniAcompanham' => $this->nTecniAcompanham,
            'benHomemTransSocial' => $this->benHomemTransSocial,
            'benMulherTransSocial' => $this->benMulherTransSocial,
            'totalAFCorrespondenteTransSocial' => $this->totalAFCorrespondenteTransSocial,
            'valorDiarioBene' => $this->valorDiarioBene,
            'valorDiarioBeneUnidadeID' => $this->valorDiarioBeneUnidadeID,
            'nDiasTrabalho' => $this->nDiasTrabalho,
            'totalEntregueTranBen' => $this->totalEntregueTranBen,
            'dataVisitaFresan' => $this->dataVisitaFresan,
            'userID' => $this->userID,
        ]);

        $query->andFilterWhere(['like', 'respondente', $this->respondente])
                ->andFilterWhere(['like', 'entidade', $this->entidade])
                ->andFilterWhere(['like', 'latitude', $this->latitude])
                ->andFilterWhere(['like', 'longitude', $this->longitude])
                ->andFilterWhere(['like', 'infraEstrutura', $this->infraEstrutura])
                ->andFilterWhere(['like', 'fonteHidraulica', $this->fonteHidraulica])
                ->andFilterWhere(['like', 'fonteHidraulicaAlternativa', $this->fonteHidraulicaAlternativa])
                ->andFilterWhere(['like', 'servicoAssociado', $this->servicoAssociado])
                ->andFilterWhere(['like', 'novaConstrucao', $this->novaConstrucao])
                ->andFilterWhere(['like', 'fimAQueSeDestina', $this->fimAQueSeDestina])
                ->andFilterWhere(['like', 'realizadoTesteQualidadeAgua', $this->realizadoTesteQualidadeAgua])
                ->andFilterWhere(['like', 'entidadeResponsavelConstrucao', $this->entidadeResponsavelConstrucao])
                ->andFilterWhere(['like', 'sistemExtracaoAgua', $this->sistemExtracaoAgua])
                ->andFilterWhere(['like', 'especificacoesTecnInfraExtru', $this->especificacoesTecnInfraExtru])
                ->andFilterWhere(['like', 'temPlacaVisibilidade', $this->temPlacaVisibilidade])
                ->andFilterWhere(['like', 'infraAssociadaCampo', $this->infraAssociadaCampo])
                ->andFilterWhere(['like', 'anexoFichaTecnInfraExtr', $this->anexoFichaTecnInfraExtr])
                ->andFilterWhere(['like', 'estadoObra', $this->estadoObra])
                ->andFilterWhere(['like', 'imagemInfra', $this->imagemInfra])
                ->andFilterWhere(['like', 'pontoFoiEntregueObra', $this->pontoFoiEntregueObra])
                ->andFilterWhere(['like', 'anexoActaEntrega', $this->anexoActaEntrega])
                ->andFilterWhere(['like', 'benCorresponTotalPopulacao', $this->benCorresponTotalPopulacao])
                ->andFilterWhere(['like', 'grupoGestAgua', $this->grupoGestAgua])
                ->andFilterWhere(['like', 'orientacoesMetodologia', $this->orientacoesMetodologia])
                ->andFilterWhere(['like', 'comissaoRealizaReuniosFreq', $this->comissaoRealizaReuniosFreq])
                ->andFilterWhere(['like', 'grupoFazContribuicoes', $this->grupoFazContribuicoes])
                ->andFilterWhere(['like', 'grupoTemPlanoManutencaoPrev', $this->grupoTemPlanoManutencaoPrev])
                ->andFilterWhere(['like', 'grupoTemPlanoManutencaoUrgen', $this->grupoTemPlanoManutencaoUrgen])
                ->andFilterWhere(['like', 'grupoFazParteACA', $this->grupoFazParteACA])
                ->andFilterWhere(['like', 'grupoEstaAssociadoBMAS', $this->grupoEstaAssociadoBMAS])
                ->andFilterWhere(['like', 'existeAcompaMuniEneAgua', $this->existeAcompaMuniEneAgua])
                ->andFilterWhere(['like', 'nTecniParticipamReunioes', $this->nTecniParticipamReunioes])
                ->andFilterWhere(['like', 'metodologiaAdoptada', $this->metodologiaAdoptada])
                ->andFilterWhere(['like', 'criteriosUtilizadoParaSeleBenef', $this->criteriosUtilizadoParaSeleBenef])
                ->andFilterWhere(['like', 'anexoTermoPagamento', $this->anexoTermoPagamento])
                ->andFilterWhere(['like', 'desafiosONG', $this->desafiosONG])
                ->andFilterWhere(['like', 'licoesAprendidadasONG', $this->licoesAprendidadasONG])
                ->andFilterWhere(['like', 'tecnicoResponsavelFresan', $this->tecnicoResponsavelFresan])
                ->andFilterWhere(['like', 'constantacoeFeitasFresan', $this->constantacoeFeitasFresan])
                ->andFilterWhere(['like', 'recomendacoes', $this->recomendacoes])
                ->andFilterWhere(['like', 'medidasMitigacaoONG', $this->medidasMitigacaoONG])
                ->andFilterWhere(['like', 'estadoValidacao', $this->estadoValidacao])
                ->andFilterWhere(['like', 'medidasMitigacaoEstado', $this->medidasMitigacaoEstado]);

        return $dataProvider;
    }
}
