<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "selecao".
 *
 * @property int $Id
 * @property string|null $endidade
 * @property string|null $area
 * @property string|null $provincia
 */
class Selecao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'selecao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['endidade', 'area', 'provincia'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
           // 'Id' => Yii::t('app', 'ID'),
            'endidade' => Yii::t('app', 'Endidade'),
            'area' => Yii::t('app', 'Area'),
            'provincia' => Yii::t('app', 'Provincia'),
        ];
    }
}
