<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "comuna".
 *
 * @property int $Id
 * @property string|null $nomeComuna
 * @property int $municipioID
 *
 * @property Capacitacao[] $capacitacaos
 * @property Demostracoesculinarias[] $demostracoesculinarias
 * @property Grupo[] $grupos
 * @property Localidade[] $localidades
 * @property Materiais[] $materiais
 * @property Merendaescolar[] $merendaescolars
 * @property Municipio $municipio
 * @property Pacotepedagfresan[] $pacotepedagfresans
 * @property Profissionaissaude[] $profissionaissaudes
 * @property Rastreio[] $rastreios
 * @property Reforcoinstitucional[] $reforcoinstitucionals
 * @property Supervisao[] $supervisaos
 * @property Suplementacao[] $suplementacaos
 */
class Comuna extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comuna';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['municipioID'], 'required'],
            [['municipioID'], 'integer'],
            [['nomeComuna'], 'string', 'max' => 100],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'nomeComuna' => Yii::t('app', 'Nome da Comuna'),
            'municipioID' => Yii::t('app', 'Município'),
        ];
    }

    /**
     * Gets query for [[Capacitacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCapacitacaos()
    {
        return $this->hasMany(Capacitacao::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Demostracoesculinarias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDemostracoesculinarias()
    {
        return $this->hasMany(Demostracoesculinarias::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Localidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidades()
    {
        return $this->hasMany(Localidade::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Materiais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMateriais()
    {
        return $this->hasMany(Materiais::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Merendaescolars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMerendaescolars()
    {
        return $this->hasMany(Merendaescolar::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Municipio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::class, ['Id' => 'municipioID']);
    }

    /**
     * Gets query for [[Pacotepedagfresans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPacotepedagfresans()
    {
        return $this->hasMany(Pacotepedagfresan::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Profissionaissaudes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfissionaissaudes()
    {
        return $this->hasMany(Profissionaissaude::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Rastreios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRastreios()
    {
        return $this->hasMany(Rastreio::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Reforcoinstitucionals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReforcoinstitucionals()
    {
        return $this->hasMany(Reforcoinstitucional::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Supervisaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisaos()
    {
        return $this->hasMany(Supervisao::class, ['comunaID' => 'Id']);
    }

    /**
     * Gets query for [[Suplementacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuplementacaos()
    {
        return $this->hasMany(Suplementacao::class, ['comunaID' => 'Id']);
    }
}
