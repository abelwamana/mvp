<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "doccomunicacao".
 *
 * @property int $Id
 * @property int $provinciaID
 * @property int $municipioID
 * @property string $primeiroReporte
 * @property string $actualizacao
 * @property string|null $repondente
 * @property string $entidade
 * @property string $actividade
 * @property int $classificacaoDocumentoID
 * @property string|null $nomeDocumentoArtigo
 * @property string $areaTematica
 * @property string|null $descricaoDocumentoArtigo
 * @property string|null $audienciaProduto
 * @property int|null $qtdTotalProduto
 * @property string|null $estado
 * @property string|null $dataConclusao
 * @property string|null $documentoDisponivel
 * @property string|null $documentoCumpreNormasPublicacao
 * @property string|null $documentoValidado
 * @property string|null $anexo
 * @property string|null $hiperlink
 * @property string|null $desafiosImplementacao
 * @property string|null $licoesAprendidas
 * @property string|null $dataMonitoria
 * @property string|null $tecnicoResponsavel
 * @property string|null $recomendacoes
 * @property string|null $estadoCumprimento
 * @property string|null $medidasMitigacaoONG
 * @property string|null $medidasMitigacaoEstado
 * @property int $userID
 *
 * @property Municipio $municipio
 * @property Provincia $provincia
 */
class Doccomunicacao extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    // public $anexo; // Adicione essa linha para definir a propriedade anexo

    public static function tableName() {
        return 'doccomunicacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['provinciaID', 'municipioID', 'primeiroReporte', 'actualizacao', 'entidade', 'actividade', 'classificacaoDocumentoID', 'areaTematica', 'userID'], 'required'],
            [['provinciaID', 'municipioID', 'classificacaoDocumentoID', 'qtdTotalProduto', 'userID'], 'integer'],
            [['primeiroReporte', 'anexo', 'actualizacao', 'dataConclusao', 'dataMonitoria'], 'safe'],
            [['descricaoDocumentoArtigo', 'documentoDisponivel', 'desafiosImplementacao', 'licoesAprendidas', 'recomendacoes', 'medidasMitigacaoONG', 'medidasMitigacaoEstado'], 'string'],
            [['repondente', 'nomeDocumentoArtigo', 'anexo'], 'string', 'max' => 255],
            [['entidade', 'actividade', 'areaTematica', 'audienciaProduto', 'tecnicoResponsavel', 'estadoCumprimento'], 'string', 'max' => 50],
            [['estado'], 'string', 'max' => 30],
            [['documentoCumpreNormasPublicacao', 'documentoValidado'], 'string', 'max' => 3],
            [['hiperlink'], 'string', 'max' => 1000],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
            [['provinciaID'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::class, 'targetAttribute' => ['provinciaID' => 'Id']],
                // [['anexo'], 'file', 'extensions' => 'pdf, jpg, jpeg, png'],
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
            'primeiroReporte' => Yii::t('app', 'Primeiro Reporte'),
            'actualizacao' => Yii::t('app', 'Actualização'),
            'repondente' => Yii::t('app', 'Repondente'),
            'entidade' => Yii::t('app', 'Entidade Implementadora'),
            'actividade' => Yii::t('app', 'Actividade'),
            'classificacaoDocumentoID' => Yii::t('app', 'Classificação Documento'),
            'nomeDocumentoArtigo' => Yii::t('app', 'Nome do Documento/Artigo'),
            'areaTematica' => Yii::t('app', 'Ãrea Temática'),
            'descricaoDocumentoArtigo' => Yii::t('app', 'Descrição Documento/Artigo'),
            'audienciaProduto' => Yii::t('app', 'Audiência Produto'),
            'qtdTotalProduto' => Yii::t('app', 'Qtd Total Produto'),
            'estado' => Yii::t('app', 'Estado'),
            'dataConclusao' => Yii::t('app', 'Data Conclusão'),
            'documentoDisponivel' => Yii::t('app', 'Documento Disponível'),
            'documentoCumpreNormasPublicacao' => Yii::t('app', 'Documento Cumpre Normas Publicação'),
            'documentoValidado' => Yii::t('app', 'Documento Validado'),
            'anexo' => Yii::t('app', 'Anexo'),
            'hiperlink' => Yii::t('app', 'Hiperlink'),
            'desafiosImplementacao' => Yii::t('app', 'Desafios Implementação'),
            'licoesAprendidas' => Yii::t('app', 'Lições Aprendidas'),
            'dataMonitoria' => Yii::t('app', 'Data Monitoria'),
            'tecnicoResponsavel' => Yii::t('app', 'Técnico Responsavel'),
            'recomendacoes' => Yii::t('app', 'Recomendações'),
            'estadoCumprimento' => Yii::t('app', 'Estado Cumprimento'),
            'medidasMitigacaoONG' => Yii::t('app', 'Medidas Mitigação ONG'),
            'medidasMitigacaoEstado' => Yii::t('app', 'Medidas Mitigação Estado'),
            'userID' => Yii::t('app', 'Usuario'),
        ];
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

    public static function getEnumValues($attribute) {
        $values = Yii::$app->db->createCommand("SHOW COLUMNS FROM {{%doccomunicacao}} LIKE '{$attribute}'")->queryOne();
        $values = str_replace("enum('", '', $values['Type']);
        $values = str_replace("')", '', $values);
        $values = explode("','", $values);

        return array_combine($values, $values);
    }

    public function getAnexoLink() {
        // Verifique se o caminho do anexo existe
        if (!empty($this->anexo)) {
            $filePath = Yii::getAlias('@webroot/uploads/' . $this->anexo);

           
            if (file_exists($filePath)) {
                $ext = pathinfo($this->anexo, PATHINFO_EXTENSION);

                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'])) {
                    return Yii::getAlias('@web/uploads/' . $this->anexo);
                }
            }
        }

        return null;
    }
}
