<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Provincia;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var backend\models\Contacto $model */
/** @var yii\widgets\ActiveForm $form */
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contactos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

$provincias = Provincia::find()->all();
$provinciasList = [];
foreach ($provincias as $provincia) {
    $provinciasList[$provincia->Id] = $provincia->nomeProvincia; // Supondo que o nome da província está na coluna 'nome'
}

$funcoes = [
    'Coordenador Adjunto' => 'Coordenador Adjunto',
    'Assistente Administrativo e Financeiro' => 'Assistente Administrativo e Financeiro',
    'Assistente Administrativo para os RH' => 'Assistente Administrativo para os RH',
    'Assistente de Limpeza' => 'Assistente de Limpeza',
    'Assistente Financeira do Projecto FRESAN' => 'Assistente Financeira do Projecto FRESAN',
    'Assistente Jurídico do Projecto FRESAN' => 'Assistente Jurídico do Projecto FRESAN',
    'Assistente Logístico' => 'Assistente Logístico',
    'Assistente Técnico' => 'Assistente Técnico',
    'Chefe de Divisão de Parcerias Estratégicas' => 'Chefe de Divisão de Parcerias Estratégicas',
    'Consultor das Subvenções' => 'Consultor das Subvenções',
    'Consultor Sistemas de Irrigação - AT' => 'Consultor Sistemas de Irrigação - AT',
    'Coordenadora Adjunta - Namibe' => 'Coordenadora Adjunta - Namibe',
    'Coordenadora Adjunta para a Coordenação Geral' => 'Coordenadora Adjunta para a Coordenação Geral',
    'Coordenadora Geral' => 'Coordenadora Geral',
    'Directora de Serviço de Cooperação Multilateral' => 'Directora de Serviço de Cooperação Multilateral',
    'Engenheiro Hidraúlico' => 'Engenheiro Hidraúlico',
    'Especialista Hidrologia' => 'Especialista Hidrologia',
    'Gestor de Fundos' => 'Gestor de Fundos',
    'Gestora de Dados' => 'Gestora de Dados',
    'Gestora de Fundos' => 'Gestora de Fundos',
    'Gestora de Subvenções do Projecto FRESAN' => 'Gestora de Subvenções do Projecto FRESAN',
    'Gestora do Projecto FRESAN' => 'Gestora do Projecto FRESAN',
    'Motorista' => 'Motorista',
    'Perita Agrária' => 'Perita Agrária',
    'Perita de M&A' => 'Perita de M&A',
    'Perita de Subvenções' => 'Perita de Subvenções',
    'Perita em Nutrição' => 'Perita em Nutrição',
    'Perita Externo' => 'Perita Externo',
    'Perito Agrário' => 'Perito Agrário',
    'Perito em Água' => 'Perito em Água',
    'Perito Hidraúlico' => 'Perito Hidraúlico',
    'Perito Veterinário' => 'Perito Veterinário',
    'Presidente' => 'Presidente',
    'Responsável do Departamento Administrativo e Financeiro' => 'Responsável do Departamento Administrativo e Financeiro',
    'Técnica de Comunicação e Visibilidade' => 'Técnica de Comunicação e Visibilidade',
    'Técnica Superior' => 'Técnica Superior',
    'Técnico de Comunicação e Visibilidade Adjunto' => 'Técnico de Comunicação e Visibilidade Adjunto',
    'Técnico de Subvenções' => 'Técnico de Subvenções',
    'Técnico de Subvenções para Nutrição' => 'Técnico de Subvenções para Nutrição',
    'Técnico Extensionista para as ECA' => 'Técnico Extensionista para as ECA',
    'Técnico Hidraúlico' => 'Técnico Hidraúlico',
    'Vice-Presidente' => 'Vice-Presidente',
    'Outra' => 'Outra'
];

$countries = [
    'Afeganistão' => 'Afeganistão',
    'África do Sul' => 'África do Sul',
    'Albânia' => 'Albânia',
    'Alemanha' => 'Alemanha',
    'Andorra' => 'Andorra',
    'Angola' => 'Angola',
    'Antígua e Barbuda' => 'Antígua e Barbuda',
    'Arábia Saudita' => 'Arábia Saudita',
    'Argélia' => 'Argélia',
    'Argentina' => 'Argentina',
    'Armênia' => 'Armênia',
    'Austrália' => 'Austrália',
    'Áustria' => 'Áustria',
    'Azerbaijão' => 'Azerbaijão',
    'Bahamas' => 'Bahamas',
    'Bahrein' => 'Bahrein',
    'Bangladesh' => 'Bangladesh',
    'Barbados' => 'Barbados',
    'Belarus' => 'Belarus',
    'Bélgica' => 'Bélgica',
    'Belize' => 'Belize',
    'Benin' => 'Benin',
    'Butão' => 'Butão',
    'Bolívia' => 'Bolívia',
    'Bósnia e Herzegovina' => 'Bósnia e Herzegovina',
    'Botsuana' => 'Botsuana',
    'Brasil' => 'Brasil',
    'Brunei' => 'Brunei',
    'Bulgária' => 'Bulgária',
    'Burquina Faso' => 'Burquina Faso',
    'Burundi' => 'Burundi',
    'Cabo Verde' => 'Cabo Verde',
    'Camarões' => 'Camarões',
    'Camboja' => 'Camboja',
    'Canadá' => 'Canadá',
    'Catar' => 'Catar',
    'Cazaquistão' => 'Cazaquistão',
    'Chade' => 'Chade',
    'Chile' => 'Chile',
    'China' => 'China',
    'Chipre' => 'Chipre',
    'Colômbia' => 'Colômbia',
    'Comores' => 'Comores',
    'Congo' => 'Congo',
    'Coreia do Norte' => 'Coreia do Norte',
    'Coreia do Sul' => 'Coreia do Sul',
    'Costa do Marfim' => 'Costa do Marfim',
    'Costa Rica' => 'Costa Rica',
    'Croácia' => 'Croácia',
    'Cuba' => 'Cuba',
    'Dinamarca' => 'Dinamarca',
    'Djibuti' => 'Djibuti',
    'Dominica' => 'Dominica',
    'Egito' => 'Egito',
    'El Salvador' => 'El Salvador',
    'Emirados Árabes Unidos' => 'Emirados Árabes Unidos',
    'Equador' => 'Equador',
    'Eritreia' => 'Eritreia',
    'Eslováquia' => 'Eslováquia',
    'Eslovênia' => 'Eslovênia',
    'Espanha' => 'Espanha',
    'Eswatini' => 'Eswatini',
    'Estados Unidos' => 'Estados Unidos',
    'Estônia' => 'Estônia',
    'Etiópia' => 'Etiópia',
    'Fiji' => 'Fiji',
    'Filipinas' => 'Filipinas',
    'Finlândia' => 'Finlândia',
    'França' => 'França',
    'Gabão' => 'Gabão',
    'Gâmbia' => 'Gâmbia',
    'Gana' => 'Gana',
    'Geórgia' => 'Geórgia',
    'Granada' => 'Granada',
    'Grécia' => 'Grécia',
    'Guatemala' => 'Guatemala',
    'Guiana' => 'Guiana',
    'Guiné' => 'Guiné',
    'Guiné-Bissau' => 'Guiné-Bissau',
    'Guiné Equatorial' => 'Guiné Equatorial',
    'Haiti' => 'Haiti',
    'Honduras' => 'Honduras',
    'Hungria' => 'Hungria',
    'Iémen' => 'Iémen',
    'Ilhas Marshall' => 'Ilhas Marshall',
    'Índia' => 'Índia',
    'Indonésia' => 'Indonésia',
    'Irã' => 'Irã',
    'Iraque' => 'Iraque',
    'Irlanda' => 'Irlanda',
    'Islândia' => 'Islândia',
    'Israel' => 'Israel',
    'Itália' => 'Itália',
    'Jamaica' => 'Jamaica',
    'Japão' => 'Japão',
    'Jordânia' => 'Jordânia',
    'Kuwait' => 'Kuwait',
    'Laos' => 'Laos',
    'Lesoto' => 'Lesoto',
    'Letônia' => 'Letônia',
    'Líbano' => 'Líbano',
    'Libéria' => 'Libéria',
    'Líbia' => 'Líbia',
    'Liechtenstein' => 'Liechtenstein',
    'Lituânia' => 'Lituânia',
    'Luxemburgo' => 'Luxemburgo',
    'Madagáscar' => 'Madagáscar',
    'Malásia' => 'Malásia',
    'Maláui' => 'Maláui',
    'Maldivas' => 'Maldivas',
    'Mali' => 'Mali',
    'Malta' => 'Malta',
    'Marrocos' => 'Marrocos',
    'Maurícia' => 'Maurícia',
    'Mauritânia' => 'Mauritânia',
    'México' => 'México',
    'Mianmar' => 'Mianmar',
    'Micronésia' => 'Micronésia',
    'Moçambique' => 'Moçambique',
    'Moldávia' => 'Moldávia',
    'Mônaco' => 'Mônaco',
    'Mongólia' => 'Mongólia',
    'Montenegro' => 'Montenegro',
    'Namíbia' => 'Namíbia',
    'Nauru' => 'Nauru',
    'Nepal' => 'Nepal',
    'Nicarágua' => 'Nicarágua',
    'Níger' => 'Níger',
    'Nigéria' => 'Nigéria',
    'Noruega' => 'Noruega',
    'Nova Zelândia' => 'Nova Zelândia',
    'Omã' => 'Omã',
    'Países Baixos' => 'Países Baixos',
    'Palau' => 'Palau',
    'Panamá' => 'Panamá',
    'Papua-Nova Guiné' => 'Papua-Nova Guiné',
    'Paquistão' => 'Paquistão',
    'Paraguai' => 'Paraguai',
    'Peru' => 'Peru',
    'Polônia' => 'Polônia',
    'Portugal' => 'Portugal',
    'Quênia' => 'Quênia',
    'Quirguistão' => 'Quirguistão',
    'Reino Unido' => 'Reino Unido',
    'República Centro-Africana' => 'República Centro-Africana',
    'República Checa' => 'República Checa',
    'República Democrática do Congo' => 'República Democrática do Congo',
    'República Dominicana' => 'República Dominicana',
    'Romênia' => 'Romênia',
    'Ruanda' => 'Ruanda',
    'Rússia' => 'Rússia',
    'Salomão' => 'Salomão',
    'Samoa' => 'Samoa',
    'Santa Lúcia' => 'Santa Lúcia',
    'São Cristóvão e Nevis' => 'São Cristóvão e Nevis',
    'São Marino' => 'São Marino',
    'São Tomé e Príncipe' => 'São Tomé e Príncipe',
    'Senegal' => 'Senegal',
    'Serra Leoa' => 'Serra Leoa',
    'Sérvia' => 'Sérvia',
    'Singapura' => 'Singapura',
    'Síria' => 'Síria',
    'Somália' => 'Somália',
    'Sri Lanka' => 'Sri Lanka',
    'Suazilândia' => 'Suazilândia',
    'Sudão' => 'Sudão',
    'Sudão do Sul' => 'Sudão do Sul',
    'Suécia' => 'Suécia',
    'Suíça' => 'Suíça',
    'Suriname' => 'Suriname',
    'Tailândia' => 'Tailândia',
    'Taiwan' => 'Taiwan',
    'Tajiquistão' => 'Tajiquistão',
    'Tanzânia' => 'Tanzânia',
    'Timor-Leste' => 'Timor-Leste',
    'Togo' => 'Togo',
    'Tonga' => 'Tonga',
    'Trinidad e Tobago' => 'Trinidad e Tobago',
    'Tunísia' => 'Tunísia',
    'Turcomenistão' => 'Turcomenistão',
    'Turquia' => 'Turquia',
    'Tuvalu' => 'Tuvalu',
    'Ucrânia' => 'Ucrânia',
    'Uganda' => 'Uganda',
    'Uruguai' => 'Uruguai',
    'Uzbequistão' => 'Uzbequistão',
    'Vanuatu' => 'Vanuatu',
    'Vaticano' => 'Vaticano',
    'Venezuela' => 'Venezuela',
    'Vietnã' => 'Vietnã',
    'Zâmbia' => 'Zâmbia',
    'Zimbábue' => 'Zimbábue',
];
?>
<style>
    .has-error .help-block {
        color: red;
    }
</style>

<div class="contacto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'funcao')->widget(Select2::classname(), [
        'data' => $funcoes,
        'options' => ['placeholder' => 'Selecione/escreva uma função...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
   ?>


    <?= $form->field($model, 'instituicao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'pais')->widget(Select2::classname(), [
        'data' => $countries,
        'options' => ['placeholder' => 'Selecione um país...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

<?= $form->field($model, 'provinciaID')->dropDownList($provinciasList, ['prompt' => 'Selecione a província', 'id' => 'provincia-select']) ?>

    <!-- Dropdown para Município -->
<?= $form->field($model, 'municipioID')->dropDownList([], ['prompt' => 'Selecione o município', 'id' => 'municipio-select']) ?>

    <!-- Dropdown para Comuna -->
    <?= $form->field($model, 'comunaID')->dropDownList([], ['prompt' => 'Selecione a comuna', 'id' => 'comuna-select']) ?>

    <?= $form->field($model, 'localidade')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'pontofocal')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'actividades')->widget(Select2::classname(), [
        'data' => [
            'AVSAN' => 'AVSAN',
            'AIDI' => 'AIDI',
            'BA' => 'FM',
            'CDP' => 'CDP',
            'CVB' => 'CVB',
            'FM' => 'FM',
            'GC' => 'GC',
            'GTCun' => 'GTCun',
            'GTHuila' => 'GTHuila',
            'GTNam' => 'GTNam',
            'IPC' => 'IPC',
            'NEWSL' => 'NEWSL',
            'RI' => 'RI',
            'Subvenções' => 'Subvenções',
            'Outra' => 'Outra',
        ],
        'options' => [
            'placeholder' => 'Selecione as atividades...',
            'multiple' => true,
            'id' => 'select-actividades',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ]
    ])
    ?>
    <?=
    $form->field($model, 'entidade')->widget(Select2::classname(), [
        'data' => [
            'Camões, I.P. | ADESPOV/C4' => 'Camões, I.P. | ADESPOV/C4',
            'Camões, I.P. | ADPP/C1' => 'Camões, I.P. | ADPP/C1',
            'Camões, I.P. | ADRA/C4' => 'Camões, I.P. | ADRA/C4',
            'Camões, I.P. | CODESPA/C2' => 'Camões, I.P. | CODESPA/C2',
            'Camões, I.P. | CODESPA/C4' => 'Camões, I.P. | CODESPA/C4',
            'Camões, I.P. | COSPE/C1' => 'Camões, I.P. | COSPE/C1',
            'Camões, I.P. | CUAMM/C2' => 'Camões, I.P. | CUAMM/C2',
            'Camões, I.P. | CUAMM/C4' => 'Camões, I.P. | CUAMM/C4',
            'Camões, I.P. | DW/C1' => 'Camões, I.P. | DW/C1',
            'Camões, I.P. | DW/C4' => 'Camões, I.P. | DW/C4',
            'Camões, I.P. | FEC/C2' => 'Camões, I.P. | FEC/C2',
            'Camões, I.P. | FEC/C2' => 'Camões, I.P. | FEC/C4',
            'Camões, I.P. | NCA/C4' => 'Camões, I.P. | NCA/C1',
            'Camões, I.P. | NCA/C4' => 'Camões, I.P. | NCA/C4',
            'Camões, I.P. | PIN/C2' => 'Camões, I.P. | PIN/C2',
            'Camões, I.P. | PIN/C4' => 'Camões, I.P. | PIN/C4',
            'Camões, I.P. | TESE/C4' => 'Camões, I.P. | TESE/C4',
            'Camões, I.P. | UIC' => 'Camões, I.P. | UIC',
            'Camões, I.P. | WVI/C1' => 'Camões, I.P. | WVI/C1',
            'Camões, I.P. | WVI/C4' => 'Camões, I.P. | WVI/C4',
            'FAO' => 'FAO',
            'Governo' => 'Governo',
            'PNUD' => 'PNUD',
            'Vall d´Hebron' => 'Vall d´Hebron',
            'Outra' => 'Outra'
            ],
        'options' => [
            'placeholder' => 'Selecione a Entidade...',
            'multiple' => false,
            'id' => 'select-entidade',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ]])
    ?>

    <?= $form->field($model, 'nivel')->dropDownList( [
        'Nacional' => 'Nacional', 
       'Provincial' => 'Provincial',
        'Municipal' => 'Municipal', 
       'Local' => 'Local'
        ], 
            ['prompt' => 'Selecione o nível']) ?>

    <?= $form->field($model, 'rotulo')->dropDownList( [
        'Coordenação' => 'Coordenação', 
       'Governo' => 'Governo',
        'Gestor' => 'Gestor',
        'Perito' => 'Perito', 
       'Subvenções' => 'Subvenções',
        'Técnico' => 'Técnico',
        'Logística' => 'Logística',
        'Outro' => 'Outro'
        ], 
            ['prompt' => 'Selecione o Rótulo']) ?>

    <?= $form->field($model, 'observacao')->textarea(['rows' => 6]) ?>


<?= $form->field($model, 'estado')->dropDownList(['Activo' => 'Activo', 'Inactivo' => 'Inactivo'], ['prompt' => 'Selecione o estado']) ?>

    <div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>


<?php
// JavaScript para atualizar os dropdownlists de municípios e comunas com base na província selecionada
$script = <<< JS
$(document).ready(function(){
    $('#provincia-select').change(function(){
        var provinciaID = $(this).val();
        
        if(provinciaID){
            $.ajax({
                type: 'GET',
                url: 'site/get-municipios',
                data: {
                   id: provinciaID
                },
                dataType: 'json', // Especifica o tipo de dados esperado como JSON
                success: function(data){
                    // Limpa a dropdownlist de municípios
                    $('#municipio-select').empty();
                    // Adiciona a opção padrão
                    $('#municipio-select').append($('<option>', {
                        value: '',
                        text: 'Selecione o município'
                    }));
                    // Adiciona cada município retornado pela requisição AJAX à dropdownlist
                    $.each(data, function(index, municipio) {
                        $('#municipio-select').append($('<option>').text(municipio.nome).attr('value', municipio.id));
                    });
                    // Limpa o conteúdo do elemento com id comuna-select
                    $('#comuna-select').html('<option value="">Selecione a comuna</option>');
                },
                error: function() {
                    // Trata erros caso ocorram na requisição AJAX
                    alert('Erro ao obter os municípios.');
                }
            });
        } else {
            // Limpa o conteúdo dos elementos município-select e comuna-select
            $('#municipio-select').html('<option value="">Selecione o município</option>');
            $('#comuna-select').html('<option value="">Selecione a comuna</option>');
        }
    });
        
        $('#municipio-select').change(function(){
    var municipioID = $(this).val();
        
    if(municipioID){
        $.ajax({
            type: 'GET',
            url: 'site/get-comunas',
            data: {
                id: municipioID
            },
             dataType: 'json', // Especifica o tipo de dados esperado como JSON
            success: function(data){            
                // Limpa a dropdownlist de comunas
                $('#comuna-select').empty();
                // Adiciona a opção padrão
                $('#comuna-select').append($('<option>', {
                    value: '',
                    text: 'Selecione a comuna'
                }));
                // Adiciona cada comuna retornada pela requisição AJAX à dropdownlist
                $.each(data, function(index, value) {
                    $('#comuna-select').append($('<option>').text(value.nome).attr('value', value.id));
                    
                });
            },
            error: function() {
                // Trata erros caso ocorram na requisição AJAX
                alert('Erro ao obter as comunas.');
            }
        });
    } else {
        // Limpa o conteúdo do elemento com id comuna-select
        $('#comuna-select').html('<option value="">Selecione a comuna</option>');
    }
});

        
});

JS;
$this->registerJs($script);
?>

<?php
$this->registerJs("
    $('#contactos-contacto').inputmask({
        mask: '+99999999999999',
        placeholder: '',
        showMaskOnHover: false,
        showMaskOnFocus: true
    });
");
?>