<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Biblioteca;

/**
 * BibliotecaSearch represents the model behind the search form of `backend\models\Biblioteca`.
 */
class BibliotecaSearch extends Biblioteca
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tamanho_arquivo'], 'integer'],
            [['titulo', 'descricao', 'nome_arquivo', 'tipo_arquivo', 'data_upload'], 'safe'],
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
        $query = Biblioteca::find();

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
            'id' => $this->id,
            'tamanho_arquivo' => $this->tamanho_arquivo,
            'data_upload' => $this->data_upload,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'nome_arquivo', $this->nome_arquivo])
            ->andFilterWhere(['like', 'tipo_arquivo', $this->tipo_arquivo]);

        return $dataProvider;
    }
}
