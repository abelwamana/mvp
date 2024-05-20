<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Contacto;

class ContactoSearch extends Contacto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'provinciaID', 'municipioID', 'comunaID'], 'integer'],
            [['nome', 'funcao', 'instituicao', 'contacto', 'email', 'pais', 'localidade', 'pontofocal', 'actividades', 'entidade', 'nivel', 'rotulo', 'privacidade', 'estado'], 'safe'],
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
        $query = Contacto::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'provinciaID' => $this->provinciaID,
            'municipioID' => $this->municipioID,
            'comunaID' => $this->comunaID,
            '' => $this->pontofocal,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
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
              ->andFilterWhere(['like', 'privacidade', $this->privacidade])
              ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'funcao' => 'Função',
            'instituicao' => 'Instituição',
            'contacto' => 'Contacto',
            'email' => 'E-mail',
            'pais' => 'País',
            'localidade' => 'Localidade',
            'pontofocal' => 'Ponto Focal',
            'actividades' => 'Actividades',
            'entidade' => 'Entidade',
            'nivel' => 'Nível',
            'rotulo' => 'Rótulo',
            'privacidade' => 'Privacidade',
            'estado' => 'Estado',
        ];
    }

    /**
     * Returns attribute placeholders.
     *
     * @return array
     */
    public function attributePlaceholders()
    {
        return [
            'nome' => '🔍 Pesquisa por Nome',
            'funcao' => '🔍 Pesquisa por Função',
            'instituicao' => '🔍 Pesquisa por Instituição',
            'contacto' => '🔍 Pesquisa por Contacto',
            'email' => '🔍 Pesquisa por E-mail',
            'pais' => '🔍 Pesquisa por País',
            'localidade' => '🔍 Pesquisa por Localidade',
            'pontofocal' => '🔍 Pesquisa por Ponto Focal',
            'actividades' => '🔍 Pesquisa por Actividades',
            'entidade' => '🔍 Pesquisa por Entidade',
            'nivel' => '🔍 Pesquisa por Nível',
            'rotulo' => '🔍 Pesquisa por Rótulo',
            'privacidade' => '🔍 Pesquisa por Privacidade',
            'estado' => '🔍 Pesquisa por Estado',
        ];
    }
}
