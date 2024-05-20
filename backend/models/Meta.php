<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "meta".
 *
 * @property int $Id
 * @property string $nomeMeta
 * @property int $tipoMetaID
 * @property int $valorMeta
 *
 * @property Tipometa $tipoMeta
 */
class Meta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomeMeta', 'tipoMetaID', 'valorMeta'], 'required'],
            [['tipoMetaID', 'valorMeta'], 'integer'],
            [['nomeMeta'], 'string', 'max' => 255],
            [['tipoMetaID'], 'exist', 'skipOnError' => true, 'targetClass' => Tipometa::class, 'targetAttribute' => ['tipoMetaID' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'nomeMeta' => Yii::t('app', 'Nome Meta'),
            'tipoMetaID' => Yii::t('app', 'Tipo Meta ID'),
            'valorMeta' => Yii::t('app', 'Valor Meta'),
        ];
    }

    /**
     * Gets query for [[TipoMeta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMeta()
    {
        return $this->hasOne(Tipometa::class, ['Id' => 'tipoMetaID']);
    }
}
