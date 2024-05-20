<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "agua".
 *
 * @property int $Id
 * @property string|null $primeiroReporte
 * @property string|null $actualizacao
 * @property string|null $respondente
 * @property string $entidade
 * @property int $provinciaID
 * @property int $municipioID
 * @property int $comunaID
 * @property int $localidadeID
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string $infraEstrutura
 * @property string $fonteHidraulica
 * @property string $fonteHidraulicaAlternativa
 * @property string $servicoAssociado
 * @property string $novaConstrucao
 * @property string $fimAQueSeDestina
 * @property float|null $capacidadeInfraestrutura
 * @property int $capacidadeUnidadeID
 * @property string|null $realizadoTesteQualidadeAgua
 * @property string $entidadeResponsavelConstrucao
 * @property int|null $anosGarantia
 * @property string $sistemExtracaoAgua
 * @property string|null $especificacoesTecnInfraExtru
 * @property string|null $temPlacaVisibilidade
 * @property string|null $infraAssociadaCampo
 * @property int $nomeCampoAssociadoGrupoID
 * @property string|null $anexoFichaTecnInfraExtr
 * @property string|null $estadoObra
 * @property string $imagemInfra
 * @property string|null $dataConclusaoObra
 * @property string|null $pontoFoiEntregueObra
 * @property string|null $anexoActaEntrega
 * @property int|null $benHomem
 * @property int|null $benMulher
 * @property int|null $totalAFAbrangidos
 * @property string|null $benCorresponTotalPopulacao
 * @property int|null $totalSuino
 * @property int|null $totalCaprino
 * @property int|null $totalBovino
 * @property float|null $totalHaIrrigados
 * @property string|null $grupoGestAgua
 * @property string $orientacoesMetodologia
 * @property string|null $comissaoRealizaReuniosFreq
 * @property string|null $grupoFazContribuicoes
 * @property string|null $grupoTemPlanoManutencaoPrev
 * @property string|null $grupoTemPlanoManutencaoUrgen
 * @property int|null $comissaoHomem
 * @property int|null $comissaoMulher
 * @property string|null $grupoFazParteACA
 * @property string|null $grupoEstaAssociadoBMAS
 * @property string|null $existeAcompaMuniEneAgua
 * @property int|null $nTecniAcompanham
 * @property string|null $nTecniParticipamReunioes
 * @property string $metodologiaAdoptada
 * @property string|null $criteriosUtilizadoParaSeleBenef
 * @property int|null $benHomemTransSocial
 * @property int|null $benMulherTransSocial
 * @property int|null $totalAFCorrespondenteTransSocial
 * @property float|null $valorDiarioBene
 * @property int|null $valorDiarioBeneUnidadeID
 * @property int|null $nDiasTrabalho
 * @property float|null $totalEntregueTranBen
 * @property string|null $anexoTermoPagamento
 * @property string|null $desafiosONG
 * @property string|null $licoesAprendidadasONG
 * @property string|null $dataVisitaFresan
 * @property string|null $tecnicoResponsavelFresan
 * @property string|null $constantacoeFeitasFresan
 * @property string|null $recomendacoes
 * @property string|null $medidasMitigacaoONG
 * @property string|null $medidasMitigacaoEstado
 * @property int $userID
 * @property string $estadoValidacao
 * @property string $criadoPor
 * @property string $actualizadoPor
 * @property string $createdAt
 * @property string $UpdatedAt
 */
class Agua extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'agua';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['primeiroReporte', 'actualizacao', 'entidade','infraEstrutura','fonteHidraulica', 'fonteHidraulicaAlternativa','servicoAssociado','novaConstrucao', 'fimAQueSeDestina','capacidadeInfraestrutura','capacidadeUnidadeID','realizadoTesteQualidadeAgua','entidadeResponsavelConstrucao','anosGarantia', 'sistemExtracaoAgua','especificacoesTecnInfraExtru', 'temPlacaVisibilidade','infraAssociadaCampo','nomeCampoAssociadoGrupoID', 'anexoFichaTecnInfraExtr','estadoObra','imagemInfra','dataConclusaoObra','pontoFoiEntregueObra', 'anexoActaEntrega','benHomem','benMulher','totalAFAbrangidos','benCorresponTotalPopulacao', 'totalSuino', 'totalCaprino', 'totalBovino','totalHaIrrigados', 'grupoGestAgua','orientacoesMetodologia','comissaoRealizaReuniosFreq','grupoFazContribuicoes','grupoTemPlanoManutencaoPrev', 'grupoTemPlanoManutencaoUrgen',
                'comissaoHomem', 'comissaoMulher', 'grupoFazParteACA', 'grupoEstaAssociadoBMAS', 'existeAcompaMuniEneAgua', 'nTecniAcompanham','nTecniParticipamReunioes', 'metodologiaAdoptada','criteriosUtilizadoParaSeleBenef','benHomemTransSocial', 'benMulherTransSocial','totalAFCorrespondenteTransSocial', 'valorDiarioBeneUnidadeID', 'valorDiarioBeneUnidadeID','nDiasTrabalho','totalEntregueTranBen','anexoTermoPagamento', 'desafiosONG', 'licoesAprendidadasONG','dataVisitaFresan','tecnicoResponsavelFresan','constantacoeFeitasFresan', 'recomendacoes', 'medidasMitigacaoONG', 'medidasMitigacaoEstado','provinciaID', 'createdAt', 'UpdatedAt'], 'safe'],
          
            [['capacidadeUnidadeID', 'benMulher','benHomem','primeiroReporte','provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'infraEstrutura', 'fonteHidraulica', 'servicoAssociado',  'entidadeResponsavelConstrucao', 'sistemExtracaoAgua',   'userID', 'estadoValidacao'], 'required'],
            [['entidade', 'infraEstrutura', 'fonteHidraulica', 'servicoAssociado', 'novaConstrucao', 'fimAQueSeDestina', 'realizadoTesteQualidadeAgua', 'entidadeResponsavelConstrucao', 'sistemExtracaoAgua', 'especificacoesTecnInfraExtru', 'temPlacaVisibilidade', 'infraAssociadaCampo', 'estadoObra', 'pontoFoiEntregueObra', 'benCorresponTotalPopulacao', 'grupoGestAgua', 'comissaoRealizaReuniosFreq', 'grupoFazContribuicoes', 'grupoTemPlanoManutencaoPrev', 'grupoTemPlanoManutencaoUrgen', 'grupoFazParteACA', 'grupoEstaAssociadoBMAS', 'existeAcompaMuniEneAgua', 'nTecniParticipamReunioes', 'metodologiaAdoptada', 'criteriosUtilizadoParaSeleBenef', 'estadoValidacao'], 'string'],
            [['municipioID', 'comunaID', 'localidadeID', 'capacidadeUnidadeID', 'anosGarantia', 'nomeCampoAssociadoGrupoID', 'benHomem', 'benMulher', 'totalAFAbrangidos', 'totalSuino', 'totalCaprino', 'totalBovino', 'comissaoHomem', 'comissaoMulher', 'nTecniAcompanham', 'benHomemTransSocial', 'benMulherTransSocial', 'totalAFCorrespondenteTransSocial', 'valorDiarioBeneUnidadeID', 'nDiasTrabalho', 'userID'], 'integer'],
            [['capacidadeInfraestrutura', 'totalHaIrrigados', 'valorDiarioBene', 'totalEntregueTranBen'], 'number'],
            [['respondente', 'latitude', 'longitude', 'anexoFichaTecnInfraExtr', 'imagemInfra', 'anexoActaEntrega', 'anexoTermoPagamento', 'desafiosONG', 'licoesAprendidadasONG', 'tecnicoResponsavelFresan', 'constantacoeFeitasFresan', 'recomendacoes', 'medidasMitigacaoONG', 'medidasMitigacaoEstado'], 'string', 'max' => 255],
            [['orientacoesMetodologia'], 'string', 'max' => 50],
            [['estadoValidacao', 'criadoPor', 'actualizadoPor'], 'string', 'max' => 100],
            ['latitude', 'match', 'pattern' => '/^-?\d+\.\d+$/', 'message' => 'Latitude inválida. Ex: -8.656742724'],
            ['longitude', 'match', 'pattern' => '/^-?\d+\.\d+$/', 'message' => 'Longitude inválida.Ex 13.519309677'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'Id' => Yii::t('app', 'ID'),
            'primeiroReporte' => Yii::t('app', 'Primeiro Reporte'),
            'actualizacao' => Yii::t('app', 'Actualização'),
            'respondente' => Yii::t('app', 'Respondente'),
            'entidade' => Yii::t('app', 'Entidade'),
            'provinciaID' => Yii::t('app', 'Província'),
            'municipioID' => Yii::t('app', 'Município'),
            'comunaID' => Yii::t('app', 'Comuna'),
            'localidadeID' => Yii::t('app', 'Localidade'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'infraEstrutura' => Yii::t('app', 'Infraestrutura Hidráulica'),
            'fonteHidraulica' => Yii::t('app', 'Fonte Hidríca Principal'),
            'fonteHidraulicaAlternativa' => Yii::t('app', 'Fonte Hidríca Alternativa'),
            'servicoAssociado' => Yii::t('app', 'Serviço Associado'),
            'novaConstrucao' => Yii::t('app', 'Nova Construção ou Reabilitação?'),
            'fimAQueSeDestina' => Yii::t('app', 'Fim A Que Se Destina'),
            'capacidadeInfraestrutura' => Yii::t('app', 'Capacidade da Infraestrutura (em litros)'),
            'capacidadeUnidadeID' => Yii::t('app', 'Capacidade (unidade)'),
            'realizadoTesteQualidadeAgua' => Yii::t('app', 'Realizado Teste de Qualidade da Água'),
            'entidadeResponsavelConstrucao' => Yii::t('app', 'Entidade responsável pela Construção/Reabilitação'),
            'anosGarantia' => Yii::t('app', 'Garantia (Nº de Anos)'),
            'sistemExtracaoAgua' => Yii::t('app', 'Sistema de Extracção e Distribuição de Água'),
            'especificacoesTecnInfraExtru' => Yii::t('app', 'Especificações  Técnica da Infraestrutura'),
            'temPlacaVisibilidade' => Yii::t('app', 'Tem placa de visibilidade'),
            'infraAssociadaCampo' => Yii::t('app', 'Infraestrutura está associada a Campo Agro-Pecuário?'),
            'nomeCampoAssociadoGrupoID' => Yii::t('app', 'Nome/ID do Campo Agropecuário a que está Associada (referência folha C.Agricultura)'),
            'anexoFichaTecnInfraExtr' => Yii::t('app', 'Anexar ficha técnica infraestrutura'),
            'estadoObra' => Yii::t('app', 'Estado da obra'),
            'imagemInfra' => Yii::t('app', 'Anexar Imagem do estado actual da infraestrutura de água'),
            'dataConclusaoObra' => Yii::t('app', 'Data de Conclusão da Obra'),
            'pontoFoiEntregueObra' => Yii::t('app', 'Ponto foi entregue a que Entidade'),
            'anexoActaEntrega' => Yii::t('app', 'Anexar Ata de Entrega'),
            'benHomem' => Yii::t('app', 'Beneficiários Homem'),
            'benMulher' => Yii::t('app', 'Beneficiários Mulher'),
            'totalAFAbrangidos' => Yii::t('app', 'Total de AF abrangidos'),
            'benCorresponTotalPopulacao' => Yii::t('app', 'Beneficiários correspondem à totalidade da população da comunidade?'),
            'totalSuino' => Yii::t('app', 'Total de Suinos'),
            'totalCaprino' => Yii::t('app', 'Total de caprino/ovino'),
            'totalBovino' => Yii::t('app', 'Total de bovino'),
            'totalHaIrrigados' => Yii::t('app', 'Total de Hectares Irrigados'),
            'grupoGestAgua' => Yii::t('app', 'Possui Grupo de Gestão do Ponto de Água?'),
            'orientacoesMetodologia' => Yii::t('app', 'Orientações com base em qual metodologia?'),
            'comissaoRealizaReuniosFreq' => Yii::t('app', 'Comissão realiza reuniões com que frequência'),
            'grupoFazContribuicoes' => Yii::t('app', 'O grupo faz recolha de contribuições aos consumidores?'),
            'grupoTemPlanoManutencaoPrev' => Yii::t('app', 'O grupo tem um plano de manutenção preventiva do ponto?'),
            'grupoTemPlanoManutencaoUrgen' => Yii::t('app', 'O grupo tem um plano de manutenção de urgência do ponto?'),
            'comissaoHomem' => Yii::t('app', 'Comissão Homem'),
            'comissaoMulher' => Yii::t('app', 'Comissão Mulher'),
            'grupoFazParteACA' => Yii::t('app', 'O grupo faz parte da Associação de Consumidores de Água (ACA) da comuna?'),
            'grupoEstaAssociadoBMAS' => Yii::t('app', 'O grupo está associado à Brigada Municipal de Água e Saneamento (BMAS)'),
            'existeAcompaMuniEneAgua' => Yii::t('app', 'Existe um Acompanhamento por Parte da Secção Municipal de Energia e Água?'),
            'nTecniAcompanham' => Yii::t('app', 'Nº de Técnicos da Secção Municipal de Energia e Água que Acompanham'),
            'nTecniParticipamReunioes' => Yii::t('app', 'Técnicos Participam nas Reuniões da Comissão?'),
            'metodologiaAdoptada' => Yii::t('app', 'Metodologia adoptada'),
            'criteriosUtilizadoParaSeleBenef' => Yii::t('app', 'Critérios utilizados para a selecção dos beneficiários'),
            'benHomemTransSocial' => Yii::t('app', 'Beneficiários Homem'),
            'benMulherTransSocial' => Yii::t('app', 'Beneficiários Mulher'),
            'totalAFCorrespondenteTransSocial' => Yii::t('app', 'Total de AF (correspondentes)'),
            'valorDiarioBene' => Yii::t('app', 'Valor diário por beneficiário'),
            'valorDiarioBeneUnidadeID' => Yii::t('app', 'Valor Diario Bene Unidade (Medida)'),
            'nDiasTrabalho' => Yii::t('app', 'Nº de dias de trabalho'),
            'totalEntregueTranBen' => Yii::t('app', 'Total Entregue Tran Ben'),
            'anexoTermoPagamento' => Yii::t('app', 'Anexar o termo de pagamento'),
            'desafiosONG' => Yii::t('app', 'Desafios durante a implementação'),
            'licoesAprendidadasONG' => Yii::t('app', 'Lições aprendidas durante implementação'),
            'dataVisitaFresan' => Yii::t('app', 'Data da visita'),
            'tecnicoResponsavelFresan' => Yii::t('app', 'Técnico responsável'),
            'constantacoeFeitasFresan' => Yii::t('app', 'Constatações feitas (max. 3)'),
            'recomendacoes' => Yii::t('app', 'Recomendações Principais (max 3)'),
            'medidasMitigacaoONG' => Yii::t('app', 'Medidas de Mitigação ONG'),
            'medidasMitigacaoEstado' => Yii::t('app', 'Medidas de Mitigação Estado'),
            'userID' => Yii::t('app', 'User ID'),
            'estadoValidacao' => Yii::t('app', 'Estado Validação'),
            'criadoPor' => Yii::t('app', 'Criado Por'),
            'actualizadoPor' => Yii::t('app', 'Actualizado Por'),
            'createdAt' => Yii::t('app', 'Data de Criação do Registo'),
            'UpdatedAt' => Yii::t('app', 'Data de Actualição do Registo'),
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
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia() {
        return $this->hasOne(Provincia::class, ['Id' => 'provinciaID']);
    }
    public function getGrupo() {
        return $this->hasOne(Grupo::class, ['Id' => 'nomeCampoAssociadoGrupoID']);
    }
    public function getUser() {
        return $this->hasOne(\common\models\User::class, ['Id' => 'userID']);
    }
    public function getUnidade() {
        return $this->hasOne(Unidade::class, ['Id' => 'capacidadeUnidadeID']);
    }

    // metodo para definir qual botao aparecer para o usuario, validar, aprovar ou publicar
    public function getAcoesBotoes() {
        $user = Yii::$app->user;
        $acoes = [];

        if ($user->can('Permissao Validador de dados') or \Yii::$app->user->can('Permissão de Administrador')) {
            $acoes[] = ['label' => '', 'url' => ['validar', 'id' => $this->Id], 'class' => 'btn btn-success fas fa-check-square '];
        }

        if ($user->can('Perfil Aprovação de dados') or \Yii::$app->user->can('Permissão de Administrador')) {
            $acoes[] = ['label' => '', 'url' => ['aprovar', 'id' => $this->Id], 'class' => 'btn btn-primary fas fa-thumbs-up'];
        }

        if ($user->can('Perfil Lancamento') or \Yii::$app->user->can('Permissão de Administrador')) {
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
    public function getAnexofichaInfra() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexoFichaTecnInfraExtr)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexoFichaTecnInfraExtr);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexoFichaTecnInfraExtr, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->anexoFichaTecnInfraExtr);
                }
            }
        }

        return null;
    }

    public function getAnexoActa() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexoActaEntrega)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexoActaEntrega);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexoActaEntrega, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->anexoActaEntrega);
                }
            }
        }

        return null;
    }

    public function getTermoPag() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexoTermoPagamento)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexoTermoPagamento);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexoTermoPagamento, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->anexoTermoPagamento);
                }
            }
        }

        return null;
    }

    public function getAnexImagemInfra() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->imagemInfra)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->imagemInfra);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->imagemInfra, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->imagemInfra);
                }
            }
        }

        return null;
    }
}
