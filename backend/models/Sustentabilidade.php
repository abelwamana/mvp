<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "recomendacoes".
 *
 * @property int $Id
 * @property string $estrategia
 * @property string $entidade
 * @property int $ano
 * @property string $fotografia
 * @property string $documento
 * @property int $ID_recomendacoes
 * @property int $ID_boas_praticas
 * @property int $ID_arquivo
 */
class Sustentabilidade extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $fotoFile;
    public $documentoFile;

    public static function tableName() {
        return 'sustentabilidade';
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = [
            'estrategia', 'entidade', 'ano', 'documento', 'ID_recomendacoes', 'ID_boas_praticas', 'ID_arquivo', 'fotoFile', 'documentoFile',
        ];
        $scenarios[self::SCENARIO_UPDATE] = [
            'estrategia', 'entidade', 'ano', 'documento', 'ID_recomendacoes', 'ID_boas_praticas', 'ID_arquivo',
        ];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['estrategia', 'entidade', 'ano', 'fotografia', 'documento'], 'required'],
            [['estrategia'], 'string'],
            [['ano', 'ID_recomendacoes', 'ID_boas_praticas', 'ID_arquivo'], 'integer'],
            [['entidade', 'fotografia', 'documento'], 'string', 'max' => 255],
            [['fotoFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, jpeg, png'],
            [['documentoFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, jpeg, png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'Id' => 'ID',
            'estrategia' => 'Estratégia',
            'entidade' => 'Entidade',
            'ano' => 'Ano',
            'fotografia' => 'Fotografia',
            'documento' => 'Documento',
            'ID_recomendacoes' => 'Recomendações',
            'ID_boas_praticas' => 'Boas Práticas',
            'ID_arquivo' => 'Arquivo',
        ];
    }

    public function upload() {

        if (!(is_string($this->fotoFile)) && !empty($this->fotoFile) && $this->fotoFile != null) {
            $this->fotoFile->saveAs('images/recomendacoes/' . $this->fotoFile->baseName . '.' . $this->fotoFile->extension);
        }
          if (!(is_string($this->documentoFile)) && !empty($this->documentoFile) && $this-documentoFile != null) {
                $this->documentoFile->saveAs('recomendacoes/' . $this->documentoFile->baseName . '.' . $this->documentoFile->extension);
        }
        return true;
    }
}
