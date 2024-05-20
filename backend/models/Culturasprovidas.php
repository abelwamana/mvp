<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "culturasprovidas".
 *
 * @property int $Id
 * @property string|null $culturaPrevisao
 */
class Culturasprovidas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'culturasprovidas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['culturaPrevisao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'culturaPrevisao' => Yii::t('app', 'Cultura Previsão'),
        ];
    }
}
