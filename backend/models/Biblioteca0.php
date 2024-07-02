<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "biblioteca".
 *
 * @property int $id
 * @property string $titulo
 * @property string|null $descricao
 * @property string $nome_arquivo
 * @property string|null $tipo_arquivo
 * @property int|null $tamanho_arquivo
 * @property string|null $data_upload
 */
class Biblioteca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['titulo', 'nome_arquivo'], 'required'],
            [['descricao'], 'string'],
            [['tamanho_arquivo'], 'integer'],
            [['data_upload'], 'safe'],
            [['titulo', 'nome_arquivo'], 'string', 'max' => 255],
            [['tipo_arquivo'], 'string', 'max' => 50],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, doc, docx, xls, xlsx'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'titulo' => Yii::t('app', 'Titulo'),
            'descricao' => Yii::t('app', 'Descricão'),
            'nome_arquivo' => Yii::t('app', 'Nome Arquivo'),
            'tipo_arquivo' => Yii::t('app', 'Tipo Arquivo'),
            'tamanho_arquivo' => Yii::t('app', 'Tamanho Arquivo'),
            'data_upload' => Yii::t('app', 'Data Upload'),
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('biblioteca/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}
