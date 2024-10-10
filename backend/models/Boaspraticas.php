<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "boaspraticas".
 *
 * @property int $Id
 * @property string $boapratica
 * @property string $justificacao
 * @property string $area
 * @property int $provinciaID
 * @property int $municipioID
 * @property int $comunaID
 * @property string $localidade
 * @property string $latitude
 * @property string $longitude
 * @property string $entidadepropoente
 * @property string $entidadeimplementadora
 * @property string $fotografia
 * @property int|null $recomendacoesID
 * @property int $estrategia_de_sustentabilidadeID
 * @property int $arquivoID
 */
class Boaspraticas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    public $fotoFile;
    public static function tableName()
    {
        return 'boaspraticas';
    }
     public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = [
           'boapratica', 'justificacao', 'area', 'provinciaID', 'municipioID', 'comunaID', 'localidade', 'latitude', 'longitude', 'entidadepropoente', 'entidadeimplementadora',  'fotoFile',
            'recomendacoesID','estrategia_de_sustentabilidadeID','arquivoID',
        ];
        $scenarios[self::SCENARIO_UPDATE] = [
          'boapratica', 'justificacao', 'area', 'provinciaID', 'municipioID', 'comunaID', 'localidade', 'latitude', 'longitude', 'entidadepropoente', 'entidadeimplementadora',
            'recomendacoesID','estrategia_de_sustentabilidadeID','arquivoID',
            ];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['boapratica', 'justificacao', 'area', 'provinciaID','entidadepropoente', 'entidadeimplementadora'], 'required'],
            [['justificacao'], 'string'],
            [['provinciaID', 'municipioID', 'comunaID', 'recomendacoesID', 'estrategia_de_sustentabilidadeID', 'arquivoID', 'aprovado'], 'integer'],
            [['boapratica', 'localidade', 'latitude', 'longitude', 'entidadepropoente', 'entidadeimplementadora', 'fotografia'], 'string', 'max' => 255],
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
            'boapratica' => 'Boa prática',
            'justificacao' => 'Justificação',
            'area' => 'Área',
            'provinciaID' => 'Província',
            'municipioID' => 'Município',
            'comunaID' => 'Comuna',
            'localidade' => 'Localidade',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'entidadepropoente' => 'Entidade Propoente',
            'entidadeimplementadora' => 'Entidade Implementadora',
            'fotografia' => 'Fotografia',
            'recomendacoesID' => 'Recomendações',
            'estrategia_de_sustentabilidadeID' => 'Estratégia De Sustentabilidade',
            'arquivoID' => 'Arquivo',
             'aprovado' => 'Aprovado',
            'fotoFile' => Yii::t('app', 'Fotografia'),
        ];
    }
     public function getComuna() {
        return $this->hasOne(Comuna::class, ['Id' => 'comunaID']);
    }

    public function getMunicipio() {
        return $this->hasOne(Municipio::class, ['Id' => 'municipioID']);
    }

    public function getProvincia() {
        return $this->hasOne(Provincia::class, ['Id' => 'provinciaID']);
    }
     public function upload()
    {
        
             if (!(is_string($this->fotoFile)) && !empty($this->fotoFile) && $this->fotoFile != null) {
                $this->fotoFile->saveAs('images/boaspraticas/' . $this->fotoFile->baseName . '.' . $this->fotoFile->extension);
        }
         return true;
    }
}
