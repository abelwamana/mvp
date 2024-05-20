<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "insumogrupo".
 *
 * @property int $Id
 * @property int $grupoID
 * @property int $culturasID
 * @property int $campanhaPrevisaoAbobora
 * @property int|null $cultDistr
 * @property string|null $trimestreCulturaDistr
 * @property int|null $culturaColheita
 * @property string|null $trimestreCultColheita
 * @property string $destinoCultColheita
 * @property string|null $culturaBiofortificada
 * @property int $unidadeID
 * @property int|null $quantasVingaram
 */
class Insumogrupo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'insumogrupo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['grupoID', 'culturasID', 'campanhaPrevisaoAbobora', 'destinoCultColheita', 'unidadeID'], 'required'],
            [['grupoID', 'culturasID', 'campanhaPrevisaoAbobora', 'cultDistr', 'culturaColheita', 'unidadeID', 'quantasVingaram'], 'integer'],
            [['trimestreCulturaDistr', 'trimestreCultColheita'], 'safe'],
            [['destinoCultColheita'], 'string', 'max' => 50],
            [['culturaBiofortificada'], 'string', 'max' => 3],
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
            'culturasID' => Yii::t('app', 'Culturas'),
            'campanhaPrevisaoAbobora' => Yii::t('app', 'Campanha Previsão Abobora'),
            'cultDistr' => Yii::t('app', 'Cult. Distr.'),
            'trimestreCulturaDistr' => Yii::t('app', 'Trimestre Cultura Distr.'),
            'culturaColheita' => Yii::t('app', 'Cultura Colheita'),
            'trimestreCultColheita' => Yii::t('app', 'Trimestre Cult. Colheita'),
            'destinoCultColheita' => Yii::t('app', 'Destino Cult. Colheita'),
            'culturaBiofortificada' => Yii::t('app', 'Cultura Biofortificada'),
            'unidadeID' => Yii::t('app', 'Unidade'),
            'quantasVingaram' => Yii::t('app', 'Quantas Vingaram'),
        ];
    }
    // InsumoGrupo.php e FitofarmacosFerramentas.php
public function getGrupo()
{
    return $this->hasOne(Grupo::class, ['Id' => 'grupoID']);
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
