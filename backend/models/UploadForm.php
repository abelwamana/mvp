<?php

/** @var Created by: Abel Eusébio Alberto Wamana */
/** @varE - mail  : abelwamana@gmail.com*/
/** @var Tel: +244 927 487 045*/
/** @var Eu Creio! Eu Creio! Eu Creio em Jesús Cristo meu Senhor e Rei */

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}

