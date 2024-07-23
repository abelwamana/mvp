<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notificacoes".
 *
 * @property int $Id
 * @property string $mensagem
 * @property int $estado
 * @property int $id_usuario
 * @property int $id_event
 */
class Notificacoes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notificacoes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mensagem', 'estado', 'id_usuario'], 'required'],
            [['mensagem'], 'string'],
            [['estado', 'id_usuario'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'mensagem' => 'Mensagem',
            'estado' => 'Estado',
            'id_usuario' => 'Id Usuario',
            'id_event' => 'Id do Evento',
        ];
    }
}
