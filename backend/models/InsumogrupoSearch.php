<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Insumogrupo;

/**
 * InsumogrupoSearch represents the model behind the search form of `backend\models\Insumogrupo`.
 */
class InsumogrupoSearch extends Insumogrupo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'grupoID', 'culturasID', 'campanhaPrevisaoAbobora', 'cultDistr', 'culturaColheita', 'unidadeID', 'quantasVingaram'], 'integer'],
            [['trimestreCulturaDistr', 'trimestreCultColheita', 'destinoCultColheita', 'culturaBiofortificada'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
 $user = \Yii::$app->user->identity;
        $userEntidade = $user->entidade;
        $isAdmin = \Yii::$app->user->isGuest ? false : \Yii::$app->user->can("Permissão de Administrador");
        if ($isAdmin) {
            // O usuário é um administrador, portanto, eles podem visualizar todos os dados
            $query = Insumogrupo::find();
        } else {
            // O usuário não é um administrador, eles só podem ver dados de sua própria entidade
            $query = Insumogrupo::find()->where(['entidade' => $userEntidade]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'grupoID' => $this->grupoID,
            'culturasID' => $this->culturasID,
            'campanhaPrevisaoAbobora' => $this->campanhaPrevisaoAbobora,
            'cultDistr' => $this->cultDistr,
            'trimestreCulturaDistr' => $this->trimestreCulturaDistr,
            'culturaColheita' => $this->culturaColheita,
            'trimestreCultColheita' => $this->trimestreCultColheita,
            'unidadeID' => $this->unidadeID,
            'quantasVingaram' => $this->quantasVingaram,
        ]);

        $query->andFilterWhere(['like', 'destinoCultColheita', $this->destinoCultColheita])
            ->andFilterWhere(['like', 'culturaBiofortificada', $this->culturaBiofortificada]);

        return $dataProvider;
    }
}
