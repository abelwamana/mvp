<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "localidade".
 *
 * @property int $Id
 * @property string|null $nomeLocalidade
 * @property int $comunaID
 *
 * @property Capacitacao[] $capacitacaos
 * @property Comuna $comuna
 * @property Demostracoesculinarias[] $demostracoesculinarias
 * @property Grupo[] $grupos
 * @property Materiais[] $materiais
 * @property Merendaescolar[] $merendaescolars
 * @property Pacotepedagfresan[] $pacotepedagfresans
 * @property Profissionaissaude[] $profissionaissaudes
 * @property Rastreio[] $rastreios
 * @property Reforcoinstitucional[] $reforcoinstitucionals
 * @property Supervisao[] $supervisaos
 * @property Suplementacao[] $suplementacaos
 */
class Localidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comunaID'], 'required'],
            [['comunaID'], 'integer'],
            [['nomeLocalidade'], 'string', 'max' => 100],
            [['comunaID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::class, 'targetAttribute' => ['comunaID' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'nomeLocalidade' => Yii::t('app', 'Nome da Localidade'),
            'comunaID' => Yii::t('app', 'Comuna'),
        ];
    }

    /**
     * Gets query for [[Capacitacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCapacitacaos()
    {
        return $this->hasMany(Capacitacao::class, ['localidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Comuna]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComuna()
    {
        return $this->hasOne(Comuna::class, ['Id' => 'comunaID']);
    }

    /**
     * Gets query for [[Demostracoesculinarias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDemostracoesculinarias()
    {
        return $this->hasMany(Demostracoesculinarias::class, ['localidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::class, ['localidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Materiais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMateriais()
    {
        return $this->hasMany(Materiais::class, ['localidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Merendaescolars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMerendaescolars()
    {
        return $this->hasMany(Merendaescolar::class, ['localidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Pacotepedagfresans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPacotepedagfresans()
    {
        return $this->hasMany(Pacotepedagfresan::class, ['localidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Profissionaissaudes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfissionaissaudes()
    {
        return $this->hasMany(Profissionaissaude::class, ['localidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Rastreios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRastreios()
    {
        return $this->hasMany(Rastreio::class, ['localidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Reforcoinstitucionals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReforcoinstitucionals()
    {
        return $this->hasMany(Reforcoinstitucional::class, ['localidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Supervisaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisaos()
    {
        return $this->hasMany(Supervisao::class, ['localidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Suplementacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuplementacaos()
    {
        return $this->hasMany(Suplementacao::class, ['localidadeID' => 'Id']);
    }
}
