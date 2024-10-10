<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "arquivo".
 *
 * @property int $Id
 * @property string $referencia
 * @property int $entidade
 * @property int $provinciaID
 * @property int|null $municipioID
 * @property string $biblioteca
 * @property string $meio_de_verificacao
 * @property string|null $arquivo
 * @property int $area
 * @property string $descricao
 * @property int $tipo
 * @property int $ano
 * @property string|null $caminho
 * @property string|null $foto_da_capa
 * @property string|null $tipo_arquivo
 * @property int|null $tamanho_arquivo
 * @property string|null $data_upload
 */
class Arquivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $file;
    public $printFile;
    public static function tableName()
    {
        return 'arquivo';
    }
     public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = [
             'referencia','entidade','provinciaID','municipioID','biblioteca','meio_de_verificacao','arquivo','area','descricao',
            'tipo','ano', 'caminho','foto_da_capa', 'extencao','tamanho_arquivo','data_upload', 'file', 'printFile'
        ];
        $scenarios[self::SCENARIO_UPDATE] = [
           'referencia','entidade','provinciaID','municipioID','biblioteca','meio_de_verificacao','arquivo','area','descricao',
            'tipo','ano', 'caminho','foto_da_capa', 'extencao','tamanho_arquivo','data_upload'
        ];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['referencia', 'entidade', 'provinciaID', 'biblioteca', 'meio_de_verificacao', 'area', 'descricao', 'tipo', 'ano'], 'required'],
            [['entidade', 'provinciaID', 'municipioID', 'area', 'tipo', 'ano', 'tamanho_arquivo'], 'integer'],
            [['biblioteca', 'meio_de_verificacao', 'descricao'], 'string'],
            [['data_upload'], 'safe'],
            [['referencia'], 'string', 'max' => 20],
            [['arquivo'], 'string', 'max' => 256],
            [['caminho'], 'string', 'max' => 1000],
            [['foto_da_capa'], 'string', 'max' => 255],
            [['tipo_arquivo'], 'string', 'max' => 50],
             [['file', 'printFile'], 'required', 'on' => self::SCENARIO_CREATE],
            [['file',], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, doc, docx, xls, xlsx, mp4'],
            [['printFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,jpeg, JPEG, png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'referencia' => 'Referência',
            'entidade' => 'Entidade',
            'provinciaID' => 'Província',
            'municipioID' => 'Município',
            'biblioteca' => 'Biblioteca',
            'meio_de_verificacao' => 'Meio De Verificação',
            'arquivo' => 'Arquivo',
            'area' => 'Area',
            'descricao' => 'Descrição',
            'tipo' => 'Tipo',
            'ano' => 'Ano',
            'caminho' => 'Caminho',
            'foto_da_capa' => 'Foto Da Capa',
            'extencao' => 'Tipo Arquivo',
            'tamanho_arquivo' => 'Tamanho Arquivo',
            'data_upload' => 'Data Upload',
        ];
    }
}
