<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "demostracoesculinarias".
 *
 * @property int $Id
 * @property int $provinciaID
 * @property int $municipioID
 * @property int $comunaID
 * @property int $localidadeID
 * @property int|null $nDemostracaoCulinaria
 * @property string|null $nDemostracaoCulinariaTrimestre
 * @property int|null $beneficiariosDemoCuliHomem
 * @property int|null $beneficiariosDemoCuliMulher
 * @property int|null $anexoEvidenciaDemonsCulinaria
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
 * @property int|null $nomeGrupoID
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
class Demostracoesculinarias extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'demostracoesculinarias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'entidade', 'userID', 'estadoValidacao', 'criadoPor', 'actualizadoPor', 'createdAt', 'UpdatedAt'], 'required'],
            [['provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'nDemostracaoCulinaria', 'beneficiariosDemoCuliHomem', 'beneficiariosDemoCuliMulher', 'nomeGrupoID', 'userID'], 'integer'],
            [['nDemostracaoCulinariaTrimestre', 'primeiroReporte', 'actualizacao', 'dataVisitaFresan', 'createdAt', 'UpdatedAt', 'anexoEvidenciaDemonsCulinaria'], 'safe'],
            [['desafiosImplementacaoONG', 'licoesImplementacaoONG', 'recomendacoesPrincipaisFresan', 'estadoValidacao',], 'string'],
            [['respondente', 'latitude', 'longitude', 'constatacoesFeitasFresan', 'medidasMitigacaoONG', 'anexoEvidenciaDemonsCulinaria'], 'string', 'max' => 255],
            [['entidade', 'medidasMitigacaoEstado'], 'string', 'max' => 50],
            [['tecnicoResponsavelFresan', 'anexoEvidenciaDemonsCulinaria', 'criadoPor', 'actualizadoPor'], 'string', 'max' => 100],
            [['comunaID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::class, 'targetAttribute' => ['comunaID' => 'Id']],
            [['localidadeID'], 'exist', 'skipOnError' => true, 'targetClass' => Localidade::class, 'targetAttribute' => ['localidadeID' => 'Id']],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
            [['provinciaID'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::class, 'targetAttribute' => ['provinciaID' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'Id' => Yii::t('app', 'ID'),
            'provinciaID' => Yii::t('app', 'Província'),
            'municipioID' => Yii::t('app', 'Município'),
            'comunaID' => Yii::t('app', 'Comuna'),
            'localidadeID' => Yii::t('app', 'Localidade'),
            'nDemostracaoCulinaria' => Yii::t('app', 'Nº Demostração Culinária'),
            'nDemostracaoCulinariaTrimestre' => Yii::t('app', 'Nº Demostração Culinária Trimestre'),
            'beneficiariosDemoCuliHomem' => Yii::t('app', 'Beneficiários Demo. Culi. Homem'),
            'beneficiariosDemoCuliMulher' => Yii::t('app', 'Beneficiários Demo. Culi. Mulher'),
            'anexoEvidenciaDemonsCulinaria' => Yii::t('app', 'Anexo Evidência Demo. Culinária'),
            'primeiroReporte' => Yii::t('app', 'Primeiro Reporte'),
            'actualizacao' => Yii::t('app', 'Actualização'),
            'respondente' => Yii::t('app', 'Respondente'),
            'entidade' => Yii::t('app', 'Entidade'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'desafiosImplementacaoONG' => Yii::t('app', 'Desafios Implementação ONG'),
            'licoesImplementacaoONG' => Yii::t('app', 'Licoes Implementação ONG'),
            'dataVisitaFresan' => Yii::t('app', 'Data Visita FRESAN'),
            'tecnicoResponsavelFresan' => Yii::t('app', 'Técnico Responsável FRESAN'),
            'constatacoesFeitasFresan' => Yii::t('app', 'Constatações Feitas FRESAN'),
            'recomendacoesPrincipaisFresan' => Yii::t('app', 'Recomendações Principais FRESAN'),
            'medidasMitigacaoONG' => Yii::t('app', 'Medidas Mitigação ONG'),
            'medidasMitigacaoEstado' => Yii::t('app', 'Medidas Mitigação Estado'),
            'nomeGrupoID' => Yii::t('app', 'Nome do Grupo'),
            'userID' => Yii::t('app', 'Usuario'),
            'estadoValidacao' => Yii::t('app', 'Estado Validação'),
            'criadoPor' => Yii::t('app', 'Criado Por'),
            'actualizadoPor' => Yii::t('app', 'Actualizado Por'),
            'createdAt' => Yii::t('app', 'Criado..'),
            'UpdatedAt' => Yii::t('app', 'Actualizado..'),
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
    public function getAnexoLink() {
    // Verifique se o caminho do anexo existe
    if (!empty($this->anexoEvidenciaDemonsCulinaria)) {
        $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexoEvidenciaDemonsCulinaria);

        if (file_exists($filePath)) {
            $ext = pathinfo($this->anexoEvidenciaDemonsCulinaria, PATHINFO_EXTENSION);
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

            if (in_array($ext, $allowedExtensions)) {
                return Yii::getAlias('@web/uploads/' . $this->anexoEvidenciaDemonsCulinaria);
            }
        }
    }

    return null;
}


   
}
