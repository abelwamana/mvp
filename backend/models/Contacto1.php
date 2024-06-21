<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contacto".
 *
 * @property int $Id
 * @property string $nome
 * @property int $funcaoID
 * @property string $instituicao
 * @property string $contacto
 * @property string $email
 * @property string $pais
 * @property int $provinciaID
 * @property int $municipioID
 * @property int $comunaID
 * @property string $localidade
 * @property int $pontofocal
 * @property string $actividades
 * @property string $entidade
 * @property string $nivel
 * @property string $rotulo
 * @property string $privacidade
 * @property string $estado
 *
 * @property Comuna $comuna
 * @property Funcao $funcao
 * @property Municipio $municipio
 * @property Provincia $provincia
 */
class Contacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'funcao', 'instituicao', 'contacto', 'email', 'pais', 'provinciaID', 'municipioID', 'comunaID', 'localidade', 'pontofocal', 'actividades', 'entidade', 'nivel', 'rotulo', 'privacidade', 'estado'], 'required'],
            [['provinciaID', 'municipioID', 'comunaID'], 'integer'],
            [['nome', 'instituicao', 'email','funcao', 'pontofocal', 'privacidade'], 'string', 'max' => 50],
            [['contacto'], 'string', 'max' => 11],
            [['pais', 'actividades', 'entidade', 'nivel', 'rotulo', 'estado'], 'string', 'max' => 20],
            [['localidade'], 'string', 'max' => 100],
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
            'nome' => Yii::t('app', 'Nome'),
            'funcao' => Yii::t('app', 'Função'),
            'instituicao' => Yii::t('app', 'Instituição'),
            'contacto' => Yii::t('app', 'Contacto'),
            'email' => Yii::t('app', 'E-Mail'),
            'pais' => Yii::t('app', 'País'),
            'provinciaID' => Yii::t('app', 'Província'),
            'municipioID' => Yii::t('app', 'Município'),
            'comunaID' => Yii::t('app', 'Comuna'),
            'localidade' => Yii::t('app', 'Localidade'),
            'pontofocal' => Yii::t('app', 'Pontofocal'),
            'actividades' => Yii::t('app', 'Actividades'),
            'entidade' => Yii::t('app', 'Entidade'),
            'nivel' => Yii::t('app', 'Nível'),
            'rotulo' => Yii::t('app', 'Rótulo'),
            'privacidade' => Yii::t('app', 'Privacidade'),
            'estado' => Yii::t('app', 'Estado'),
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
     * Gets query for [[Funcao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFuncao()
    {
        return $this->hasOne(Funcao::class, ['Id' => 'funcaoID']);
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
