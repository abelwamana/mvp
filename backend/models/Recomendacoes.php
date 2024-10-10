<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "recomendacoes".
 *
 * @property int $Id
 * @property string $recomendacao
 * @property string $entidade
 * @property string $contexto
 * @property string $problema_a_resolver
 * @property string $justificacao
 * @property int|null $ID_Boas_Praticas
 * @property int|null $ID_arquivo
 */
class Recomendacoes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    public $fotoFile;
    public static function tableName()
    {
        return 'recomendacoes';
    }
    
      public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = [
           'recomendacao', 'area', 'contexto', 'data', 'justificacao', 'ID_Boas_Praticas', 'ID_arquivo', 'fotoFile',
        ];
        $scenarios[self::SCENARIO_UPDATE] = [
           'recomendacao','area', 'contexto', 'data', 'justificacao', 'ID_Boas_Praticas','ID_arquivo',
            ];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recomendacao', 'contexto', 'data', 'justificacao'], 'required'],
             [['data'], 'safe'],
            [['problema_a_resolver', 'justificacao'], 'string'],
            [['ID_Boas_Praticas', 'ID_arquivo'], 'integer'],
            [['recomendacao', 'entidade', 'contexto'], 'string', 'max' => 255],
            [['fotoFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, jpeg, png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'recomendacao' => 'Recomendação',
             'area' => 'Área',
            'contexto' => 'Fonte',
            'data' => 'Data',
            'justificacao' => 'Justificação',
            'fotografia' => Yii::t('app', 'Fotografia'),
            'fotoFile' => Yii::t('app', 'Fotografia'),
            'ID_Boas_Praticas' => 'Boas Práticas',
            'ID_arquivo' => 'Arquivo',
        ];
    }
     public function upload()
    {        
             if (!(is_string($this->fotoFile)) && !empty($this->fotoFile) && $this->fotoFile != null) {
                $this->fotoFile->saveAs('recomendacoes/' . $this->fotoFile->baseName . '.' . $this->fotoFile->extension);
        }
         return true;
    }
}
