<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "reforcoinstitucional".
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
 * @property string $entidadeApoiada
 * @property string $apoioCapacitacao
 * @property string|null $temaAbordadoSessoes
 * @property int|null $nSessoesPublicoAlvo
 * @property string|null $nSessoesPubliTrimestre
 * @property int|null $nHorasSessoes
 * @property int|null $participantesFormacaoHomem
 * @property int|null $participantesFormacaoMulher
 * @property string|null $participantesFormacaoTrimestre
 * @property string|null $anexoProgramaFormacao
 * @property string|null $descricaoEquipamentos
 * @property int|null $qtdEquipEntregues
 * @property string|null $anexoTermoEntreEquipamento
 * @property int|null $nAnimaisVacinadosCampanha
 * @property string|null $meiosEntreguEntiCampanhaVacinacaoDesc
 * @property int|null $nmeiosDistriEntiCampanhaVacinacao
 * @property string|null $anexoTermoEntrMeiosCampanhaVacinacao
 * @property int|null $trataGadoForamMapeadosHomem
 * @property int|null $trataGadoForamMapeadosMulher
 * @property string|null $trataGadoForamMapeadosTrim
 * @property string|null $temaAbordadoFormaGado
 * @property int|null $nSessoesRealiFormGado
 * @property string|null $nSessoesRealiFormGadoTrimestre
 * @property int|null $nTotalHorasFormacaoGado
 * @property int|null $participantesFormacaoGadoHomem
 * @property int|null $participantesFormacaoGadoMulher
 * @property string|null $participantesFormacaoGadoTrimestre
 * @property int|null $totalCabecaGado
 * @property string|null $anexoProgramaFormaGado
 * @property string|null $distriKitVeterinaria
 * @property string|null $composicaoKitVeter
 * @property int|null $nTotalKitDistribuido
 * @property string|null $anexoKitDistri
 * @property string|null $desafiosImplementacaoONG
 * @property string|null $licoesAprendidasONG
 * @property string|null $dataVisitaFresan
 * @property string|null $tecnicoResponsavelFresan
 * @property string|null $constantacoeFeitasFresan
 * @property string|null $recomendacoes
 * @property string|null $medidasMitigacaoONG
 * @property string|null $medidasMitigacaoEstado
 * @property int $userID
 *
 * @property Comuna $comuna
 * @property Localidade $localidade
 * @property Municipio $municipio
 * @property Provincia $provincia
 * @property User $user
 */
class Reforcoinstitucional extends \yii\db\ActiveRecord {

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'reforcoinstitucional';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['primeiroReporte', 'actualizacao', 'nSessoesPubliTrimestre', 'trataGadoForamMapeadosTrim', 'nSessoesRealiFormGadoTrimestre', 'participantesFormacaoTrimestre', 'participantesFormacaoGadoTrimestre', 'dataVisitaFresan'], 'safe'],
            [['entidade', 'provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'entidadeApoiada', 'apoioCapacitacao', 'userID'], 'required'],
            [['provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'nSessoesPublicoAlvo', 'nHorasSessoes', 'participantesFormacaoHomem', 'participantesFormacaoMulher', 'qtdEquipEntregues', 'nAnimaisVacinadosCampanha', 'nmeiosDistriEntiCampanhaVacinacao', 'trataGadoForamMapeadosHomem', 'trataGadoForamMapeadosMulher', 'nSessoesRealiFormGado', 'nTotalHorasFormacaoGado', 'participantesFormacaoGadoHomem', 'participantesFormacaoGadoMulher', 'totalCabecaGado', 'nTotalKitDistribuido', 'userID'], 'integer'],
            [['apoioCapacitacao', 'temaAbordadoSessoes', 'descricaoEquipamentos', 'meiosEntreguEntiCampanhaVacinacaoDesc', 'composicaoKitVeter', 'desafiosImplementacaoONG', 'licoesAprendidasONG'], 'string'],
            [['respondente', 'latitude', 'longitude', 'anexoProgramaFormacao', 'anexoTermoEntreEquipamento', 'anexoTermoEntrMeiosCampanhaVacinacao', 'temaAbordadoFormaGado', 'anexoProgramaFormaGado', 'anexoKitDistri', 'constantacoeFeitasFresan', 'recomendacoes', 'medidasMitigacaoONG', 'medidasMitigacaoEstado'], 'string', 'max' => 255],
            [['entidade', 'entidadeApoiada', 'tecnicoResponsavelFresan'], 'string', 'max' => 50],
            [['distriKitVeterinaria'], 'string', 'max' => 3],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userID' => 'id']],
            [['localidadeID'], 'exist', 'skipOnError' => true, 'targetClass' => Localidade::class, 'targetAttribute' => ['localidadeID' => 'Id']],
            [['provinciaID'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::class, 'targetAttribute' => ['provinciaID' => 'Id']],
            [['comunaID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::class, 'targetAttribute' => ['comunaID' => 'Id']],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
            [['anexoProgramaFormacao', 'anexoTermoEntreEquipamento', 'anexoTermoEntrMeiosCampanhaVacinacao', 'anexoProgramaFormaGado', 'anexoKitDistri'], 'file', 'extensions' => 'jpg, png,pdf,doc,docx,xls,xlsx',],
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
            'provinciaID' => Yii::t('app', 'Provincia'),
            'municipioID' => Yii::t('app', 'Municipio'),
            'comunaID' => Yii::t('app', 'Comuna'),
            'localidadeID' => Yii::t('app', 'Localidade'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'entidadeApoiada' => Yii::t('app', 'Entidade Apoiada'),
            'apoioCapacitacao' => Yii::t('app', 'Apoio Capacitacao'),
            'temaAbordadoSessoes' => Yii::t('app', 'Tema Abordado Sessoes'),
            'nSessoesPublicoAlvo' => Yii::t('app', 'N Sessoes Publico Alvo'),
            'nSessoesPubliTrimestre' => Yii::t('app', 'N Sessoes Publi Trimestre'),
            'nHorasSessoes' => Yii::t('app', 'N Horas Sessoes'),
            'participantesFormacaoHomem' => Yii::t('app', 'Participantes Formacao Homem'),
            'participantesFormacaoMulher' => Yii::t('app', 'Participantes Formacao Mulher'),
            'participantesFormacaoTrimestre' => Yii::t('app', 'Participantes Formacao Trimestre'),
            'anexoProgramaFormacao' => Yii::t('app', 'Anexo Programa Formacao'),
            'descricaoEquipamentos' => Yii::t('app', 'Descricao Equipamentos'),
            'qtdEquipEntregues' => Yii::t('app', 'Qtd Equip Entregues'),
            'anexoTermoEntreEquipamento' => Yii::t('app', 'Anexo Termo Entre Equipamento'),
            'nAnimaisVacinadosCampanha' => Yii::t('app', 'N Animais Vacinados Campanha'),
            'meiosEntreguEntiCampanhaVacinacaoDesc' => Yii::t('app', 'Meios Entregu Enti Campanha Vacinacao Desc'),
            'nmeiosDistriEntiCampanhaVacinacao' => Yii::t('app', 'Nmeios Distri Enti Campanha Vacinacao'),
            'anexoTermoEntrMeiosCampanhaVacinacao' => Yii::t('app', 'Anexo Termo Entr Meios Campanha Vacinacao'),
            'trataGadoForamMapeadosHomem' => Yii::t('app', 'Trata Gado Foram Mapeados Homem'),
            'trataGadoForamMapeadosMulher' => Yii::t('app', 'Trata Gado Foram Mapeados Mulher'),
            'trataGadoForamMapeadosTrim' => Yii::t('app', 'Trata Gado Foram Mapeados Trim'),
            'temaAbordadoFormaGado' => Yii::t('app', 'Tema Abordado Forma Gado'),
            'nSessoesRealiFormGado' => Yii::t('app', 'N Sessoes Reali Form Gado'),
            'nSessoesRealiFormGadoTrimestre' => Yii::t('app', 'N Sessoes Reali Form Gado Trimestre'),
            'nTotalHorasFormacaoGado' => Yii::t('app', 'N Total Horas Formacao Gado'),
            'participantesFormacaoGadoHomem' => Yii::t('app', 'Participantes Formacao Gado Homem'),
            'participantesFormacaoGadoMulher' => Yii::t('app', 'Participantes Formacao Gado Mulher'),
            'participantesFormacaoGadoTrimestre' => Yii::t('app', 'Participantes Formacao Gado Trimestre'),
            'totalCabecaGado' => Yii::t('app', 'Total Cabeca Gado'),
            'anexoProgramaFormaGado' => Yii::t('app', 'Anexo Programa Forma Gado'),
            'distriKitVeterinaria' => Yii::t('app', 'Distri Kit Veterinaria'),
            'composicaoKitVeter' => Yii::t('app', 'Composicao Kit Veter'),
            'nTotalKitDistribuido' => Yii::t('app', 'N Total Kit Distribuido'),
            'anexoKitDistri' => Yii::t('app', 'Anexo Kit Distri'),
            'desafiosImplementacaoONG' => Yii::t('app', 'Desafios Implementacao Ong'),
            'licoesAprendidasONG' => Yii::t('app', 'Licoes Aprendidas Ong'),
            'dataVisitaFresan' => Yii::t('app', 'Data Visita Fresan'),
            'tecnicoResponsavelFresan' => Yii::t('app', 'Tecnico Responsavel Fresan'),
            'constantacoeFeitasFresan' => Yii::t('app', 'Constantacoe Feitas Fresan'),
            'recomendacoes' => Yii::t('app', 'Recomendacoes'),
            'medidasMitigacaoONG' => Yii::t('app', 'Medidas Mitigacao Ong'),
            'medidasMitigacaoEstado' => Yii::t('app', 'Medidas Mitigacao Estado'),
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
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia() {
        return $this->hasOne(Provincia::class, ['Id' => 'provinciaID']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'userID']);
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
    public function getEstadoreforcoinstitucional() {
        return $statuses = Reforcoinstitucional::find()
                ->select(['estadoValidacao'])
                ->distinct()
                ->asArray()
                ->all();
    }

    public static function getEnumValues($attribute) {
        $values = Yii::$app->db->createCommand("SHOW COLUMNS FROM {{%user}} LIKE '{$attribute}'")->queryOne();
        $values = str_replace("enum('", '', $values['Type']);
        $values = str_replace("')", '', $values);
        $values = explode("','", $values);

        return array_combine($values, $values);
    }

    //obtem o Id do municipio para carregar na depDrop municipio
    public function getMunicipioId($id) {
        // Consulta ao banco de dados para obter o ID do município desejado
        // Suponhamos que você queira obter o ID com base em algum critério
        $municipio = Municipio::find()
                ->where(['Id' => $id])
                ->one();

        if ($municipio) {
            // Retorna o ID do município
            return $municipio->Id;
        } else {
            // Se o município não for encontrado, retorne um valor padrão ou uma mensagem de erro, conforme necessário
            return null; // Ou algum outro valor padrão
        }
    }

    public function getAnexoProgrForm() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexoProgramaFormacao)) {
            $filePath = Yii::getAlias('@webroot/uploads/anexoProgramaFormacao' . $this->anexoProgramaFormacao);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexoProgramaFormacao, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->anexoProgramaFormacao);
                }
            }
        }

        return null;
    }

    public function getAnexoTermEntre() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexoTermoEntreEquipamento)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexoTermoEntreEquipamento);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexoTermoEntreEquipamento, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->anexoTermoEntreEquipamento);
                }
            }
        }

        return null;
    }
    public function getAnexoTermEntreMeiosV() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexoTermoEntrMeiosCampanhaVacinacao)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexoTermoEntrMeiosCampanhaVacinacao);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexoTermoEntrMeiosCampanhaVacinacao, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->anexoTermoEntrMeiosCampanhaVacinacao);
                }
            }
        }

        return null;
    }
    public function getAnexoProgGado() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexoProgramaFormaGado)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexoProgramaFormaGado);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexoProgramaFormaGado, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->anexoProgramaFormaGado);
                }
            }
        }

        return null;
    }
    public function getAnexoKit() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexoKitDistri)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexoKitDistri);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexoKitDistri, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->anexoKitDistri);
                }
            }
        }

        return null;
    }
}
