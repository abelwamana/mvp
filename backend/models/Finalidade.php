<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "finalidade".
 *
 * @property int $Id
 * @property string|null $finalidade
 *
 * @property Grupo[] $grupos
 * @property Grupo[] $grupos0
 * @property Grupo[] $grupos1
 * @property Grupo[] $grupos2
 */
class Finalidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finalidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['finalidade'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'finalidade' => Yii::t('app', 'Finalidade'),
        ];
    }

    /**
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::class, ['terceiraFinalidadeID3' => 'Id']);
    }

    /**
     * Gets query for [[Grupos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos0()
    {
        return $this->hasMany(Grupo::class, ['primeiraFinalidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Grupos1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos1()
    {
        return $this->hasMany(Grupo::class, ['primeiraFinalidadeID' => 'Id']);
    }

    /**
     * Gets query for [[Grupos2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos2()
    {
        return $this->hasMany(Grupo::class, ['segundaFinalidadeID' => 'Id']);
    }
     public function getAcoesBotoes() {
        $user = Yii::$app->user;
        $acoes = [];

        if ($user->can('Permissao Validador de dados') or \Yii::$app->user->can('Permissão de Administrador')) {
            $acoes[] = ['label' => '', 'url' => ['validar', 'id' => $this->Id], 'class' => 'btn btn-success fas fa-check-square '];
        }

        if ($user->can('Perfil Aprovação de dados')or \Yii::$app->user->can('Permissão de Administrador')) {
            $acoes[] = ['label' => '', 'url' => ['aprovar', 'id' => $this->Id], 'class' => 'btn btn-primary fas fa-thumbs-up'];
        }

        if ($user->can('Perfil Lancamento')or \Yii::$app->user->can('Permissão de Administrador')) {
            $acoes[] = ['label' => '', 'url' => ['publicar', 'id' => $this->Id], 'class' => 'btn btn-primary fa fa-globe'];
        }

        return $acoes;
    }
}
