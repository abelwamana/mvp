<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fitofarmacosferramentas".
 *
 * @property int $Id
 * @property int $grupoID
 * @property string|null $nome
 * @property int $previsaoCampanha
 * @property int|null $distribuido
 * @property int $unidadeID
 *
 * @property Grupo $grupo
 */
class Fitofarmacosferramentas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fitofarmacosferramentas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['grupoID', 'unidadeID'], 'required'],
            [['grupoID', 'distribuido', 'unidadeID'], 'integer'],
            [['nome'], 'string', 'max' => 100],
            [['grupoID'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::class, 'targetAttribute' => ['grupoID' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'grupoID' => Yii::t('app', 'Grupo'),
            'nome' => Yii::t('app', 'Nome'),
            'previsaoCampanha' => Yii::t('app', 'Previsão Campanha'),
            'distribuido' => Yii::t('app', 'Distribuído'),
            'unidadeID' => Yii::t('app', 'Unidade'),
        ];
    }

    /**
     * Gets query for [[Grupo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(Grupo::class, ['Id' => 'grupoID']);
    }
}
