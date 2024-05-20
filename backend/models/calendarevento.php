<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "calendarevento".
 *
 * @property int $Id
 * @property string|null $summary
 * @property string $description
 * @property string $start
 * @property string $end
 * @property string $localizacao
 * @property string $entidadeOrganizadora
 * @property string $participantes
 */
class calendarevento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calendarevento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'start', 'end', 'localizacao', 'entidadeOrganizadora', 'participantes'], 'required'],
            [['description', 'localizacao', 'participantes'], 'string'],
            [['start', 'end'], 'safe'],
            [['summary', 'entidadeOrganizadora'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'summary' => Yii::t('app', 'Titulo'),
            'description' => Yii::t('app', 'Description'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'localizacao' => Yii::t('app', 'Localizacao'),
            'entidadeOrganizadora' => Yii::t('app', 'Entidade Organizadora'),
            'participantes' => Yii::t('app', 'Participantes'),
        ];
    }
}
