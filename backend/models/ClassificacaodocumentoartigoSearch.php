<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Classificacaodocumentoartigo;

/**
 * ClassificacaodocumentoartigoSearch represents the model behind the search form of `backend\models\Classificacaodocumentoartigo`.
 */
class ClassificacaodocumentoartigoSearch extends Classificacaodocumentoartigo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id'], 'integer'],
            [['NomeClassficacao'], 'safe'],
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
            $query = Classificacaodocumentoartigo::find();
        } else {
            // O usuário não é um administrador, eles só podem ver dados de sua própria entidade
            $query = Classificacaodocumentoartigo::find()->where(['entidade' => $userEntidade]);
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
        ]);

        $query->andFilterWhere(['like', 'NomeClassficacao', $this->NomeClassficacao]);

        return $dataProvider;
    }
}
