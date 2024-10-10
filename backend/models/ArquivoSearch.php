<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Arquivo;
use yii\helpers\ArrayHelper;

/**
 * ArquivoSearch represents the model behind the search form of `backend\models\Arquivo`.
 */
class ArquivoSearch extends Arquivo {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['Id', 'entidade', 'provinciaID', 'municipioID', 'area', 'tipo', 'ano', 'tamanho_arquivo'], 'integer'],
            [['referencia', 'biblioteca', 'meio_de_verificacao', 'arquivo', 'descricao', 'caminho', 'foto_da_capa', 'tipo_arquivo', 'data_upload'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Arquivo::find();

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
            'entidade' => $this->entidade,
            'provinciaID' => $this->provinciaID,
            'municipioID' => $this->municipioID,
            'area' => $this->area,
            'tipo' => $this->tipo,
            'ano' => $this->ano,
            'tamanho_arquivo' => $this->tamanho_arquivo,
            'data_upload' => $this->data_upload,
        ]);

        $query->andFilterWhere(['like', 'referencia', $this->referencia])
                ->andFilterWhere(['like', 'biblioteca', $this->biblioteca])
                ->andFilterWhere(['like', 'meio_de_verificacao', $this->meio_de_verificacao])
                ->andFilterWhere(['like', 'arquivo', $this->arquivo])
                ->andFilterWhere(['like', 'descricao', $this->descricao])
                ->andFilterWhere(['like', 'caminho', $this->caminho])
                ->andFilterWhere(['like', 'foto_da_capa', $this->foto_da_capa])
                ->andFilterWhere(['like', 'tipo_arquivo', $this->tipo_arquivo]);

        return $dataProvider;
    }

    public function getTipoOptions() {
        $tipos = Arquivo::find()
                ->select('tipo')
                ->distinct()
                ->orderBy('tipo')
                ->asArray()
                ->all();

        return ArrayHelper::map($tipos, 'tipo', 'tipo');
    }

    public function getOrganizacaoOptions() {
        $organizacoes = Arquivo::find()
                ->select('entidade')
                ->distinct()
                ->orderBy('entidade')
                ->asArray()
                ->all();

        return ArrayHelper::map($organizacoes, 'entidade', 'entidade');
    }

    public function getAnoOptions() {
        $anos = Arquivo::find()
                ->select('ano')
                ->distinct()
                ->orderBy('ano')
                ->asArray()
                ->all();

        return ArrayHelper::map($anos, 'anoConcluido', 'anoConcluido');
    }
}
