<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "provincia".
 *
 * @property int $Id
 * @property string|null $nomeProvincia
 *
 * @property Capacitacao[] $capacitacaos
 * @property Demostracoesculinarias[] $demostracoesculinarias
 * @property Doccomunicacao[] $doccomunicacaos
 * @property Eventos[] $eventos
 * @property Grupo[] $grupos
 * @property Materiais[] $materiais
 * @property Merendaescolar[] $merendaescolars
 * @property Municipio[] $municipios
 * @property Pacotepedagfresan[] $pacotepedagfresans
 * @property Profissionaissaude[] $profissionaissaudes
 * @property Rastreio[] $rastreios
 * @property Reforcoinstitucional[] $reforcoinstitucionals
 * @property Supervisao[] $supervisaos
 * @property Suplementacao[] $suplementacaos
 */
class Provincia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provincia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomeProvincia'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'nomeProvincia' => Yii::t('app', 'Nome da Provincia'),
        ];
    }

    /**
     * Gets query for [[Capacitacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCapacitacaos()
    {
        return $this->hasMany(Capacitacao::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Demostracoesculinarias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDemostracoesculinarias()
    {
        return $this->hasMany(Demostracoesculinarias::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Doccomunicacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoccomunicacaos()
    {
        return $this->hasMany(Doccomunicacao::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Eventos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Eventos::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Materiais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMateriais()
    {
        return $this->hasMany(Materiais::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Merendaescolars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMerendaescolars()
    {
        return $this->hasMany(Merendaescolar::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Municipios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasMany(Municipio::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Pacotepedagfresans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPacotepedagfresans()
    {
        return $this->hasMany(Pacotepedagfresan::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Profissionaissaudes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfissionaissaudes()
    {
        return $this->hasMany(Profissionaissaude::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Rastreios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRastreios()
    {
        return $this->hasMany(Rastreio::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Reforcoinstitucionals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReforcoinstitucionals()
    {
        return $this->hasMany(Reforcoinstitucional::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Supervisaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisaos()
    {
        return $this->hasMany(Supervisao::class, ['provinciaID' => 'Id']);
    }

    /**
     * Gets query for [[Suplementacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuplementacaos()
    {
        return $this->hasMany(Suplementacao::class, ['provinciaID' => 'Id']);
    }
}
