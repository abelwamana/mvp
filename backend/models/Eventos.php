<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "eventos".
 *
 * @property int $Id
 * @property string|null $primeiroReporte
 * @property string|null $actualizacao
 * @property string|null $respondente
 * @property string $entidade
 * @property int $provinciaID
 * @property int $municipioID
 * @property string|null $descricaoTema
 * @property string|null $estadoDescricao
 * @property string|null $parceiro
 * @property string|null $dataRelacionadaEstadForum
 * @property string|null $tematicaAbordada
 * @property string|null $orador
 * @property string|null $localLink
 * @property string|null $publicoAlvo
 * @property int|null $participantesHomem
 * @property int|null $participantesMulher
 * @property string|null $anexoForum
 * @property string|null $desafiosONG
 * @property string|null $licoesONG
 * @property string|null $dataVisitaFresan
 * @property string|null $tecnicoResponsavelFresan
 * @property string|null $constantacoeFeitasFresan
 * @property string|null $recomendacoes
 * @property string|null $medidasMitigacaoONG
 * @property string|null $medidasMitigacaoEstado
 * @property int $userID
 */
class Eventos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['primeiroReporte', 'actualizacao', 'dataRelacionadaEstadForum', 'dataVisitaFresan'], 'safe'],
            [['entidade', 'provinciaID', 'municipioID', 'userID'], 'required'],
            [['provinciaID', 'municipioID', 'participantesHomem', 'participantesMulher', 'userID'], 'integer'],
            [['tematicaAbordada'], 'string'],
            [['respondente', 'orador', 'localLink', 'publicoAlvo', 'anexoForum', 'desafiosONG', 'licoesONG', 'tecnicoResponsavelFresan', 'constantacoeFeitasFresan', 'recomendacoes', 'medidasMitigacaoONG', 'medidasMitigacaoEstado'], 'string', 'max' => 255],
            [['entidade', 'parceiro'], 'string', 'max' => 50],
            [['descricaoTema'], 'string', 'max' => 500],
            [['estadoDescricao'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'primeiroReporte' => Yii::t('app', 'Primeiro Reporte'),
            'actualizacao' => Yii::t('app', 'Actualização'),
            'respondente' => Yii::t('app', 'Respondente'),
            'entidade' => Yii::t('app', 'Entidade'),
            'provinciaID' => Yii::t('app', 'Província'),
            'municipioID' => Yii::t('app', 'Município'),
            'descricaoTema' => Yii::t('app', 'Descrição Tema'),
            'estadoDescricao' => Yii::t('app', 'Estado Descrição'),
            'parceiro' => Yii::t('app', 'Parceiro'),
            'dataRelacionadaEstadForum' => Yii::t('app', 'Data Relacionada Estad Forum'),
            'tematicaAbordada' => Yii::t('app', 'Temática Abordada'),
            'orador' => Yii::t('app', 'Orador'),
            'localLink' => Yii::t('app', 'Local Link'),
            'publicoAlvo' => Yii::t('app', 'Público Alvo'),
            'participantesHomem' => Yii::t('app', 'Participantes Homem'),
            'participantesMulher' => Yii::t('app', 'Participantes Mulher'),
            'anexoForum' => Yii::t('app', 'Anexo Forum'),
            'desafiosONG' => Yii::t('app', 'Desafios ONG'),
            'licoesONG' => Yii::t('app', 'Lições ONG'),
            'dataVisitaFresan' => Yii::t('app', 'Data Visita FRESAN'),
            'tecnicoResponsavelFresan' => Yii::t('app', 'Técnico Responsável FRESAN'),
            'constantacoeFeitasFresan' => Yii::t('app', 'Constantações Feitas FRESAN'),
            'recomendacoes' => Yii::t('app', 'Recomendações'),
            'medidasMitigacaoONG' => Yii::t('app', 'Medidas Mitigação ONG'),
            'medidasMitigacaoEstado' => Yii::t('app', 'Medidas Mitigação Estado'),
            'userID' => Yii::t('app', 'Usuário'),
        ];
    }
    
    /**
     * Gets query for [[Comuna]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComuna()
    {
        return $this->hasOne(Comuna::class, ['Id' => 'comunaID']);
    }

    /**
     * Gets query for [[Localidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidade()
    {
        return $this->hasOne(Localidade::class, ['Id' => 'localidadeID']);
    }

    /**
     * Gets query for [[Municipio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::class, ['Id' => 'municipioID']);
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::class, ['Id' => 'provinciaID']);
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
     public function getAnexoLink() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexoForum)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexoForum);

            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexoForum, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

                if (in_array($ext, $allowedExtensions)) {
                    return Yii::getAlias('@web/uploads/' . $this->anexoForum);
                }
            }
        }

        return null;
    }
}
