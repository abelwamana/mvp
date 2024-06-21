<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Contacto;
use Yii;

class ContactoSearch extends Contacto {
    public $provinciaNome;
    public $municipioNome;
    public $comunaNome;
    public $pais;

    public function rules() {
        return [
            [['provinciaNome', 'municipioNome', 'comunaNome'], 'safe'],
            [['Id', 'provinciaID', 'municipioID', 'comunaID'], 'integer'],
            [['nome', 'funcao', 'instituicao', 'contacto', 'email', 'pais', 'localidade', 'pontofocal', 'actividades', 'entidade', 'nivel', 'rotulo', 'observacao', 'privacidade', 'estado', 'usuario'], 'safe'],
        ];
    }

    public function scenarios() {
        return Model::scenarios();
    }

    public function search($params) {
        $query = Contacto::find()->joinWith(['provincia', 'municipio', 'comuna']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['provinciaNome'] = [
            'asc' => ['provincia.nomeProvincia' => SORT_ASC],
            'desc' => ['provincia.nomeProvincia' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['municipioNome'] = [
            'asc' => ['municipio.nomeMunicipio' => SORT_ASC],
            'desc' => ['municipio.nomeMunicipio' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['comunaNome'] = [
            'asc' => ['comuna.nomeComuna' => SORT_ASC],
            'desc' => ['comuna.nomeComuna' => SORT_DESC],
        ];
        
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'provincia.nomeProvincia', $this->provinciaNome])
            ->andFilterWhere(['like', 'municipio.nomeMunicipio', $this->municipioNome])
            ->andFilterWhere(['like', 'comuna.nomeComuna', $this->comunaNome])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'funcao', $this->funcao])
            ->andFilterWhere(['like', 'instituicao', $this->instituicao])
            ->andFilterWhere(['like', 'contacto', $this->contacto])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'localidade', $this->localidade])
            ->andFilterWhere(['like', 'pontofocal', $this->pontofocal])
            ->andFilterWhere(['like', 'actividades', $this->actividades])
            ->andFilterWhere(['like', 'entidade', $this->entidade])
            ->andFilterWhere(['like', 'nivel', $this->nivel])
            ->andFilterWhere(['like', 'rotulo', $this->rotulo])
            ->andFilterWhere(['like', 'observacao', $this->observacao])
            ->andFilterWhere(['like', 'privacidade', $this->privacidade])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'usuario', $this->usuario]);

        return $dataProvider;
    }
}
