<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Event;

/**
 * EventSearch represents the model behind the search form of `backend\models\Event`.
 */
class EventSearch extends Event
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'provinciaID', 'municipioID', 'comunaID'], 'integer'],
            [['summary', 'description', 'area', 'start', 'end', 'duracao', 'local', 'coordenadas', 'entidadeOrganizadora', 'convocadoPor', 'participantes'], 'safe'],
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
        $query = Event::find();

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
            'start' => $this->start,
            'end' => $this->end,
            'provinciaID' => $this->provinciaID,
            'municipioID' => $this->municipioID,
            'comunaID' => $this->comunaID,
        ]);

        $query->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'duracao', $this->duracao])
            ->andFilterWhere(['like', 'local', $this->local])
            ->andFilterWhere(['like', 'coordenadas', $this->coordenadas])
            ->andFilterWhere(['like', 'entidadeOrganizadora', $this->entidadeOrganizadora])
            ->andFilterWhere(['like', 'convocadoPor', $this->convocadoPor])
            ->andFilterWhere(['like', 'participantes', $this->participantes]);

        return $dataProvider;
    }
}
