<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "funcao".
 *
 * @property int $Id
 * @property string $funcao
 *
 * @property Contacto[] $contactos
 */
class Funcao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'funcao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['funcao'], 'required'],
            [['funcao'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'funcao' => Yii::t('app', 'Funcao'),
        ];
    }

    /**
     * Gets query for [[Contactos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContactos()
    {
        return $this->hasMany(Contacto::class, ['funcaoID' => 'Id']);
    }
}
