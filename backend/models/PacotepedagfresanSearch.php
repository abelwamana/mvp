<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pacotepedagfresan;

/**
 * PacotepedagfresanSearch represents the model behind the search form of `backend\models\Pacotepedagfresan`.
 */
class PacotepedagfresanSearch extends Pacotepedagfresan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'userID'], 'integer'],
            [['receitaMwangole', 'painelAlimentacao', 'outroManualAlimentacao', 'primeiroReporte', 'actualizacao', 'respondente', 'entidade', 'latitude', 'longitude', 'desafiosImplementacaoONG', 'licoesImplementacaoONG', 'dataVisitaFresan', 'tecnicoResponsavelFresan', 'constatacoesFeitasFresan', 'recomendacoesPrincipaisFresan', 'medidasMitigacaoONG', 'medidasMitigacaoEstado', 'estadoValidacao', 'criadoPor', 'actualizadoPor', 'createdAt', 'UpdatedAt'], 'safe'],
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
        $query = Pacotepedagfresan::find();

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
            'provinciaID' => $this->provinciaID,
            'municipioID' => $this->municipioID,
            'comunaID' => $this->comunaID,
            'localidadeID' => $this->localidadeID,
            'primeiroReporte' => $this->primeiroReporte,
            'actualizacao' => $this->actualizacao,
            'dataVisitaFresan' => $this->dataVisitaFresan,
            'userID' => $this->userID,
            'createdAt' => $this->createdAt,
            'UpdatedAt' => $this->UpdatedAt,
        ]);

        $query->andFilterWhere(['like', 'receitaMwangole', $this->receitaMwangole])
            ->andFilterWhere(['like', 'painelAlimentacao', $this->painelAlimentacao])
            ->andFilterWhere(['like', 'outroManualAlimentacao', $this->outroManualAlimentacao])
            ->andFilterWhere(['like', 'respondente', $this->respondente])
            ->andFilterWhere(['like', 'entidade', $this->entidade])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'desafiosImplementacaoONG', $this->desafiosImplementacaoONG])
            ->andFilterWhere(['like', 'licoesImplementacaoONG', $this->licoesImplementacaoONG])
            ->andFilterWhere(['like', 'tecnicoResponsavelFresan', $this->tecnicoResponsavelFresan])
            ->andFilterWhere(['like', 'constatacoesFeitasFresan', $this->constatacoesFeitasFresan])
            ->andFilterWhere(['like', 'recomendacoesPrincipaisFresan', $this->recomendacoesPrincipaisFresan])
            ->andFilterWhere(['like', 'medidasMitigacaoONG', $this->medidasMitigacaoONG])
            ->andFilterWhere(['like', 'medidasMitigacaoEstado', $this->medidasMitigacaoEstado])
            ->andFilterWhere(['like', 'estadoValidacao', $this->estadoValidacao])
            ->andFilterWhere(['like', 'criadoPor', $this->criadoPor])
            ->andFilterWhere(['like', 'actualizadoPor', $this->actualizadoPor]);

        return $dataProvider;
    }
    
    public function getProvincia()
    {
        return $this->hasOne(Provincia::class, ['Id' => 'provinciaID']);
    }
    
     // metodo para definir qual botao aparecer para o usuario, validar, aprovar ou publicar
    public function getAcoesBotoes() {
        $user = Yii::$app->user;
        $acoes = [];

        if ($user->can('Permissao Validador de dados')) {
            $acoes[] = ['label' => '', 'url' => ['validar', 'id' => $this->Id], 'class' => 'btn btn-success fas fa-check-square '];
        }

        if ($user->can('Perfil Aprovação de dados')) {
            $acoes[] = ['label' => '', 'url' => ['aprovar', 'id' => $this->Id], 'class' => 'btn btn-primary fas fa-thumbs-up'];
        }

        if ($user->can('Perfil Lancamento')) {
            $acoes[] = ['label' => '', 'url' => ['publicar', 'id' => $this->Id], 'class' => 'btn btn-primary fa fa-globe'];
        }

        return $acoes;
    }
// ...Metodo que verifica se o usuario tem permisao para validar
    public function canValidate() {
        $user = Yii::$app->user;

        return $user->can('Permissao Validador de dados');
    }
    public function canApprove() {
        $user = Yii::$app->user;

        return $user->can('Perfil Aprovação de dados');
    }
    public function canPublish() {
        $user = Yii::$app->user;

        return $user->can('Perfil Lancamento');
    }
    // ...Metodo que obtem o estadoValidacao
}
