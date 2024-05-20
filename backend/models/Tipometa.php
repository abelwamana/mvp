<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipometa".
 *
 * @property int $Id
 * @property string $tipoMeta
 *
 * @property Meta[] $metas
 */
class Tipometa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipometa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipoMeta'], 'required'],
            [['tipoMeta'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'tipoMeta' => Yii::t('app', 'Tipo Meta'),
        ];
    }

    /**
     * Gets query for [[Metas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetas()
    {
        return $this->hasMany(Meta::class, ['tipoMetaID' => 'Id']);
    }
}
