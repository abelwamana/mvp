<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "municipio".
 *
 * @property int $Id
 * @property string|null $nomeMunicipio
 * @property int $provinciaID
 *
 * @property Capacitacao[] $capacitacaos
 * @property Comuna[] $comunas
 * @property Demostracoesculinarias[] $demostracoesculinarias
 * @property Doccomunicacao[] $doccomunicacaos
 * @property Eventos[] $eventos
 * @property Grupo[] $grupos
 * @property Materiais[] $materiais
 * @property Merendaescolar[] $merendaescolars
 * @property Pacotepedagfresan[] $pacotepedagfresans
 * @property Profissionaissaude[] $profissionaissaudes
 * @property Provincia $provincia
 * @property Rastreio[] $rastreios
 * @property Reforcoinstitucional[] $reforcoinstitucionals
 * @property Supervisao[] $supervisaos
 * @property Suplementacao[] $suplementacaos
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'municipio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provinciaID'], 'required'],
            [['provinciaID'], 'integer'],
            [['nomeMunicipio'], 'string', 'max' => 100],
            [['provinciaID'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::class, 'targetAttribute' => ['provinciaID' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'nomeMunicipio' => Yii::t('app', 'Nome do Município'),
            'provinciaID' => Yii::t('app', 'Província'),
        ];
    }

    /**
     * Gets query for [[Capacitacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCapacitacaos()
    {
        return $this->hasMany(Capacitacao::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Comunas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComunas()
    {
        return $this->hasMany(Comuna::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Demostracoesculinarias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDemostracoesculinarias()
    {
        return $this->hasMany(Demostracoesculinarias::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Doccomunicacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoccomunicacaos()
    {
        return $this->hasMany(Doccomunicacao::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Eventos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Eventos::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Materiais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMateriais()
    {
        return $this->hasMany(Materiais::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Merendaescolars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMerendaescolars()
    {
        return $this->hasMany(Merendaescolar::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Pacotepedagfresans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPacotepedagfresans()
    {
        return $this->hasMany(Pacotepedagfresan::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Profissionaissaudes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfissionaissaudes()
    {
        return $this->hasMany(Profissionaissaude::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::class, ['Id' => 'provinciaID']);
    }

    /**
     * Gets query for [[Rastreios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRastreios()
    {
        return $this->hasMany(Rastreio::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Reforcoinstitucionals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReforcoinstitucionals()
    {
        return $this->hasMany(Reforcoinstitucional::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Supervisaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisaos()
    {
        return $this->hasMany(Supervisao::class, ['municipioID' => 'Id']);
    }

    /**
     * Gets query for [[Suplementacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuplementacaos()
    {
        return $this->hasMany(Suplementacao::class, ['municipioID' => 'Id']);
    }
}
