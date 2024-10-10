<style>
    .nav-item .nav-link.active {
        background-color: #919733; /* Substitua "red" pela cor desejada */
    }

    /* CSS para esconder o submenu do menu "Calendário" por padrão */
    #menu-calendario .dropdown-menu {
        display: none;
    }

    /* CSS para exibir o submenu quando o menu "Calendário" é focado ou quando o mouse está sobre ele */
    #menu-calendario:hover .dropdown-menu,
    #menu-calendario:focus .dropdown-menu {
        display: block;
    }
    .submenu-item {
        margin-left: 20px; /* Ajuste esta margem conforme necessário */
    }
/*    .nav-pills .nav-link.active, .nav-pills .show>.nav-link
    {
        background-color: #888C00 !important;  Defina a cor que deseja para links clicados 
    }*/
    /*.submenu-item:active {
        background-color: #ff0000 !important;  Substitua #ff0000 pela cor desejada 
         Outros estilos que você deseja aplicar quando o item do menu está ativo 
    }
    .active-menu {
        background-color: #ff0000;  Substitua 'your-color' pela cor desejada 
    }*/

.filter-area.active {
    
    background-color: #999900; /* Ou qualquer cor de destaque desejada */
    color: yellow !important; /* Ajuste a cor do texto conforme necessário */
    border-radius: 3px;
    .nav-link p
{
    color: #FFFFFF;
}

}
.sidebar {
    width: 250px; /* Define a largura fixa */
    transition: none; /* Remove qualquer transição */
}

/* Remova ou desative isso */
.sidebar.collapsed {
    width: 0; /* Ou qualquer valor que cause o colapso */
}
</style>

<aside class="main-sidebar elevation-4" style="background-color: whitesmoke;">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <p class="nav-link" style="color: #888C00 !important; margin-top: 10px; font-size: 15px"> Plataforma Digital Colaborativa</p>
        <!-- Sidebar Menu -->
        <nav class="mt-2 teste">
            <?php
            // Verifique as permissões do usuário
            $isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");
            $resultadosAtivo = (Yii::$app->controller->id === 'site' && ((Yii::$app->controller->action->id === 'index') || (Yii::$app->controller->action->id === 'resultadosagricultura') || (Yii::$app->controller->action->id === 'resultadosnutricao') || (Yii::$app->controller->action->id === 'resultadosagua') || (Yii::$app->controller->action->id === 'resultadosreforcoinstitucional')));
            $coberturaAtivo = (Yii::$app->controller->id === 'site' && ((Yii::$app->controller->action->id === 'fresan') || (Yii::$app->controller->action->id === 'fresancunene') || (Yii::$app->controller->action->id === 'fresanhuila') || (Yii::$app->controller->action->id === 'fresannamibe')));
            $calendarioAtivo = (Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'calendario');
            // Inicie uma lista de itens de menu
            $menuItems[] = ['label' => 'Resultados', 'url' => ['/site/index']];
            if ($resultadosAtivo) {

                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #999900; display: inline-block; width: 10px; height: 10px; margin-right: 5px;"></span> Agricultura e Pecuária',
                    'url' => ['/site/resultadosagricultura'],
                    'icon' => 'none',
                    'encode' => false,
                    'options' => ['class' => 'submenu-item'],
                ];
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #cccc33; display: inline-block; width: 10px; height: 10px; margin-right: 5px;"></span> Nutrição',
                    'url' => ['/site/resultadosnutricao'],
                    'icon' => 'none',
                    'encode' => false,
                    'options' => ['class' => 'submenu-item'],
                ];
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #00c3ff; display: inline-block; width: 10px; height: 10px; margin-right: 5px;"></span> Água',
                    'url' => ['/site/resultadosagua'],
                    'icon' => 'none',
                    'encode' => false,
                    'options' => ['class' => 'submenu-item'],
                ];
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #003399; display: inline-block; width: 10px; height: 10px; margin-right: 5px;"></span> Reforço Institucional',
                    'url' => ['/site/resultadosreforcoinstitucional'],
                    'icon' => 'none',
                    'encode' => false,
                    'options' => ['class' => 'submenu-item'],
                ];
            }

            // ['label' => 'Resultados Secundários', 'url' => ['/Monitoria/index2']],
            $menuItems[] = ['label' => 'Cobertura', 'url' => ['/site/fresan']];
            if ($coberturaAtivo) {
                $menuItems[] = ['label' => 'Cunene', 'url' => ['/site/fresancunene'], 'iconStyle' => 'far', 'options' => ['class' => 'submenu-item']];
                $menuItems[] = ['label' => 'Huíla', 'url' => ['/site/fresanhuila', 'area' => 'Huila'], 'iconStyle' => 'far', 'options' => ['class' => 'submenu-item']];
                $menuItems[] = ['label' => 'Namibe', 'url' => ['/site/fresannamibe', 'area' => 'Namibe'], 'iconStyle' => 'far', 'options' => ['class' => 'submenu-item']];

                // ['label' => 'Interface Pública', 'url' => Yii::$app->urlManagerFrontend->createUrl('/site/index')],
            }
            $menuItems[] = ['label' => 'Beneficiários', 'url' => ['/site/beneficiario']];
            $menuItems[] = ['label' => 'Galeria', 'url' => ['site/galeria']];
            $menuItems[] = ['template' => '<hr>'];
            $menuItems[] = ['label' => 'Calendário', 'url' => ['/site/calendario']];
            // Adicione itens relacionados ao calendário se o calendário estiver ativo
            if ($calendarioAtivo) {
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #999900;"></span> Agricultura e Pecuária', 'icon' => 'none',
                    'url' => ['site/calendario', 'area' => 'Agricultura e Pecuária'],
                    'encode' => false,
                    'options' => ['class' => 'pb-(-5) submenu-item filter-area',
                        'data-area' => 'Agricultura e Pecuária'], // Adiciona classe de bootstrap para espaço inferior (pb = padding-bottom)
                ];
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #cccc33;"></span> Nutrição', 'icon' => 'none',
                    'url' => ['site/calendario', 'area' => 'Nutrição'],
                    'encode' => false,
                    'options' => ['class' => 'pb-(-5) submenu-item filter-area',
                        'data-area' => 'Nutrição'], // Adiciona classe de bootstrap para espaço inferior (pb = padding-bottom)
                ];
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #00c3ff;"></span> Água', 'icon' => 'none',
                    'url' => ['site/calendario', 'area' => 'Água'],
                    'encode' => false,
                    'options' => ['class' => 'pb-(-5) submenu-item filter-area',
                        'data-area' => 'Água'], // Adiciona classe de bootstrap para espaço inferior (pb = padding-bottom)
                ];
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #003399;"></span> Reforço Institucional', 'icon' => 'none',
                    'url' => ['site/calendario', 'area' => 'Reforço Institucional'],
                    'encode' => false,
                    'options' => ['class' => 'pb-(-5)  submenu-item filter-area',
                        'data-area' => 'Reforço Institucional'], // Adiciona classe de bootstrap para espaço inferior (pb = padding-bottom)
                ];
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #71b13c;"></span> Coordenação UIC', 'icon' => 'none',
                    'url' => ['site/calendario', 'area' => 'Coordenação'],
                    'encode' => false,
                    'options' => ['class' => 'pb-(-5)  submenu-item filter-area',
                        'data-area' => 'Coordenação UIC'], // Adiciona classe de bootstrap para espaço inferior (pb = padding-bottom)
                ];
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #663399;"></span> Subvenções/M&A', 'icon' => 'none',
                    'url' => ['site/calendario', 'area' => 'Subvenções/M&A'],
                    'encode' => false,
                    'options' => ['class' => 'pb-(-5) submenu-item filter-area',
                        'data-area' => 'Subvenções/M&A'], // Adiciona classe de bootstrap para espaço inferior (pb = padding-bottom)
                ];
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: #BB0E22;"></span> Governo', 'icon' => 'none',
                    'url' => ['site/calendario', 'area' => 'Governo'],
                    'encode' => false,
                    'options' => ['class' => 'pb-20 submenu-item filter-area',
                         'data-area' => 'Governo'], // Adiciona classe de bootstrap para espaço inferior (pb = padding-bottom)
                ];
                $menuItems[] = [
                    'label' => '<span class="event-color" style="background-color: black;"></span> Outras', 'icon' => 'none',
                    'url' => ['site/calendario', 'area' => 'Outra'],
                    'encode' => false,
                    'options' => ['class' => 'pb-20 submenu-item filter-area',
                         'data-area' => 'Outra'], // Adiciona classe de bootstrap para espaço inferior (pb = padding-bottom)
                ];
            }
            $menuItems[] = ['label' => 'Lista de Eventos', 'url' => ['event/listaeventos']];
            $menuItems[] = ['label' => 'Contactos', 'url' => ['/contacto']];
            $menuItems[] = ['template' => '<hr>'];

            //           $menuItems [] =//        [
//            'label' => 'Reportar Dados',
//            'items' => [
//                ['label' => 'Login', 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
//                ['label' => 'COMPONENTE I', 'header' => true],
//                ['label' => 'Agricultura e Pecuária', 'url' => ['/grupo/index']],
//                ['label' => 'COMPONENTE II', 'header' => true],
//                [
//                    'label' => 'Nutrição',
//                    'items' => [
//                        ['label' => 'Demostrações Culinárias', 'url' => ['/demostracoesculinarias/index']],
//                        ['label' => 'Rastreio', 'url' => ['/rastreio/index']],
//                        ['label' => 'Capacitações Técnicos de Saúde', 'url' => ['/profissionaissaude/index']],
//                        ['label' => 'Pacote Pedagógico FRESAN', 'url' => ['/pacotepedagfresan/index']],
//                        ['label' => 'Suplementação', 'url' => ['/suplementacao/index']],
//                        ['label' => 'Merenda Escolar', 'url' => ['/merendaescolar/index']],
//                        ['label' => 'Capacitação', 'url' => ['/capacitacao/index']],
//                        ['label' => 'Materiais', 'url' => ['/materiais/index']],
//                        ['label' => 'Supervisão', 'url' => ['/supervisao/index']],
//                    ],
//                ],
//                ['label' => 'Água', 'url' => ['/agua/index']],
//                ['label' => 'COMPONENTE III', 'header' => true],
//                ['label' => 'Reforço Institucional', 'url' => ['/reforcoinstitucional/index']],
//                ['label' => 'SUPLEMENTOS', 'header' => true],
//                ['label' => 'Comunicação', 'url' => ['/doccomunicacao/index']],
//                ['label' => 'Eventos', 'url' => ['/eventos/index']],
//            ],
//    ];

            if ($isAdmin) {
                $menuItems [] = [
                    'label' => 'Reportar Dados',
                    'items' => [
                        ['label' => 'Login', 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'COMPONENTE I', 'header' => true],
                        ['label' => 'Agricultura e Pecuária', 'url' => ['/grupo/index']],
                        ['label' => 'COMPONENTE II', 'header' => true],
                        [
                            'label' => 'Nutrição',
                            'items' => [
                                ['label' => 'Demostrações Culinárias', 'url' => ['/demostracoesculinarias/index']],
                                ['label' => 'Rastreio', 'url' => ['/rastreio/index']],
                                ['label' => 'Capacitações Técnicos de Saúde', 'url' => ['/profissionaissaude/index']],
                                ['label' => 'Pacote Pedagógico FRESAN', 'url' => ['/pacotepedagfresan/index']],
                                ['label' => 'Suplementação', 'url' => ['/suplementacao/index']],
                                ['label' => 'Merenda Escolar', 'url' => ['/merendaescolar/index']],
                                ['label' => 'Capacitação', 'url' => ['/capacitacao/index']],
                                ['label' => 'Materiais', 'url' => ['/materiais/index']],
                                ['label' => 'Supervisão', 'url' => ['/supervisao/index']],
                            ],
                        ],
                        ['label' => 'Água', 'url' => ['/agua/index']],
                        ['label' => 'COMPONENTE III', 'header' => true],
                        ['label' => 'Reforço Institucional', 'url' => ['/reforcoinstitucional/index']],
                        ['label' => 'SUPLEMENTOS', 'header' => true],
                        ['label' => 'Comunicação', 'url' => ['/doccomunicacao/index']],
                        ['label' => 'Eventos', 'url' => ['/eventos/index']],
                    ],
                ];
            } else {

                $menuItems[] = ['label' => 'Reportar Dados', 'url' => ['site/emconstrucao']];
            }
            $menuItems[] = ['template' => '<hr>'];

// Agrupe os itens "Resumo Monitoria", "Resumo Recomendações" e "Resumo Boas Práticas" sob o item "Resumo"
//$menuItems[] =  ['label' => 'Resultados Secundários', 'url' => ['/monitoria/index2']];
            $menuItems[] = ['label' => 'Biblioteca', 'url' => ['biblioteca/biblioteca']];
             $menuItems[] = ['label' => 'Arquivos', 'url' => ['arquivos/index']];
            $menuItems[] = ['label' => 'Recomendações', 'url' => ['site/emconstrucao']];
            $menuItems[] = ['label' => 'Boas Práticas', 'url' => ['site/emconstrucao']];
            $menuItems[] = ['label' => 'Sustentabilidade', 'url' => ['site/emconstrucao']];
// $menuItems[] = ['label' => 'Galeria', 'url' => ['site/galeria']];
            $menuItems[] = ['template' => '<hr>'];

// Itens de administração (se aplicável)...
            // Adicione itens de administração se o usuário for administrador
            if ($isAdmin) {
                $menuItems[] = [
                    'label' => 'Administração',
                    'items' => [
                        ['label' => 'Biblioteca', 'url' => ['/biblioteca/index'], 'iconStyle' => 'far'],
                        [
                            'label' => 'Configurações',
                            'items' => [
                                ['label' => 'Provincia', 'url' => ['/provincia/index'], 'iconStyle' => 'far'],
                                ['label' => 'Municipio', 'url' => ['/municipio/index'], 'iconStyle' => 'far'],
                                ['label' => 'Comuna', 'url' => ['/comuna/index'], 'iconStyle' => 'far'],
                                ['label' => 'Localidade', 'url' => ['/localidade/index'], 'iconStyle' => 'far'],
                                ['label' => 'Unidade', 'url' => ['/unidade/index'], 'iconStyle' => 'far'],
                                ['label' => 'Class.Doc.Artigo', 'url' => ['/classificacaodocumentoartigo/index'], 'iconStyle' => 'far'],
                                ['label' => 'Finalidade.Agri', 'url' => ['/finalidade/index'], 'iconStyle' => 'far'],
                                ['label' => 'Culturas Providas', 'url' => ['/culturasprovidas/index'], 'iconStyle' => 'far'],
                                ['label' => 'Metas', 'url' => ['/metas/index'], 'iconStyle' => 'far'],
                            ],
                        ],
                        ['label' => 'Administrar Usuários', 'url' => ['/user/index'], 'iconStyle' => 'far'],
                        ['label' => 'Rotas', 'url' => ['/rbac/route'], 'iconStyle' => 'far'],
                        ['label' => 'Permissão Rotas', 'url' => ['/rbac/permission'], 'iconStyle' => 'far'],
                        ['label' => 'Perfil', 'url' => ['/rbac/role'], 'iconStyle' => 'far'],
                        ['label' => 'Atribuir Perfil a Usuário', 'url' => ['/rbac/assignment'], 'iconStyle' => 'far'],
                    ],
                ];
            }

            // Renderize o menu com todos os itens definidos
            echo hail812\adminlte\widgets\Menu::widget(['items' => $menuItems]);
            ?>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
// Função para aplicar o filtro de área
function filtrarPorArea(areaSelecionada) {
    // Salve o valor da área selecionada no armazenamento local
    localStorage.setItem('areasSelecionadas', areaSelecionada);

    // Faça uma chamada AJAX para a ação 'get-events' com a área como parâmetro
    $.ajax({
        url: 'get-events',
        type: 'GET',
        data: { areas: [areaSelecionada] },
        success: function(response) {
            // Remova a fonte de eventos atual antes de adicionar a nova fonte
            $('#meuCalendario').fullCalendar('removeEvents');
            // Adicione a nova fonte de eventos filtrados
            $('#meuCalendario').fullCalendar('addEventSource', response);
        },
        error: function(xhr, status, error) {
            // Lide com erros, se necessário
        }
    });
}

// Adicione um event listener para os itens do menu lateral com a classe 'filter-area'
$('.filter-area').on('click', function(e) {
    e.preventDefault(); // Evita o comportamento padrão de redirecionamento

    var areaSelecionada = $(this).data('area'); // Obtém o valor da área selecionada
    filtrarPorArea(areaSelecionada); // Aplica o filtro
});

$('.filter-area').on('click', function(e) {
    e.preventDefault(); // Evita o comportamento padrão de redirecionamento

    // Remova a classe 'active' de todos os itens de menu
    $('.filter-area').removeClass('active');

    // Adicione a classe 'active' ao item clicado
    $(this).addClass('active');

    var areaSelecionada = $(this).data('area'); // Obtém o valor da área selecionada
    filtrarPorArea(areaSelecionada); // Aplica o filtro
});

</script>