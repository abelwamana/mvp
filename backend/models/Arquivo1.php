<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "arquivo".
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
 * @property string|null $caminho
 * @property string|null $data_upload
 */
class Arquivo extends \yii\db\ActiveRecord {

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $file;
    public $printFile;

    public static function tableName() {
        return 'arquivo';
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = [
            'convite', 'actividade', 'organizacao', 'codigo', 'nome', 'autores', 'tema', 'descricao', 'classificacao', 'tipo',
            'estado','dataEstado', 'anoConcluido', 'numPagina', 'responsavelGestorUIC', 'usuarios', 'informacaoPlanilha',
            'monitoriatemarquivo', 'estaNoSiteFRESANLBC', 'linkFresanLbc','pastaRais','caminho','	print','arquivo', 'tipo_arquivo','tamanho_arquivo','data_upload', 'file', 'printFile'
        ];
        $scenarios[self::SCENARIO_UPDATE] = [
           'convite', 'actividade', 'organizacao', 'codigo', 'nome', 'autores', 'tema', 'descricao', 'classificacao', 'tipo',
            'estado','dataEstado', 'anoConcluido', 'numPagina', 'responsavelGestorUIC', 'usuarios', 'informacaoPlanilha',
            'monitoriatemarquivo', 'estaNoSiteFRESANLBC', 'linkFresanLbc','pastaRais','caminho','	print','arquivo', 'tipo_arquivo','tamanho_arquivo','data_upload',
        ];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['convite', 'organizacao', 'codigo', 'nome', 'autores', 'tema', 'descricao', 'classificacao', 'tipo', 'estado', 'anoConcluido', 'numPagina', 'responsavelGestorUIC', 'usuarios', 'informacaoPlanilha', 'monitoriatemarquivo', 'estaNoSiteFRESANLBC', 'linkFresanLbc'], 'required'],
            [['descricao', 'usuarios', 'pastaRais'], 'string'],
            [['dataEstado', 'data_upload'], 'safe'],
            [['anoConcluido', 'numPagina', 'monitoriatemarquivo', 'estaNoSiteFRESANLBC', 'tamanho_arquivo'], 'integer'],
            [['convite', 'actividade', 'codigo', 'classificacao', 'tipo', 'estado',], 'string', 'max' => 20],
            [['organizacao', 'responsavelGestorUIC', 'tipo_arquivo'], 'string', 'max' => 50],
            [['autores', 'arquivo'], 'string', 'max' => 256],
            [['nome', 'tema'], 'string', 'max' => 500],
            [['informacaoPlanilha'], 'string', 'max' => 40],
            [['file', 'printFile'], 'required', 'on' => self::SCENARIO_CREATE],
            [['file', 'printFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, doc, docx, xls, xlsx, mp4, jpg, png'],
            [['caminho'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
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
            'caminho' => Yii::t('app', 'Caminho do Arquivo'),
            'arquivo' => Yii::t('app', 'Arquivo'),
            'tipo_arquivo' => Yii::t('app', 'Tipo de Arquivo'),
            'tamanho_arquivo' => Yii::t('app', 'Tamanho do Arquivo'),
            'data_upload' => Yii::t('app', 'Data do Upload'),
            'file' => Yii::t('app', 'Documento Arquivo'),
            'print' => Yii::t('app', 'Capa do documento'),
            'printFile' => Yii::t('app', 'Capa do documento'),
        ];
    }

    public function uploadFiles() {
        $caminhoCompleto = Yii::getAlias('@webroot') . '/' . $this->caminho;
        if (!is_dir($caminhoCompleto)) {
            FileHelper::createDirectory($caminhoCompleto);
        }
        if (!(is_string($this->file)) && !empty($this->file) && $this->file != null) {
            $this->file->saveAs($caminhoCompleto . '/' . $this->file->baseName . '.' . $this->file->extension);
        }
        if (!(is_string($this->printFile)) && !empty($this->printFile) && $this->printFile != null) {
            $this->printFile->saveAs($caminhoCompleto . '/' . $this->printFile->baseName . '.' . $this->printFile->extension);
        }

        return true;
    }

//    public function upload() {
//        if ($this->validate()) {
//            // Defina o caminho padrão se nenhum caminho for especificado
//            $caminhoCompleto = \Yii::getAlias('@webroot') . '/' . $this->caminho;
//
//            // Cria o diretório se ele não existir
//            if (!is_dir($caminhoCompleto)) {
//                FileHelper::createDirectory($caminhoCompleto);
//            }
//
//            if ($this->file) {
//                $this->file->saveAs($caminhoCompleto . '/' . $this->file->baseName . '.' . $this->file->extension);
//                $this->arquivo = $this->file->baseName . '.' . $this->file->extension;
//            }
//
//            if ($this->printFile) {
//                $this->printFile->saveAs($caminhoCompleto . '/' . $this->printFile->baseName . '.' . $this->printFile->extension);
//                $this->print = $this->printFile->baseName . '.' . $this->printFile->extension;
//            }
//            return true;
//        } else {
//            return false;
//        }
//    }
}
