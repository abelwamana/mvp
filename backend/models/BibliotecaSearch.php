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
            [['id', 'anoConcluido', 'numPagina', 'monitoriatemarquivo', 'estaNoSiteFRESANLBC', 'tamanho_arquivo'], 'integer'],
            [['convite', 'actividade', 'organizacao', 'codigo', 'nome', 'autores', 'tema', 'descricao', 'classificacao', 'tipo', 'estado', 'dataEstado', 'responsavelGestorUIC', 'usuarios', 'informacaoPlanilha', 'linkFresanLbc','arquivo', 'tipo_arquivo', 'data_upload'], 'safe'],
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
            'dataEstado' => $this->dataEstado,
            'anoConcluido' => $this->anoConcluido,
            'numPagina' => $this->numPagina,
            'monitoriatemarquivo' => $this->monitoriatemarquivo,
            'estaNoSiteFRESANLBC' => $this->estaNoSiteFRESANLBC,
            'tamanho_arquivo' => $this->tamanho_arquivo,
            'data_upload' => $this->data_upload,
        ]);

        $query->andFilterWhere(['like', 'convite', $this->convite])
            ->andFilterWhere(['like', 'actividade', $this->actividade])
            ->andFilterWhere(['like', 'organizacao', $this->organizacao])
            ->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'autores', $this->autores])
            ->andFilterWhere(['like', 'tema', $this->tema])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'classificacao', $this->classificacao])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'responsavelGestorUIC', $this->responsavelGestorUIC])
            ->andFilterWhere(['like', 'usuarios', $this->usuarios])
            ->andFilterWhere(['like', 'informacaoPlanilha', $this->informacaoPlanilha])
            ->andFilterWhere(['like', 'linkFresanLbc', $this->linkFresanLbc])
            ->andFilterWhere(['like', 'tipo_arquivo', $this->tipo_arquivo]);

        return $dataProvider;
    }
}
