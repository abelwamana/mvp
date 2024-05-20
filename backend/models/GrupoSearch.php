<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Grupo;

/**
 * GrupoSearch represents the model behind the search form of `backend\models\Grupo`.
 */
class GrupoSearch extends Grupo {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['Id', 'provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'primeiraFinalidadeID', 'segundaFinalidadeID', 'terceiraFinalidadeID3', 'beneficiariosHomem', 'beneficiariosMulher', 'representaQtsAF', 'bovinos', 'caprinos', 'ovinos', 'membrosContribuemRegular', 'numEvenTrocExperCamponeses', 'nLavrasPartiReplicaPraticaInovadora', 'nSessoeTeoPrat', 'nRedes', 'qtdSementesEntrBancoKG', 'camponesesRecebemSementesBanc', 'camponesesReebolsaSementesBanc', 'homemCoop', 'mulherCoop', 'nSessoesFormacoes', 'nReunioesOrgSoc', 'nCamponesesHomens', 'nCamponesesMulheres', 'nKitEntregue', 'desafiosAprendidasONG', 'licoesAprendidasONG', 'medidasMitigacaoEstado', 'userID'], 'integer'],
            [['primeiroReporte', 'actualizacaoID', 'respondente', 'entidade', 'latitude', 'longitude', 'apoioAgricola', 'nomeGrupo', 'grupoExistia', 'metodologiaAgricola', 'outraMetodologiaAgricola', 'segueMetodologiaECA', 'anoInicioApoio', 'primeiroAnoAgriColheita', 'ultimoAnoAgriColheita', 'estagioFaseEncontra', 'validadaIDA', 'grupoEntregueEntPubl', 'dataGrupoEntregue', 'anexoAutoEntrega', 'listaMembros', 'temComissaoGestao', 'temReguInterno', 'temFacilitador', 'temParcelasAprendizagem', 'temCerco', 'temPlacaIdentificacao', 'temCadernoRegisto', 'contribuicaoFundoManeio', 'frequenciaContribuicoes', 'fundoManeioSaldoPositivo', 'temPlanoActividade', 'frequenciaSessoes', 'localReunioes', 'implementaASAE', 'produzBioInsecticida', 'usaBioFertilizante', 'integraSistemaAgrosilvopastoril', 'metodologiaJangosPastoris', 'assistTecnApoioProducao', 'placaVisibilidade', 'autoridadeTradEnvolvida', 'administracaoEnvolvida', 'isvEnvolvida', 'idfEnvolvida', 'idaEdaEnvolvida', 'iiaEnvolvida', 'iivEnvolvida', 'outroEnvolvida', 'primeiraPraticaInovadora', 'segundaPraticaInovadora', 'terceiraPraticaInovadora', 'replicaPraticaInovadora', 'principalConstrangimento', 'temas', 'tema1Ciclo', 'tema2Ciclo', 'tema3Ciclo', 'outroTema', 'nSessoeTeoPratTrimes', 'diaSessaoEca', 'percentParticipacao', 'pontoAguaDispoIrri', 'previstConstrSistIrrig', 'sistemaIrriUtilizad', 'classificacacaoCampo', 'houveExcedente', 'culturasHouveExcedente', 'trimestreExcedente', 'destinoExcedente', 'facilitaLigacoesEntreProdutores', 'realizaEventosSobreProdutos', 'apoioDistrProdCamponeses', 'dataApoios', 'tipoEvento', 'descricaoRede', 'coberturaGeograficaRede', 'comerciantesEnvolvidos', 'finalidadeRede', 'frequenciaRede', 'resultadoInicRede', 'desafios', 'licoesAprendidas', 'temBancoSementes', 'fazMultiSementes', 'culturasDispoBancSementes', 'trimSementesBanco', 'trimestreSementesEntrCamponeses', 'trimestreSementesReembPelosCamponeses', 'trimestreSementesDisponiveisBanco', 'estadoBancoSementes', 'temRegistoBancSementes', 'resultadIniciBancoSem', 'desafiosBancoSem', 'licoesAprendiBancSem', 'classifCooper', 'membrCampoAgrFormal', 'coopExistia', 'coopLegalizada', 'coopLegalFresan', 'tipoApoioDadoProjec', 'realizaFormacao', 'temaSessoesFormacao', 'trimesSessoesFormacoes', 'orgaosSociaisDefinidos', 'nReunioesOrgSocTrimestre', 'membrosFazemContrReg', 'coopTemFundoManeioPositivo', 'propositoApoiarTransformacao', 'realizaTransforDescriProduto', 'propositoApoiarArmazen', 'propositoApoiarFactorProd', 'propositoApoiarComercializacao', 'propositoApoiarMembroCaixaCom', 'desafiosCooperativas', 'licoesAprendidasCooperativas', 'tecnologiaProjectoPioto', 'kitClassificacao', 'kitDistribuidoDescric', 'pontoSituacaoProjecto', 'comercializacao', 'resultadoInicPiloto', 'desafiosPiloto', 'licoesAprendidasPiloto', 'realizadaSinsibilizacoesEAN', 'realizadasSensibilizacoesCulinarias', 'realizadoRastreios', 'dataVisitaUIC', 'tecnicoResponsavelUIC', 'constatacoesFeitasUIC', 'recomendacoesFeitasUIC', 'medidasMitigacaoONG'], 'safe'],
            [['areaTotalCampoAgro', 'areaCultivadaCampoAgro', 'areaInsPlantInovadorasCampoAgro', 'areaIrrigada', 'qtdExcedente', 'totalSementesEntrCamponeses', 'totalSementesReembPelosCamponeses', 'qtdSementesDisponiveisBanco', 'qtdProdComercializadoKG'], 'number'],
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
            $query = Grupo::find();
        } else {
            // O usuário não é um administrador, eles só podem ver dados de sua própria entidade
            $query = Grupo::find()->where(['entidade' => $userEntidade]);
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
            'actualizacaoID' => $this->actualizacaoID,
            'provinciaID' => $this->provinciaID,
            'municipioID' => $this->municipioID,
            'comunaID' => $this->comunaID,
            'localidadeID' => $this->localidadeID,
            'anoInicioApoio' => $this->anoInicioApoio,
            'primeiroAnoAgriColheita' => $this->primeiroAnoAgriColheita,
            'ultimoAnoAgriColheita' => $this->ultimoAnoAgriColheita,
            'dataGrupoEntregue' => $this->dataGrupoEntregue,
            'primeiraFinalidadeID' => $this->primeiraFinalidadeID,
            'segundaFinalidadeID' => $this->segundaFinalidadeID,
            'terceiraFinalidadeID3' => $this->terceiraFinalidadeID3,
            'beneficiariosHomem' => $this->beneficiariosHomem,
            'beneficiariosMulher' => $this->beneficiariosMulher,
            'representaQtsAF' => $this->representaQtsAF,
            'bovinos' => $this->bovinos,
            'caprinos' => $this->caprinos,
            'ovinos' => $this->ovinos,
            'membrosContribuemRegular' => $this->membrosContribuemRegular,
            'numEvenTrocExperCamponeses' => $this->numEvenTrocExperCamponeses,
            'nLavrasPartiReplicaPraticaInovadora' => $this->nLavrasPartiReplicaPraticaInovadora,
            'nSessoeTeoPrat' => $this->nSessoeTeoPrat,
            'nSessoeTeoPratTrimes' => $this->nSessoeTeoPratTrimes,
            'areaTotalCampoAgro' => $this->areaTotalCampoAgro,
            'areaCultivadaCampoAgro' => $this->areaCultivadaCampoAgro,
            'areaInsPlantInovadorasCampoAgro' => $this->areaInsPlantInovadorasCampoAgro,
            'areaIrrigada' => $this->areaIrrigada,
            'qtdExcedente' => $this->qtdExcedente,
            'trimestreExcedente' => $this->trimestreExcedente,
            'nRedes' => $this->nRedes,
            'qtdSementesEntrBancoKG' => $this->qtdSementesEntrBancoKG,
            'trimSementesBanco' => $this->trimSementesBanco,
            'totalSementesEntrCamponeses' => $this->totalSementesEntrCamponeses,
            'trimestreSementesEntrCamponeses' => $this->trimestreSementesEntrCamponeses,
            'totalSementesReembPelosCamponeses' => $this->totalSementesReembPelosCamponeses,
            'trimestreSementesReembPelosCamponeses' => $this->trimestreSementesReembPelosCamponeses,
            'qtdSementesDisponiveisBanco' => $this->qtdSementesDisponiveisBanco,
            'trimestreSementesDisponiveisBanco' => $this->trimestreSementesDisponiveisBanco,
            'camponesesRecebemSementesBanc' => $this->camponesesRecebemSementesBanc,
            'camponesesReebolsaSementesBanc' => $this->camponesesReebolsaSementesBanc,
            'homemCoop' => $this->homemCoop,
            'mulherCoop' => $this->mulherCoop,
            'nSessoesFormacoes' => $this->nSessoesFormacoes,
            'trimesSessoesFormacoes' => $this->trimesSessoesFormacoes,
            'nReunioesOrgSoc' => $this->nReunioesOrgSoc,
            'nReunioesOrgSocTrimestre' => $this->nReunioesOrgSocTrimestre,
            'nCamponesesHomens' => $this->nCamponesesHomens,
            'nCamponesesMulheres' => $this->nCamponesesMulheres,
            'nKitEntregue' => $this->nKitEntregue,
            'qtdProdComercializadoKG' => $this->qtdProdComercializadoKG,
            'desafiosAprendidasONG' => $this->desafiosAprendidasONG,
            'licoesAprendidasONG' => $this->licoesAprendidasONG,
            'dataVisitaUIC' => $this->dataVisitaUIC,
            'medidasMitigacaoEstado' => $this->medidasMitigacaoEstado,
            'userID' => $this->userID,
        ]);

        $query->andFilterWhere(['like', 'respondente', $this->respondente])
                ->andFilterWhere(['like', 'entidade', $this->entidade])
                ->andFilterWhere(['like', 'latitude', $this->latitude])
                ->andFilterWhere(['like', 'longitude', $this->longitude])
                ->andFilterWhere(['like', 'apoioAgricola', $this->apoioAgricola])
                ->andFilterWhere(['like', 'nomeGrupo', $this->nomeGrupo])
                ->andFilterWhere(['like', 'grupoExistia', $this->grupoExistia])
                ->andFilterWhere(['like', 'metodologiaAgricola', $this->metodologiaAgricola])
                ->andFilterWhere(['like', 'outraMetodologiaAgricola', $this->outraMetodologiaAgricola])
                ->andFilterWhere(['like', 'segueMetodologiaECA', $this->segueMetodologiaECA])
                ->andFilterWhere(['like', 'estagioFaseEncontra', $this->estagioFaseEncontra])
                ->andFilterWhere(['like', 'validadaIDA', $this->validadaIDA])
                ->andFilterWhere(['like', 'grupoEntregueEntPubl', $this->grupoEntregueEntPubl])
                ->andFilterWhere(['like', 'anexoAutoEntrega', $this->anexoAutoEntrega])
                ->andFilterWhere(['like', 'listaMembros', $this->listaMembros])
                ->andFilterWhere(['like', 'temComissaoGestao', $this->temComissaoGestao])
                ->andFilterWhere(['like', 'temReguInterno', $this->temReguInterno])
                ->andFilterWhere(['like', 'temFacilitador', $this->temFacilitador])
                ->andFilterWhere(['like', 'temParcelasAprendizagem', $this->temParcelasAprendizagem])
                ->andFilterWhere(['like', 'temCerco', $this->temCerco])
                ->andFilterWhere(['like', 'temPlacaIdentificacao', $this->temPlacaIdentificacao])
                ->andFilterWhere(['like', 'temCadernoRegisto', $this->temCadernoRegisto])
                ->andFilterWhere(['like', 'contribuicaoFundoManeio', $this->contribuicaoFundoManeio])
                ->andFilterWhere(['like', 'frequenciaContribuicoes', $this->frequenciaContribuicoes])
                ->andFilterWhere(['like', 'fundoManeioSaldoPositivo', $this->fundoManeioSaldoPositivo])
                ->andFilterWhere(['like', 'temPlanoActividade', $this->temPlanoActividade])
                ->andFilterWhere(['like', 'frequenciaSessoes', $this->frequenciaSessoes])
                ->andFilterWhere(['like', 'localReunioes', $this->localReunioes])
                ->andFilterWhere(['like', 'implementaASAE', $this->implementaASAE])
                ->andFilterWhere(['like', 'produzBioInsecticida', $this->produzBioInsecticida])
                ->andFilterWhere(['like', 'usaBioFertilizante', $this->usaBioFertilizante])
                ->andFilterWhere(['like', 'integraSistemaAgrosilvopastoril', $this->integraSistemaAgrosilvopastoril])
                ->andFilterWhere(['like', 'metodologiaJangosPastoris', $this->metodologiaJangosPastoris])
                ->andFilterWhere(['like', 'assistTecnApoioProducao', $this->assistTecnApoioProducao])
                ->andFilterWhere(['like', 'placaVisibilidade', $this->placaVisibilidade])
                ->andFilterWhere(['like', 'autoridadeTradEnvolvida', $this->autoridadeTradEnvolvida])
                ->andFilterWhere(['like', 'administracaoEnvolvida', $this->administracaoEnvolvida])
                ->andFilterWhere(['like', 'isvEnvolvida', $this->isvEnvolvida])
                ->andFilterWhere(['like', 'idfEnvolvida', $this->idfEnvolvida])
                ->andFilterWhere(['like', 'idaEdaEnvolvida', $this->idaEdaEnvolvida])
                ->andFilterWhere(['like', 'iiaEnvolvida', $this->iiaEnvolvida])
                ->andFilterWhere(['like', 'iivEnvolvida', $this->iivEnvolvida])
                ->andFilterWhere(['like', 'outroEnvolvida', $this->outroEnvolvida])
                ->andFilterWhere(['like', 'primeiraPraticaInovadora', $this->primeiraPraticaInovadora])
                ->andFilterWhere(['like', 'segundaPraticaInovadora', $this->segundaPraticaInovadora])
                ->andFilterWhere(['like', 'terceiraPraticaInovadora', $this->terceiraPraticaInovadora])
                ->andFilterWhere(['like', 'replicaPraticaInovadora', $this->replicaPraticaInovadora])
                ->andFilterWhere(['like', 'principalConstrangimento', $this->principalConstrangimento])
                ->andFilterWhere(['like', 'temas', $this->temas])
                ->andFilterWhere(['like', 'tema1Ciclo', $this->tema1Ciclo])
                ->andFilterWhere(['like', 'tema2Ciclo', $this->tema2Ciclo])
                ->andFilterWhere(['like', 'tema3Ciclo', $this->tema3Ciclo])
                ->andFilterWhere(['like', 'outroTema', $this->outroTema])
                ->andFilterWhere(['like', 'diaSessaoEca', $this->diaSessaoEca])
                ->andFilterWhere(['like', 'percentParticipacao', $this->percentParticipacao])
                ->andFilterWhere(['like', 'pontoAguaDispoIrri', $this->pontoAguaDispoIrri])
                ->andFilterWhere(['like', 'previstConstrSistIrrig', $this->previstConstrSistIrrig])
                ->andFilterWhere(['like', 'sistemaIrriUtilizad', $this->sistemaIrriUtilizad])
                ->andFilterWhere(['like', 'classificacacaoCampo', $this->classificacacaoCampo])
                ->andFilterWhere(['like', 'houveExcedente', $this->houveExcedente])
                ->andFilterWhere(['like', 'culturasHouveExcedente', $this->culturasHouveExcedente])
                ->andFilterWhere(['like', 'destinoExcedente', $this->destinoExcedente])
                ->andFilterWhere(['like', 'facilitaLigacoesEntreProdutores', $this->facilitaLigacoesEntreProdutores])
                ->andFilterWhere(['like', 'realizaEventosSobreProdutos', $this->realizaEventosSobreProdutos])
                ->andFilterWhere(['like', 'apoioDistrProdCamponeses', $this->apoioDistrProdCamponeses])
                ->andFilterWhere(['like', 'dataApoios', $this->dataApoios])
                ->andFilterWhere(['like', 'tipoEvento', $this->tipoEvento])
                ->andFilterWhere(['like', 'descricaoRede', $this->descricaoRede])
                ->andFilterWhere(['like', 'coberturaGeograficaRede', $this->coberturaGeograficaRede])
                ->andFilterWhere(['like', 'comerciantesEnvolvidos', $this->comerciantesEnvolvidos])
                ->andFilterWhere(['like', 'finalidadeRede', $this->finalidadeRede])
                ->andFilterWhere(['like', 'frequenciaRede', $this->frequenciaRede])
                ->andFilterWhere(['like', 'resultadoInicRede', $this->resultadoInicRede])
                ->andFilterWhere(['like', 'desafios', $this->desafios])
                ->andFilterWhere(['like', 'licoesAprendidas', $this->licoesAprendidas])
                ->andFilterWhere(['like', 'temBancoSementes', $this->temBancoSementes])
                ->andFilterWhere(['like', 'fazMultiSementes', $this->fazMultiSementes])
                ->andFilterWhere(['like', 'culturasDispoBancSementes', $this->culturasDispoBancSementes])
                ->andFilterWhere(['like', 'estadoBancoSementes', $this->estadoBancoSementes])
                ->andFilterWhere(['like', 'temRegistoBancSementes', $this->temRegistoBancSementes])
                ->andFilterWhere(['like', 'resultadIniciBancoSem', $this->resultadIniciBancoSem])
                ->andFilterWhere(['like', 'desafiosBancoSem', $this->desafiosBancoSem])
                ->andFilterWhere(['like', 'licoesAprendiBancSem', $this->licoesAprendiBancSem])
                ->andFilterWhere(['like', 'classifCooper', $this->classifCooper])
                ->andFilterWhere(['like', 'membrCampoAgrFormal', $this->membrCampoAgrFormal])
                ->andFilterWhere(['like', 'coopExistia', $this->coopExistia])
                ->andFilterWhere(['like', 'coopLegalizada', $this->coopLegalizada])
                ->andFilterWhere(['like', 'coopLegalFresan', $this->coopLegalFresan])
                ->andFilterWhere(['like', 'tipoApoioDadoProjec', $this->tipoApoioDadoProjec])
                ->andFilterWhere(['like', 'realizaFormacao', $this->realizaFormacao])
                ->andFilterWhere(['like', 'temaSessoesFormacao', $this->temaSessoesFormacao])
                ->andFilterWhere(['like', 'orgaosSociaisDefinidos', $this->orgaosSociaisDefinidos])
                ->andFilterWhere(['like', 'membrosFazemContrReg', $this->membrosFazemContrReg])
                ->andFilterWhere(['like', 'coopTemFundoManeioPositivo', $this->coopTemFundoManeioPositivo])
                ->andFilterWhere(['like', 'propositoApoiarTransformacao', $this->propositoApoiarTransformacao])
                ->andFilterWhere(['like', 'realizaTransforDescriProduto', $this->realizaTransforDescriProduto])
                ->andFilterWhere(['like', 'propositoApoiarArmazen', $this->propositoApoiarArmazen])
                ->andFilterWhere(['like', 'propositoApoiarFactorProd', $this->propositoApoiarFactorProd])
                ->andFilterWhere(['like', 'propositoApoiarComercializacao', $this->propositoApoiarComercializacao])
                ->andFilterWhere(['like', 'propositoApoiarMembroCaixaCom', $this->propositoApoiarMembroCaixaCom])
                ->andFilterWhere(['like', 'desafiosCooperativas', $this->desafiosCooperativas])
                ->andFilterWhere(['like', 'licoesAprendidasCooperativas', $this->licoesAprendidasCooperativas])
                ->andFilterWhere(['like', 'tecnologiaProjectoPioto', $this->tecnologiaProjectoPioto])
                ->andFilterWhere(['like', 'kitClassificacao', $this->kitClassificacao])
                ->andFilterWhere(['like', 'kitDistribuidoDescric', $this->kitDistribuidoDescric])
                ->andFilterWhere(['like', 'pontoSituacaoProjecto', $this->pontoSituacaoProjecto])
                ->andFilterWhere(['like', 'comercializacao', $this->comercializacao])
                ->andFilterWhere(['like', 'resultadoInicPiloto', $this->resultadoInicPiloto])
                ->andFilterWhere(['like', 'desafiosPiloto', $this->desafiosPiloto])
                ->andFilterWhere(['like', 'licoesAprendidasPiloto', $this->licoesAprendidasPiloto])
                ->andFilterWhere(['like', 'realizadaSinsibilizacoesEAN', $this->realizadaSinsibilizacoesEAN])
                ->andFilterWhere(['like', 'realizadasSensibilizacoesCulinarias', $this->realizadasSensibilizacoesCulinarias])
                ->andFilterWhere(['like', 'realizadoRastreios', $this->realizadoRastreios])
                ->andFilterWhere(['like', 'tecnicoResponsavelUIC', $this->tecnicoResponsavelUIC])
                ->andFilterWhere(['like', 'constatacoesFeitasUIC', $this->constatacoesFeitasUIC])
                ->andFilterWhere(['like', 'recomendacoesFeitasUIC', $this->recomendacoesFeitasUIC])
                ->andFilterWhere(['like', 'medidasMitigacaoONG', $this->medidasMitigacaoONG]);

        return $dataProvider;
    }
}
