<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contacto".
 *
 * @property int $Id
 * @property string $nome
 * @property string $funcao
 * @property string $instituicao
 * @property string $contacto
 * @property string $email
 * @property string $pais
 * @property int $provinciaID
 * @property int $municipioID
 * @property int|null $comunaID
 * @property string $localidade
 * @property string $pontofocal
 * @property string $actividades
 * @property string $entidade
 * @property string $nivel
 * @property string $rotulo
 * @property string $observacao
 * @property string $privacidade
 * @property string $estado
 *
 * @property Comuna $comuna
 * @property Municipio $municipio
 * @property Provincia $provincia
 */
class Contacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
     public $actividadesSelect;
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
            [['nome', 'funcao', 'instituicao', 'contacto', 'email', 'pais', 'provinciaID', 'municipioID', 'localidade', 'pontofocal', 'actividades', 'entidade', 'nivel', 'rotulo', 'observacao', 'privacidade', 'estado'], 'required'],
            [['provinciaID', 'municipioID', 'comunaID'], 'integer'],
            [['observacao'], 'string'],
            [['nome', 'funcao', 'instituicao', 'email', 'entidade', 'privacidade'], 'string', 'max' => 50],
            [['pais', 'actividades', 'nivel', 'rotulo', 'estado'], 'string', 'max' => 20],
            [['contacto'], 'string', 'max' => 13],
            [['localidade'], 'string', 'max' => 100],
            [['pontofocal'], 'string', 'max' => 300],
            [['comunaID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::class, 'targetAttribute' => ['comunaID' => 'Id']],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
            [['provinciaID'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::class, 'targetAttribute' => ['provinciaID' => 'Id']],
            [['contacto'], 'match', 'pattern' => '/^\+\d{1,3}\d{8,12}$/', 'message' => 'O contacto deve estar no formato correto, incluindo o indicativo. Ex: +244929680377'],
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
            'email' => Yii::t('app', 'E-mail'),
            'pais' => Yii::t('app', 'Pais'),
            'provinciaID' => Yii::t('app', 'Província'),
            'municipioID' => Yii::t('app', 'Município'),
            'comunaID' => Yii::t('app', 'Comuna'),
            'localidade' => Yii::t('app', 'Localidade'),
            'pontofocal' => Yii::t('app', 'Ponto focal'),
            'actividades' => Yii::t('app', 'Actividades'),
            'entidade' => Yii::t('app', 'Entidade'),
            'nivel' => Yii::t('app', 'Nível'),
            'rotulo' => Yii::t('app', 'Rotulo'),
            'observacao' => Yii::t('app', 'Observacão'),
            'privacidade' => Yii::t('app', 'Privacidade'),
            'estado' => Yii::t('app', 'Estado'),
            'actividadesSelect'=>Yii::t('app', 'Actividades'),
            
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
