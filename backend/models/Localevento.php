<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "localevento".
 *
 * @property int $Id
 * @property int $provinciaID
 * @property int $municipioID
 * @property int $comunaID
 * @property string $local
 * @property string|null $coordenadas
 *
 * @property Comuna $comuna
 * @property Event[] $events
 * @property Municipio $municipio
 * @property Provincia $provincia
 */
class Localevento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localevento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provinciaID', 'municipioID', 'comunaID', 'local'], 'required'],
            [['provinciaID', 'municipioID', 'comunaID'], 'integer'],
            [['local', 'coordenadas'], 'string', 'max' => 100],
            [['comunaID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::class, 'targetAttribute' => ['comunaID' => 'Id']],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
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
            'provinciaID' => Yii::t('app', 'Provincia'),
            'municipioID' => Yii::t('app', 'Municipio'),
            'comunaID' => Yii::t('app', 'Comuna'),
            'local' => Yii::t('app', 'Local'),
            'coordenadas' => Yii::t('app', 'Coordenadas'),
        ];
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
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::class, ['localizacaoID' => 'Id']);
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
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::class, ['Id' => 'provinciaID']);
    }
}
