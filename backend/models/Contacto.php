<?php

namespace backend\models;

use Yii;

class Contacto extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'contacto';
    }

    public function rules() {
        return [
            [['nome', 'funcao', 'instituicao', 'contacto', 'email', 'pais', 'provinciaID', 'municipioID','comunaID', 'localidade', 'pontofocal', 'actividades', 'entidade', 'nivel', 'rotulo', 'estado'], 'required'],
            [['provinciaID', 'municipioID', 'comunaID'], 'integer'],
            [['observacao'], 'string'],
            [['nome', 'funcao', 'instituicao', 'email', 'entidade','usuario'], 'string', 'max' => 50],
            [['pais', 'nivel', 'rotulo', 'estado'], 'string', 'max' => 20],
            [['contacto'], 'string', 'max' => 13],
            [['localidade'], 'string', 'max' => 100],
            [['pontofocal'], 'string', 'max' => 300],
            [['comunaID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::class, 'targetAttribute' => ['comunaID' => 'Id']],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
            [['provinciaID'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::class, 'targetAttribute' => ['provinciaID' => 'Id']],
            [['contacto'], 'match', 'pattern' => '/^\+\d{1,3}\d{8,12}$/', 'message' => 'O contacto deve estar no formato correto, incluindo o indicativo. Ex: +244929680377'],
        ];
    }

    public function attributeLabels() {
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
            'rotulo' => Yii::t('app', 'Rótulo'),
            'observacao' => Yii::t('app', 'Observacão'),
            'estado' => Yii::t('app', 'Estado'),
            'usuario' => Yii::t('app', 'Usuario'),
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
}
