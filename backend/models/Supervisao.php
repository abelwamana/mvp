<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "supervisao".
 *
 * @property int $Id
 * @property int $provinciaID
 * @property int $municipioID
 * @property int $comunaID
 * @property int $localidadeID
 * @property string|null $supervisionadoNome
 * @property int|null $qtdSupervisionadoTrimestre
 * @property string|null $supervisionadoTrimestre
 * @property int|null $profissionaisSupervisionadoHomem
 * @property int|null $profissionaisSupervisionadoMulher
 * @property string|null $primeiroReporte
 * @property string|null $actualizacao
 * @property string|null $respondente
 * @property string $entidade
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $desafiosImplementacaoONG
 * @property string|null $licoesImplementacaoONG
 * @property string|null $dataVisitaFresan
 * @property string|null $tecnicoResponsavelFresan
 * @property string|null $constatacoesFeitasFresan
 * @property string|null $recomendacoesPrincipaisFresan
 * @property string|null $medidasMitigacaoONG
 * @property string|null $medidasMitigacaoEstado
 * @property int $userID
 * @property string $estadoValidacao
 * @property string $criadoPor
 * @property string $actualizadoPor
 * @property string $createdAt
 * @property string $UpdatedAt
 *
 * @property Comuna $comuna
 * @property Localidade $localidade
 * @property Municipio $municipio
 * @property Provincia $provincia
 */
class Supervisao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supervisao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'entidade', 'userID', 'estadoValidacao', 'criadoPor', 'actualizadoPor', 'createdAt', 'UpdatedAt'], 'required'],
            [['provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'qtdSupervisionadoTrimestre', 'profissionaisSupervisionadoHomem', 'profissionaisSupervisionadoMulher', 'userID'], 'integer'],
            [['supervisionadoTrimestre', 'primeiroReporte', 'actualizacao', 'dataVisitaFresan', 'createdAt', 'UpdatedAt'], 'safe'],
            [['desafiosImplementacaoONG', 'licoesImplementacaoONG', 'recomendacoesPrincipaisFresan', 'estadoValidacao'], 'string'],
            [['supervisionadoNome', 'entidade', 'medidasMitigacaoEstado'], 'string', 'max' => 50],
            [['respondente', 'latitude', 'longitude', 'constatacoesFeitasFresan', 'medidasMitigacaoONG'], 'string', 'max' => 255],
            [['tecnicoResponsavelFresan', 'criadoPor', 'actualizadoPor'], 'string', 'max' => 100],
            [['comunaID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::class, 'targetAttribute' => ['comunaID' => 'Id']],
            [['localidadeID'], 'exist', 'skipOnError' => true, 'targetClass' => Localidade::class, 'targetAttribute' => ['localidadeID' => 'Id']],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
            [['provinciaID'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::class, 'targetAttribute' => ['provinciaID' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'provinciaID' => Yii::t('app', 'Provincia'),
            'municipioID' => Yii::t('app', 'Municipio'),
            'comunaID' => Yii::t('app', 'Comuna'),
            'localidadeID' => Yii::t('app', 'Localidade'),
            'supervisionadoNome' => Yii::t('app', 'Supervisionado Nome'),
            'qtdSupervisionadoTrimestre' => Yii::t('app', 'Qtd Supervisionado Trimestre'),
            'supervisionadoTrimestre' => Yii::t('app', 'Supervisionado Trimestre'),
            'profissionaisSupervisionadoHomem' => Yii::t('app', 'Profissionais Supervisionado Homem'),
            'profissionaisSupervisionadoMulher' => Yii::t('app', 'Profissionais Supervisionado Mulher'),
            'primeiroReporte' => Yii::t('app', 'Primeiro Reporte'),
            'actualizacao' => Yii::t('app', 'Actualizacao'),
            'respondente' => Yii::t('app', 'Respondente'),
            'entidade' => Yii::t('app', 'Entidade'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'desafiosImplementacaoONG' => Yii::t('app', 'Desafios Implementacao Ong'),
            'licoesImplementacaoONG' => Yii::t('app', 'Licoes Implementacao Ong'),
            'dataVisitaFresan' => Yii::t('app', 'Data Visita Fresan'),
            'tecnicoResponsavelFresan' => Yii::t('app', 'Tecnico Responsavel Fresan'),
            'constatacoesFeitasFresan' => Yii::t('app', 'Constatacoes Feitas Fresan'),
            'recomendacoesPrincipaisFresan' => Yii::t('app', 'Recomendacoes Principais Fresan'),
            'medidasMitigacaoONG' => Yii::t('app', 'Medidas Mitigacao Ong'),
            'medidasMitigacaoEstado' => Yii::t('app', 'Medidas Mitigacao Estado'),
            'userID' => Yii::t('app', 'User ID'),
            'estadoValidacao' => Yii::t('app', 'Estado Validacao'),
            'criadoPor' => Yii::t('app', 'Criado Por'),
            'actualizadoPor' => Yii::t('app', 'Actualizado Por'),
            'createdAt' => Yii::t('app', 'Created At'),
            'UpdatedAt' => Yii::t('app', 'Updated At'),
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
     // metodo para definir qual botao aparecer para o usuario, validar, aprovar ou publicar
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
}
