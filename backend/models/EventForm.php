<?php 
namespace backend\models;

use yii\base\Model;

  class EventForm extends Model
{
    public $summary;
    public $description;
    public $start;
    public $end;
    public $localizacao;
    public $entidadeOrganizadora;
    public $participantes;

    public function rules()
    {
        return [
            [['summary', 'start', 'end', 'localizacao', 'entidadeOrganizadora', 'participantes'] , 'required'],
        ];
    }
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
    
    public function attributeLabels()
    {
        return [
            'summary' => 'Título',
            'description' => 'Descrição',
            'start' => 'Data de Início',
            'end' => 'Data de Término',
        ];
    }
}


