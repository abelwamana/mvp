<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Biblioteca extends ActiveRecord
{
    public $file;
    public static function tableName()
    {
        return 'biblioteca';
    }

    public function rules()
    {
        return [
            [['titulo', 'file'], 'required'],
            [['descricao'], 'string'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, doc, docx, xls, xlsx'],
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
