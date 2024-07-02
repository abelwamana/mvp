<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "biblioteca".
 *
 * @property int $id
 * @property string $convite
 * @property string|null $actividade
 * @property string $organizacao
 * @property string $codigo
 * @property string $titulo
 * @property string $autores
 * @property string $tema
 * @property string $descricao
 * @property string $classificacao
 * @property string $tipo
 * @property string $estado
 * @property string|null $dataEstado
 * @property int $anoConcluido
 * @property int $numPagina
 * @property string $responsavelGestorUIC
 * @property string $usuarios
 * @property string $informacaoPlanilha
 * @property int $monitoriatemarquivo
 * @property int $estaNoSiteFRESANLBC
 * @property string $linkFresanLbc
 * @property string|null $tipo_arquivo
 * @property int|null $tamanho_arquivo
 * @property string|null $data_upload
 */
class Biblioteca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public $printFile;
    
    public static function tableName()
    {
        return 'biblioteca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['convite', 'organizacao', 'codigo', 'nome', 'autores', 'tema', 'descricao', 'classificacao', 'tipo', 'estado', 'anoConcluido', 'numPagina', 'responsavelGestorUIC', 'usuarios', 'informacaoPlanilha', 'monitoriatemarquivo', 'estaNoSiteFRESANLBC', 'linkFresanLbc'], 'required'],
            [['descricao','usuarios'], 'string'],
            [['dataEstado', 'data_upload'], 'safe'],
            [['anoConcluido', 'numPagina', 'monitoriatemarquivo', 'estaNoSiteFRESANLBC', 'tamanho_arquivo'], 'integer'],
            [['convite', 'actividade', 'codigo', 'classificacao', 'tipo', 'estado',], 'string', 'max' => 20],
            [['organizacao', 'responsavelGestorUIC', 'tipo_arquivo'], 'string', 'max' => 50],
            [['autores', 'arquivo'], 'string', 'max' => 256],
            [['nome', 'tema'], 'string', 'max' => 500],
            [['informacaoPlanilha'], 'string', 'max' => 40],
            [['file', 'printFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, doc, docx, xls, xlsx, mp4, jpg, png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'convite' => Yii::t('app', 'Convite'),
            'actividade' => Yii::t('app', 'Actividade'),
            'organizacao' => Yii::t('app', 'Organização'),
            'codigo' => Yii::t('app', 'Código'),
            'nome' => Yii::t('app', 'Nome'),
            'autores' => Yii::t('app', 'Autores'),
            'tema' => Yii::t('app', 'Tema'),
            'descricao' => Yii::t('app', 'Descrição'),
            'classificacao' => Yii::t('app', 'Classificação'),
            'tipo' => Yii::t('app', 'Tipo'),
            'estado' => Yii::t('app', 'Estado'),
            'dataEstado' => Yii::t('app', 'Data'),
            'anoConcluido' => Yii::t('app', 'Ano'),
            'numPagina' => Yii::t('app', 'Número de Páginas'),
            'responsavelGestorUIC' => Yii::t('app', 'Responsável/Gestor UIC'),
            'usuarios' => Yii::t('app', 'Usuários'),
            'informacaoPlanilha' => Yii::t('app', 'Informação da Planilha'),
            'monitoriatemarquivo' => Yii::t('app', 'Arquivado pela Monitoria'),
            'estaNoSiteFRESANLBC' => Yii::t('app', 'Está no Site Fresan/LBC'),
            'linkFresanLbc' => Yii::t('app', 'Link Fresan/LBC'),
            'arquivo' => Yii::t('app', 'Arquivo'),
            'tipo_arquivo' => Yii::t('app', 'Tipo de Arquivo'),
            'tamanho_arquivo' => Yii::t('app', 'Tamanho do Arquivo'),
            'data_upload' => Yii::t('app', 'Data do Upload'),
            'file' => Yii::t('app', 'Documento Arquivo'),
            'print' => Yii::t('app', 'Capa do documento'),
            'printFile' => Yii::t('app', 'Capa do documento'),
            
             
        ];
    }
//    public function upload()
//    {
//        if ($this->validate()) {
//            $this->file->saveAs('biblioteca/' . $this->file->baseName . '.' . $this->file->extension);
//            return true;
//        } else {
//            return false;
//        }
//    }
    public function upload()
    {
        if ($this->validate()) {
            if ($this->file) {
                $this->file->saveAs('biblioteca/' . $this->file->baseName . '.' . $this->file->extension);
                $this->arquivo = $this->file->baseName . '.' . $this->file->extension;
            }
            if ($this->printFile) {
                $this->printFile->saveAs('biblioteca/' . $this->printFile->baseName . '.' . $this->printFile->extension);
                $this->print = 'biblioteca/' . $this->printFile->baseName . '.' . $this->printFile->extension;
            }
            return true;
        } else {
            return false;
        }
    }
}
