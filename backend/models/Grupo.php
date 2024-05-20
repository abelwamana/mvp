<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "grupo".
 *
 * @property int $Id
 * @property string $primeiroReporte
 * @property string $actualizacaoID
 * @property string $respondente
 * @property string $entidade
 * @property int $provinciaID
 * @property int $municipioID
 * @property int $comunaID
 * @property int $localidadeID
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string $apoioAgricola
 * @property string|null $nomeGrupo
 * @property string|null $grupoExistia
 * @property string|null $metodologiaAgricola
 * @property string|null $outraMetodologiaAgricola
 * @property string|null $segueMetodologiaECA
 * @property string $anoInicioApoio
 * @property string|null $primeiroAnoAgriColheita
 * @property string|null $ultimoAnoAgriColheita
 * @property string $estagioFaseEncontra
 * @property string|null $validadaIDA
 * @property string|null $grupoEntregueEntPubl
 * @property string|null $dataGrupoEntregue
 * @property string|null $anexoAutoEntrega
 * @property int $primeiraFinalidadeID
 * @property int $segundaFinalidadeID
 * @property int $terceiraFinalidadeID3
 * @property int|null $beneficiariosHomem
 * @property int|null $beneficiariosMulher
 * @property string|null $listaMembros
 * @property int|null $representaQtsAF
 * @property int|null $bovinos
 * @property int|null $caprinos
 * @property int|null $ovinos
 * @property string|null $temComissaoGestao
 * @property string|null $temReguInterno
 * @property string|null $temFacilitador
 * @property string|null $temParcelasAprendizagem
 * @property string|null $temCerco
 * @property string|null $temPlacaIdentificacao
 * @property string|null $temCadernoRegisto
 * @property string|null $contribuicaoFundoManeio
 * @property string|null $frequenciaContribuicoes
 * @property int|null $membrosContribuemRegular
 * @property string|null $fundoManeioSaldoPositivo
 * @property string|null $temPlanoActividade
 * @property string|null $frequenciaSessoes
 * @property string|null $localReunioes
 * @property string|null $implementaASAE
 * @property string|null $produzBioInsecticida
 * @property string|null $usaBioFertilizante
 * @property string|null $integraSistemaAgrosilvopastoril
 * @property int|null $numEvenTrocExperCamponeses
 * @property string|null $metodologiaJangosPastoris
 * @property string|null $assistTecnApoioProducao
 * @property string|null $placaVisibilidade
 * @property string|null $autoridadeTradEnvolvida
 * @property string|null $administracaoEnvolvida
 * @property string|null $isvEnvolvida
 * @property string|null $idfEnvolvida
 * @property string|null $idaEdaEnvolvida
 * @property string|null $iiaEnvolvida
 * @property string|null $iivEnvolvida
 * @property string|null $outroEnvolvida
 * @property string $primeiraPraticaInovadora
 * @property string $segundaPraticaInovadora
 * @property string $terceiraPraticaInovadora
 * @property string|null $replicaPraticaInovadora
 * @property int|null $nLavrasPartiReplicaPraticaInovadora
 * @property string|null $principalConstrangimento
 * @property string|null $temas
 * @property string|null $tema1Ciclo
 * @property string|null $tema2Ciclo
 * @property string|null $tema3Ciclo
 * @property string|null $outroTema
 * @property int|null $nSessoeTeoPrat
 * @property string|null $nSessoeTeoPratTrimes
 * @property string|null $diaSessaoEca
 * @property string|null $percentParticipacao
 * @property float|null $areaTotalCampoAgro
 * @property float|null $areaCultivadaCampoAgro
 * @property float|null $areaInsPlantInovadorasCampoAgro
 * @property string|null $pontoAguaDispoIrri
 * @property string|null $previstConstrSistIrrig
 * @property string|null $sistemaIrriUtilizad
 * @property float|null $areaIrrigada
 * @property string|null $classificacacaoCampo
 * @property string|null $houveExcedente
 * @property string|null $culturasHouveExcedente
 * @property float|null $qtdExcedente
 * @property string|null $trimestreExcedente
 * @property string|null $destinoExcedente
 * @property string|null $facilitaLigacoesEntreProdutores
 * @property string|null $realizaEventosSobreProdutos
 * @property string|null $apoioDistrProdCamponeses
 * @property int|null $nRedes
 * @property string|null $dataApoios
 * @property string $tipoEvento
 * @property string|null $descricaoRede
 * @property string|null $coberturaGeograficaRede
 * @property string|null $comerciantesEnvolvidos
 * @property string|null $finalidadeRede
 * @property string|null $frequenciaRede
 * @property string|null $resultadoInicRede
 * @property string|null $desafios
 * @property string|null $licoesAprendidas
 * @property string|null $temBancoSementes
 * @property string|null $fazMultiSementes
 * @property string|null $culturasDispoBancSementes
 * @property int|null $qtdSementesEntrBancoKG
 * @property string|null $trimSementesBanco
 * @property float|null $totalSementesEntrCamponeses
 * @property string|null $trimestreSementesEntrCamponeses
 * @property float|null $totalSementesReembPelosCamponeses
 * @property string|null $trimestreSementesReembPelosCamponeses
 * @property float|null $qtdSementesDisponiveisBanco
 * @property string|null $trimestreSementesDisponiveisBanco
 * @property string|null $estadoBancoSementes
 * @property string|null $temRegistoBancSementes
 * @property int|null $camponesesRecebemSementesBanc
 * @property int|null $camponesesReebolsaSementesBanc
 * @property string|null $resultadIniciBancoSem
 * @property string|null $desafiosBancoSem
 * @property string|null $licoesAprendiBancSem
 * @property string|null $classifCooper
 * @property string|null $membrCampoAgrFormal
 * @property int|null $homemCoop
 * @property int|null $mulherCoop
 * @property string|null $coopExistia
 * @property string|null $coopLegalizada
 * @property string|null $coopLegalFresan
 * @property string|null $tipoApoioDadoProjec
 * @property string|null $realizaFormacao
 * @property string|null $temaSessoesFormacao
 * @property int|null $nSessoesFormacoes
 * @property string|null $trimesSessoesFormacoes
 * @property string|null $orgaosSociaisDefinidos
 * @property int|null $nReunioesOrgSoc
 * @property string|null $nReunioesOrgSocTrimestre
 * @property string|null $membrosFazemContrReg
 * @property string|null $coopTemFundoManeioPositivo
 * @property string|null $propositoApoiarTransformacao
 * @property string|null $realizaTransforDescriProduto
 * @property string|null $propositoApoiarArmazen
 * @property string|null $propositoApoiarFactorProd
 * @property string|null $propositoApoiarComercializacao
 * @property string|null $propositoApoiarMembroCaixaCom
 * @property string|null $desafiosCooperativas
 * @property string|null $licoesAprendidasCooperativas
 * @property string|null $tecnologiaProjectoPioto
 * @property int|null $nCamponesesHomens
 * @property int|null $nCamponesesMulheres
 * @property string|null $kitClassificacao
 * @property string|null $kitDistribuidoDescric
 * @property int|null $nKitEntregue
 * @property string|null $pontoSituacaoProjecto
 * @property string|null $comercializacao
 * @property float|null $qtdProdComercializadoKG
 * @property string|null $resultadoInicPiloto
 * @property string|null $desafiosPiloto
 * @property string|null $licoesAprendidasPiloto
 * @property string|null $realizadaSinsibilizacoesEAN
 * @property string|null $realizadasSensibilizacoesCulinarias
 * @property string|null $realizadoRastreios
 * @property int|null $desafiosAprendidasONG
 * @property int|null $licoesAprendidasONG
 * @property string|null $dataVisitaUIC
 * @property string|null $tecnicoResponsavelUIC
 * @property string|null $constatacoesFeitasUIC
 * @property string|null $recomendacoesFeitasUIC
 * @property string|null $medidasMitigacaoONG
 * @property int|null $medidasMitigacaoEstado
 * @property int|null $userID
 *
 * @property Comuna $comuna
 * @property Localidade $localidade
 * @property Municipio $municipio
 * @property Finalidade $primeiraFinalidade
 * @property Finalidade $primeiraFinalidade0
 * @property Provincia $provincia
 * @property Finalidade $segundaFinalidade
 * @property Finalidade $terceiraFinalidadeID30
 * @property User $user
 */
class Grupo extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'grupo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
//            [['primeiroReporte', 'actualizacaoID', 'respondente', 'entidade', 'provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'apoioAgricola', 'anoInicioApoio', 'estagioFaseEncontra', 'primeiraFinalidadeID', 'segundaFinalidadeID', 'terceiraFinalidadeID3', 'primeiraPraticaInovadora', 'segundaPraticaInovadora', 'terceiraPraticaInovadora', 'tipoEvento'], 'required'],
  //          [['primeiroReporte', 'anoInicioApoio', 'primeiroAnoAgriColheita', 'ultimoAnoAgriColheita', 'dataGrupoEntregue', 'nSessoeTeoPratTrimes', 'trimestreExcedente', 'trimSementesBanco', 'trimestreSementesEntrCamponeses', 'trimestreSementesReembPelosCamponeses', 'trimestreSementesDisponiveisBanco', 'trimesSessoesFormacoes', 'nReunioesOrgSocTrimestre', 'dataVisitaUIC'], 'safe'],
            [['provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'primeiraFinalidadeID', 'segundaFinalidadeID', 'terceiraFinalidadeID3', 'beneficiariosHomem', 'beneficiariosMulher', 'representaQtsAF', 'bovinos', 'caprinos', 'ovinos', 'membrosContribuemRegular', 'numEvenTrocExperCamponeses', 'nLavrasPartiReplicaPraticaInovadora', 'nSessoeTeoPrat', 'nRedes', 'qtdSementesEntrBancoKG', 'camponesesRecebemSementesBanc', 'camponesesReebolsaSementesBanc', 'homemCoop', 'mulherCoop', 'nSessoesFormacoes', 'nReunioesOrgSoc', 'nCamponesesHomens', 'nCamponesesMulheres', 'nKitEntregue', 'desafiosAprendidasONG', 'licoesAprendidasONG', 'medidasMitigacaoEstado', 'userID'], 'integer'],
            [['temas', 'outroTema', 'descricaoRede', 'culturasDispoBancSementes', 'desafiosBancoSem', 'licoesAprendiBancSem', 'temaSessoesFormacao', 'realizaTransforDescriProduto', 'desafiosCooperativas', 'licoesAprendidasCooperativas', 'kitDistribuidoDescric', 'desafiosPiloto', 'licoesAprendidasPiloto', 'recomendacoesFeitasUIC'], 'string'],
            [['areaTotalCampoAgro', 'areaCultivadaCampoAgro', 'areaInsPlantInovadorasCampoAgro', 'areaIrrigada', 'qtdExcedente', 'totalSementesEntrCamponeses', 'totalSementesReembPelosCamponeses', 'qtdSementesDisponiveisBanco', 'qtdProdComercializadoKG'], 'number'],
            [['respondente', 'latitude', 'longitude', 'apoioAgricola', 'nomeGrupo', 'anexoAutoEntrega', 'outroEnvolvida', 'principalConstrangimento', 'tema1Ciclo', 'tema2Ciclo', 'tema3Ciclo', 'culturasHouveExcedente', 'dataApoios', 'comerciantesEnvolvidos', 'desafios', 'licoesAprendidas', 'tipoApoioDadoProjec', 'kitClassificacao', 'constatacoesFeitasUIC'], 'string', 'max' => 255],
            [['entidade', 'metodologiaAgricola', 'primeiraPraticaInovadora', 'segundaPraticaInovadora', 'terceiraPraticaInovadora', 'sistemaIrriUtilizad', 'destinoExcedente', 'realizaEventosSobreProdutos', 'tipoEvento', 'coberturaGeograficaRede', 'finalidadeRede', 'frequenciaRede', 'resultadoInicRede', 'estadoBancoSementes', 'temRegistoBancSementes', 'resultadIniciBancoSem', 'classifCooper', 'coopExistia', 'coopLegalizada', 'coopLegalFresan', 'realizaFormacao', 'orgaosSociaisDefinidos', 'membrosFazemContrReg', 'propositoApoiarTransformacao', 'propositoApoiarArmazen', 'propositoApoiarFactorProd', 'propositoApoiarComercializacao', 'propositoApoiarMembroCaixaCom', 'tecnologiaProjectoPioto', 'pontoSituacaoProjecto', 'resultadoInicPiloto', 'tecnicoResponsavelUIC', 'medidasMitigacaoONG'], 'string', 'max' => 50],
            [['grupoExistia', 'segueMetodologiaECA', 'temComissaoGestao', 'temReguInterno', 'temFacilitador', 'temParcelasAprendizagem', 'temCerco', 'temPlacaIdentificacao', 'temCadernoRegisto', 'contribuicaoFundoManeio', 'frequenciaContribuicoes', 'fundoManeioSaldoPositivo', 'temPlanoActividade', 'localReunioes', 'implementaASAE', 'produzBioInsecticida', 'usaBioFertilizante', 'integraSistemaAgrosilvopastoril', 'metodologiaJangosPastoris', 'assistTecnApoioProducao', 'placaVisibilidade', 'autoridadeTradEnvolvida', 'administracaoEnvolvida', 'isvEnvolvida', 'idfEnvolvida', 'idaEdaEnvolvida', 'iiaEnvolvida', 'iivEnvolvida', 'replicaPraticaInovadora', 'previstConstrSistIrrig', 'houveExcedente', 'facilitaLigacoesEntreProdutores', 'apoioDistrProdCamponeses', 'temBancoSementes', 'fazMultiSementes', 'coopTemFundoManeioPositivo', 'realizadaSinsibilizacoesEAN', 'realizadasSensibilizacoesCulinarias', 'realizadoRastreios'], 'string', 'max' => 3],
            [['outraMetodologiaAgricola'], 'string', 'max' => 200],
            [['estagioFaseEncontra', 'membrCampoAgrFormal', 'comercializacao'], 'string', 'max' => 30],
            [['validadaIDA', 'grupoEntregueEntPubl', 'listaMembros'], 'string', 'max' => 4],
            [['frequenciaSessoes', 'diaSessaoEca', 'percentParticipacao', 'pontoAguaDispoIrri', 'classificacacaoCampo'], 'string', 'max' => 20],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
            [['terceiraFinalidadeID3'], 'exist', 'skipOnError' => true, 'targetClass' => Finalidade::class, 'targetAttribute' => ['terceiraFinalidadeID3' => 'Id']],
            [['primeiraFinalidadeID'], 'exist', 'skipOnError' => true, 'targetClass' => Finalidade::class, 'targetAttribute' => ['primeiraFinalidadeID' => 'Id']],
            [['primeiraFinalidadeID'], 'exist', 'skipOnError' => true, 'targetClass' => Finalidade::class, 'targetAttribute' => ['primeiraFinalidadeID' => 'Id']],
            [['provinciaID'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::class, 'targetAttribute' => ['provinciaID' => 'Id']],
            [['comunaID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::class, 'targetAttribute' => ['comunaID' => 'Id']],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userID' => 'id']],
            [['localidadeID'], 'exist', 'skipOnError' => true, 'targetClass' => Localidade::class, 'targetAttribute' => ['localidadeID' => 'Id']],
            [['segundaFinalidadeID'], 'exist', 'skipOnError' => true, 'targetClass' => Finalidade::class, 'targetAttribute' => ['segundaFinalidadeID' => 'Id']],
            //Validaão da Latitude e Longitude
            //[['latitude', 'longitude'], 'required'],
            ['latitude', 'match', 'pattern' => '/^-?\d+\.\d+$/', 'message' => 'Latitude inválida. Ex: -8.656742724'],
            ['longitude', 'match', 'pattern' => '/^-?\d+\.\d+$/', 'message' => 'Longitude inválida.Ex 13.519309677'],
            ['respondente', 'match', 'pattern' => '/^[A-Za-z\s]+$/', 'message' => 'O nome deve conter apenas letras e espaços.'],
            [['primeiroReporte', 'actualizacaoID'], 'match', 'pattern' => '/^\d{4}-\d{2}-\d{2}$/', 'message' => 'A data deve estar no formato AAAA-MM-DD.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'Id' => Yii::t('app', 'ID'),
            'primeiroReporte' => Yii::t('app', 'Primeiro Reporte'),
            'actualizacaoID' => Yii::t('app', 'Actualização'),
            'respondente' => Yii::t('app', 'Nome do Respondente'),
            'entidade' => Yii::t('app', 'Entidade'),
            'provinciaID' => Yii::t('app', 'Província'),
            'municipioID' => Yii::t('app', 'Munic~ipio'),
            'comunaID' => Yii::t('app', 'Comuna'),
            'localidadeID' => Yii::t('app', 'Localidade'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'apoioAgricola' => Yii::t('app', 'Apoio Agrícola'),
            'nomeGrupo' => Yii::t('app', 'Nome do Grupo'),
            'grupoExistia' => Yii::t('app', 'Grupo já existia?'),
            'metodologiaAgricola' => Yii::t('app', 'Metodologia Agricola'),
            'outraMetodologiaAgricola' => Yii::t('app', 'Outra Metodologia Agricola'),
            'segueMetodologiaECA' => Yii::t('app', 'Segue Metodologia Eca'),
            'anoInicioApoio' => Yii::t('app', 'Ano Inicio Apoio'),
            'primeiroAnoAgriColheita' => Yii::t('app', '1º Ano Agrícola c/ colheitas (Set - Ago)'),
            'ultimoAnoAgriColheita' => Yii::t('app', 'Último Ano Agrícola (Set -Ago)'),
            'estagioFaseEncontra' => Yii::t('app', 'Estágio / Fase em que se Encontra'),
            'validadaIDA' => Yii::t('app', 'Foi validada pelo IDA?'),
            'grupoEntregueEntPubl' => Yii::t('app', 'Grupo foi entregue a uma Entidade Pública?'),
            'dataGrupoEntregue' => Yii::t('app', 'Data que o Grupo foi Entregue'),
            'anexoAutoEntrega' => Yii::t('app', 'Anexo Auto Entrega'),
            'primeiraFinalidadeID' => Yii::t('app', 'Primeira Finalidade'),
            'segundaFinalidadeID' => Yii::t('app', 'Segunda Finalidade'),
            'terceiraFinalidadeID3' => Yii::t('app', 'Terceira Finalidade'),
            'beneficiariosHomem' => Yii::t('app', 'Membros do Grupo/Campo Apropecuário (Beneficiarios Homem)'),
            'beneficiariosMulher' => Yii::t('app', 'Membros do Grupo/Campo Apropecuário (Beneficiarios Mulher)'),
            'listaMembros' => Yii::t('app', 'Tem Lista de membros?'),
            'representaQtsAF' => Yii::t('app', 'Os membros representam quantos AFs'),
            'bovinos' => Yii::t('app', 'Quantidade de Bovinos'),
            'caprinos' => Yii::t('app', 'Quantidade de Caprinos'),
            'ovinos' => Yii::t('app', 'Quantidade de Ovinos'),
            'temComissaoGestao' => Yii::t('app', 'Tem Comissão de Gestão'),
            'temReguInterno' => Yii::t('app', 'Tem Regulamento Interno'),
            'temFacilitador' => Yii::t('app', 'Tem Facilitador'),
            'temParcelasAprendizagem' => Yii::t('app', 'Tem Parcelas de Aprendizagem'),
            'temCerco' => Yii::t('app', 'Tem Cerco'),
            'temPlacaIdentificacao' => Yii::t('app', 'Tem Placa Identificação'),
            'temCadernoRegisto' => Yii::t('app', 'Tem Caderno Registo'),
            'contribuicaoFundoManeio' => Yii::t('app', 'Membros fazem contribuições para fundo de maneio (despesas correntes)'),
            'frequenciaContribuicoes' => Yii::t('app', 'Frequência das contribuições'),
            'membrosContribuemRegular' => Yii::t('app', 'Quantos membros fazem contribuição de forma regular'),
            'fundoManeioSaldoPositivo' => Yii::t('app', 'Fundo de Maneio com saldo Positivo'),
            'temPlanoActividade' => Yii::t('app', 'Tem Plano Actividade'),
            'frequenciaSessoes' => Yii::t('app', 'Frequência das Sessões'),
            'localReunioes' => Yii::t('app', 'Tem local para reuniões'),
            'implementaASAE' => Yii::t('app', 'Implementa ASAE'),
            'produzBioInsecticida' => Yii::t('app', 'Produz Bioinsecticida'),
            'usaBioFertilizante' => Yii::t('app', 'Usa Bio-fertilizante (estrume, composto, cobertura verde, etc)'),
            'integraSistemaAgrosilvopastoril' => Yii::t('app', 'Integra sistema Agrosilvopastoril'),
            'numEvenTrocExperCamponeses' => Yii::t('app', 'Nº de eventos de trocas de experiências entre Camponeses'),
            'metodologiaJangosPastoris' => Yii::t('app', 'Utiliza a metodologia dos Jangos Pastoris'),
            'assistTecnApoioProducao' => Yii::t('app', 'Tem Assistência Técnica de Apoio à Produção'),
            'placaVisibilidade' => Yii::t('app', 'Dispõe de Placa de Visibilidade'),
            'autoridadeTradEnvolvida' => Yii::t('app', 'Autoridades Tradicionais Envolvida'),
            'administracaoEnvolvida' => Yii::t('app', 'Administração Municipal/Comunal Envolvida'),
            'isvEnvolvida' => Yii::t('app', 'ISV Envolvida'),
            'idfEnvolvida' => Yii::t('app', 'IDF Envolvida'),
            'idaEdaEnvolvida' => Yii::t('app', 'IDA/EDA Envolvida'),
            'iiaEnvolvida' => Yii::t('app', 'IIA Envolvida'),
            'iivEnvolvida' => Yii::t('app', 'IIV Envolvida'),
            'outroEnvolvida' => Yii::t('app', 'Outro Envolvida'),
            'primeiraPraticaInovadora' => Yii::t('app', '1º Prática Inovadora'),
            'segundaPraticaInovadora' => Yii::t('app', '2º Prática Inovadora'),
            'terceiraPraticaInovadora' => Yii::t('app', '3º Prática Inovadora'),
            'replicaPraticaInovadora' => Yii::t('app', 'Há replicação das práticas inovadoras nas lavras particulares?'),
            'nLavrasPartiReplicaPraticaInovadora' => Yii::t('app', 'Nº de Lavras Particulares onde há replicação'),
            'principalConstrangimento' => Yii::t('app', 'Principal constrangimento para replicação'),
            'temas' => Yii::t('app', 'Temas Abordados'),
            'tema1Ciclo' => Yii::t('app', 'Temas do 1º Ciclo'),
            'tema2Ciclo' => Yii::t('app', 'Temas do 2º Ciclo'),
            'tema3Ciclo' => Yii::t('app', 'Temas do 3º Ciclo'),
            'outroTema' => Yii::t('app', 'Outro Tema'),
            'nSessoeTeoPrat' => Yii::t('app', 'Nº de Sessões Teóricas e Práticas trimestrais'),
            'nSessoeTeoPratTrimes' => Yii::t('app', 'Qual foi o Trimestre das Sessões Teóricas e Práticas'),
            'diaSessaoEca' => Yii::t('app', 'Dia de sessão da ECA'),
            'percentParticipacao' => Yii::t('app', '% de Participação (aproximação)'),
            'areaTotalCampoAgro' => Yii::t('app', 'Área Total do Campo Agropecuário (em hectares)'),
            'areaCultivadaCampoAgro' => Yii::t('app', 'Área cultivada (em hectares)'),
            'areaInsPlantInovadorasCampoAgro' => Yii::t('app', 'Área em que foram inseridas as práticas agrícolas inovadoras (em hectares)'),
            'pontoAguaDispoIrri' => Yii::t('app', 'Ponto de água disponível para irrigação?'),
            'previstConstrSistIrrig' => Yii::t('app', 'Previsto construir/reabilitar um sistema de irrigação complementar? (caso sim, reportar na folha H. Água)'),
            'sistemaIrriUtilizad' => Yii::t('app', 'Sistema de Irrigação utilizado (com maior área)'),
            'areaIrrigada' => Yii::t('app', 'Área irrigada (hectares)'),
            'classificacacaoCampo' => Yii::t('app', 'Classificação do Campo Agropecuário (tendo em conta o sistema de irrigação existente)'),
            'houveExcedente' => Yii::t('app', 'Houve exedente?'),
            'culturasHouveExcedente' => Yii::t('app', 'Culturas que Houve Excedente'),
            'qtdExcedente' => Yii::t('app', 'Quantidade Total (Kg) Excedente (início até ao trimestre passado)'),
            'trimestreExcedente' => Yii::t('app', 'Trimestre Excedente'),
            'destinoExcedente' => Yii::t('app', 'Destino Excedente'),
            'facilitaLigacoesEntreProdutores' => Yii::t('app', 'Facilita ligações entre comerciantes/ produtores/ consumidores'),
            'realizaEventosSobreProdutos' => Yii::t('app', 'Realiza eventos de informação sobre mercados e produtos'),
            'apoioDistrProdCamponeses' => Yii::t('app', 'Apoio à distribuição (transporte) dos produtos dos camponeses?'),
            'nRedes' => Yii::t('app', 'Nº de Redes/Ligações estabelecidas (Total)'),
            'dataApoios' => Yii::t('app', 'Data dos apoios e/ou eventos'),
            'tipoEvento' => Yii::t('app', 'Tipologia do apoio/evento (Feira; Workshop; Mercado Informal; Mercado Formal: Lojas/Empresas/Supermercados)'),
            'descricaoRede' => Yii::t('app', 'Breve descrição da rede/apoio realizado'),
            'coberturaGeograficaRede' => Yii::t('app', 'Cobertura geográfica (Local; Comunal;  Municipal; Provincial; Inter-Provincial; etc)'),
            'comerciantesEnvolvidos' => Yii::t('app', 'Comerciantes Envolvidos'),
            'finalidadeRede' => Yii::t('app', 'Finalidade da rede estabelecida (Venda; Compra; Escoamento/Transporte; Convénio/Memorando; Permunta)'),
            'frequenciaRede' => Yii::t('app', 'Frequência/Estabilidade da Rede (mensal;  trimestral; semestral; pontual)'),
            'resultadoInicRede' => Yii::t('app', 'Resultado da iniciativa_Redes (Em curso; Bem sucedida/Autonóma; Sem sucesso'),
            'desafios' => Yii::t('app', 'Desafios Redes'),
            'licoesAprendidas' => Yii::t('app', 'Lições Aprendidas Redes'),
            'temBancoSementes' => Yii::t('app', 'Tem Banco de Sementes'),
            'fazMultiSementes' => Yii::t('app', 'Faz multiplicação de sementes'),
            'culturasDispoBancSementes' => Yii::t('app', 'Culturas disponíveis no banco de semente'),
            'qtdSementesEntrBancoKG' => Yii::t('app', 'Quantidade de Sementes Entregues ao Banco (pelo projecto) em Kg'),
            'trimSementesBanco' => Yii::t('app', 'Trimestre em que as Sementes foram entregues Banco'),
            'totalSementesEntrCamponeses' => Yii::t('app', 'Total de Sementes entregues pelo Banco aos Camponeses (Kg)'),
            'trimestreSementesEntrCamponeses' => Yii::t('app', 'Trimestre em que as Sementes foram Entregues pelo Banco aos Camponeses'),
            'totalSementesReembPelosCamponeses' => Yii::t('app', 'Total Sementes Reembolsada Pelos Camponeses'),
            'trimestreSementesReembPelosCamponeses' => Yii::t('app', 'Trimestre que as Sementes foram Reembolsadas Pelos Camponeses'),
            'qtdSementesDisponiveisBanco' => Yii::t('app', 'Quantidade de sementes Disponíveis no Banco (Kg)'),
            'trimestreSementesDisponiveisBanco' => Yii::t('app', 'Trimestre Sementes Disponiveis Banco'),
            'estadoBancoSementes' => Yii::t('app', 'Estado do Banco de Sementes'),
            'temRegistoBancSementes' => Yii::t('app', 'Tem Caderno/ Registo do Banco de Sementes?'),
            'camponesesRecebemSementesBanc' => Yii::t('app', 'Nº de camponeses que recebem sementes do Banco'),
            'camponesesReebolsaSementesBanc' => Yii::t('app', 'Nº de camponeses que reembolsa sementes ao Banco'),
            'resultadIniciBancoSem' => Yii::t('app', 'Resultado da iniciativa do Banco de Sementes'),
            'desafiosBancoSem' => Yii::t('app', 'Desafios do Banco de Sementes'),
            'licoesAprendiBancSem' => Yii::t('app', 'Licoes Aprendidas sobre o Banco de Sementes'),
            'classifCooper' => Yii::t('app', 'Classificação da Cooperativa'),
            'membrCampoAgrFormal' => Yii::t('app', 'Membros do Campo Agropecuário pretendem a formalização'),
            'homemCoop' => Yii::t('app', 'Quantidade de Homens na Cooperativa'),
            'mulherCoop' => Yii::t('app', 'Quantidade de Mulheres na Cooperativa'),
            'coopExistia' => Yii::t('app', 'A Cooperativa Já existia?'),
            'coopLegalizada' => Yii::t('app', 'A Cooperativa está Legalizada'),
            'coopLegalFresan' => Yii::t('app', 'Legalização no âmbito do FRESAN?'),
            'tipoApoioDadoProjec' => Yii::t('app', 'Tipo de apoio dado pelo projecto'),
            'realizaFormacao' => Yii::t('app', 'Realiza Formação em Gestão de Cooperativas/ Associações'),
            'temaSessoesFormacao' => Yii::t('app', 'Temas das Sessões de Formação'),
            'nSessoesFormacoes' => Yii::t('app', 'Nº de Sessões de formação Realizadas'),
            'trimesSessoesFormacoes' => Yii::t('app', 'Trimestre de realização das Sessões de formação'),
            'orgaosSociaisDefinidos' => Yii::t('app', 'Órgãos Sociais estão definidos?'),
            'nReunioesOrgSoc' => Yii::t('app', 'Nº de Reuniões dos Orgãos Sociais'),
            'nReunioesOrgSocTrimestre' => Yii::t('app', 'Trimestre em que foram realizadas as Reuniões dos Orgãos Sociais'),
            'membrosFazemContrReg' => Yii::t('app', 'Membros fazem contribuições regulares?'),
            'coopTemFundoManeioPositivo' => Yii::t('app', 'Tem Fundo de Maneio com Saldo Positivo Cooperativa'),
            'propositoApoiarTransformacao' => Yii::t('app', 'Propósito do grupo_apoiar à Transformação'),
            'realizaTransforDescriProduto' => Yii::t('app', 'Caso realize transformação, descreva o produto'),
            'propositoApoiarArmazen' => Yii::t('app', 'Propósito do grupo_apoio ao Armazenamento'),
            'propositoApoiarFactorProd' => Yii::t('app', 'Propósito do grupo_apoiar à aquisição de factores de produção'),
            'propositoApoiarComercializacao' => Yii::t('app', 'Propósito do grupo_apoiar à Comercialização'),
            'propositoApoiarMembroCaixaCom' => Yii::t('app', 'Propósito do grupo_apoiar membros com Caixa Comunitária/Crédito'),
            'desafiosCooperativas' => Yii::t('app', 'Desafios Cooperativas'),
            'licoesAprendidasCooperativas' => Yii::t('app', 'Licoes Aprendidas Cooperativas'),
            'tecnologiaProjectoPioto' => Yii::t('app', 'Tecnologia do Projecto Pioto'),
            'nCamponesesHomens' => Yii::t('app', 'Nº de camponeses apoiados_Homens'),
            'nCamponesesMulheres' => Yii::t('app', 'Nº de camponeses apoiados_Mulheres'),
            'kitClassificacao' => Yii::t('app', 'Kits Classificação'),
            'kitDistribuidoDescric' => Yii::t('app', 'Kits distribuídos_descrição breve'),
            'nKitEntregue' => Yii::t('app', 'Nº de Kits Entregues'),
            'pontoSituacaoProjecto' => Yii::t('app', 'Ponto de Situação do Projecto'),
            'comercializacao' => Yii::t('app', 'Comercialização'),
            'qtdProdComercializadoKG' => Yii::t('app', 'Quantidade de Produtos comercializados (kg)'),
            'resultadoInicPiloto' => Yii::t('app', 'Resultado da iniciativa_Pilotos'),
            'desafiosPiloto' => Yii::t('app', 'Desafios_Pilotos'),
            'licoesAprendidasPiloto' => Yii::t('app', 'Lições Aprendidas_Pilotoso'),
            'realizadaSinsibilizacoesEAN' => Yii::t('app', 'Realizada Sinsibilizacoes EAN'),
            'realizadasSensibilizacoesCulinarias' => Yii::t('app', 'Realizadas demonstrações culinárias'),
            'realizadoRastreios' => Yii::t('app', 'Realizados rastreios?'),
            'desafiosAprendidasONG' => Yii::t('app', 'Desafios Aprendidas ONG'),
            'licoesAprendidasONG' => Yii::t('app', 'Lições Aprendidas ONG'),
            'dataVisitaUIC' => Yii::t('app', 'Data da Visita UIC'),
            'tecnicoResponsavelUIC' => Yii::t('app', 'Tecnico Responsavel UIC'),
            'constatacoesFeitasUIC' => Yii::t('app', 'Constatações feitas (max. 3) UIC'),
            'recomendacoesFeitasUIC' => Yii::t('app', 'Recomendações Principais (max 3) UIC'),
            'medidasMitigacaoONG' => Yii::t('app', 'Medidas de Mitigação ONG'),
            'medidasMitigacaoEstado' => Yii::t('app', 'Medidas de Mitigação Estado'),
            'userID' => Yii::t('app', 'Usuário'),
        ];
    }

    /**
     * Gets query for [[Comuna]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComuna() {
        return $this->hasOne(Comuna::class, ['Id' => 'comunaID']);
    }

    /**
     * Gets query for [[Localidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidade() {
        return $this->hasOne(Localidade::class, ['Id' => 'localidadeID']);
    }

    /**
     * Gets query for [[Municipio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio() {
        return $this->hasOne(Municipio::class, ['Id' => 'municipioID']);
    }

    /**
     * Gets query for [[PrimeiraFinalidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrimeiraFinalidade() {
        return $this->hasOne(Finalidade::class, ['Id' => 'primeiraFinalidadeID']);
    }

    /**
     * Gets query for [[PrimeiraFinalidade0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrimeiraFinalidade0() {
        return $this->hasOne(Finalidade::class, ['Id' => 'primeiraFinalidadeID']);
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia() {
        return $this->hasOne(Provincia::class, ['Id' => 'provinciaID']);
    }

    /**
     * Gets query for [[SegundaFinalidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSegundaFinalidade() {
        return $this->hasOne(Finalidade::class, ['Id' => 'segundaFinalidadeID']);
    }

    /**
     * Gets query for [[TerceiraFinalidadeID30]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTerceiraFinalidadeID30() {
        return $this->hasOne(Finalidade::class, ['Id' => 'terceiraFinalidadeID3']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'userID']);
    }

    public function getInsumoGrupos() {
        return $this->hasMany(InsumoGrupo::class, ['grupoID' => 'Id']);
    }

    public function getFitofarmacosFerramentas() {
        return $this->hasMany(FitofarmacosFerramentas::class, ['grupoID' => 'Id']);
    }

    public function getAcoesBotoes() {
        $user = Yii::$app->user;
        $acoes = [];

        if ($user->can('Permissao Validador de dados') or \Yii::$app->user->can('Permissão de Administrador')) {
            $acoes[] = ['label' => '', 'url' => ['validar', 'id' => $this->Id], 'class' => 'btn btn-success fas fa-check-square '];
        }

        if ($user->can('Perfil Aprovação de dados')or \Yii::$app->user->can('Permissão de Administrador')) {
            $acoes[] = ['label' => '', 'url' => ['aprovar', 'id' => $this->Id], 'class' => 'btn btn-primary fas fa-thumbs-up'];
        }

        if ($user->can('Perfil Lancamento')or \Yii::$app->user->can('Permissão de Administrador')) {
            $acoes[] = ['label' => '', 'url' => ['publicar', 'id' => $this->Id], 'class' => 'btn btn-primary fa fa-globe'];
        }

        return $acoes;
    }

    // ...Metodo que verifica se o usuario tem permisao para validar
    public function canValidate() {
        $user = Yii::$app->user;

        return $user->can('Permissao Validador de dados');
    }

    public function canApprove() {
        $user = Yii::$app->user;

        return $user->can('Perfil Aprovação de dados');
    }

    public function canPublish() {
        $user = Yii::$app->user;

        return $user->can('Perfil Lancamento');
    }

    // ...Metodo que obtem o estadoValidacao
    public function getEstadoreforcoinstitucional() {
        return $statuses = Grupo::find()
                ->select(['estadoValidacao'])
                ->distinct()
                ->asArray()
                ->all();
    }
      public function getAnexoLink() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexoAutoEntrega)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexoAutoEntrega);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexoAutoEntrega, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->anexoAutoEntrega);
                }
            }
        }

        return null;
    }
}
