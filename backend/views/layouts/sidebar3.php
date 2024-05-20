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
</style>

<aside class="main-sidebar elevation-4" style="background-color: whitesmoke;">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <p class="nav-link" style="color: #888C00 !important; font-size: 15px">Plataforma Digital Colaborativa</p>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="images/userGeral2.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <b class="d-block" style="color: #888C00 !important;"><?php echo strtoupper(\Yii::$app->user->identity->username); ?> | <?php echo \Yii::$app->user->identity->entidade; ?></b>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
<nav class="mt-2 teste">
    <?php
    // Verifique as permissões do usuário
    $isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");
    $calendarioAtivo = (Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'calendario2');

    // Inicie uma lista de itens de menu
    $menuItems = [
        // Primeiros itens do menu
        ['label' => 'Principais Resultados', 'url' => ['/site/index']],
        ['label' => 'Cobertura', 'url' => ['/site/fresan']],
        ['label' => 'Beneficiários', 'url' => ['/site/beneficiario']],
        ['label' => 'Interface Pública', 'url' => Yii::$app->urlManagerFrontend->createUrl('/site/index')],
        ['template' => '<hr>'],
        
        ['label' => 'Calendário', 'url' => ['/site/calendario2', 'area' => 'inicio', 'reload' => 'true'], 'id' => 'menu-calendario'],
    ];

    // Adicione itens relacionados ao calendário se o calendário estiver ativo
    if ($calendarioAtivo) {
        $menuItems[] = ['label' => 'COMPONENTE I', 'header' => true, 'options' => ['style' => 'padding-left: 40px; font-size: 12px;']];
        $menuItems[] = [
            'label' => '<span class="event-color" style="background-color: #999900;"></span> Agricultura e Pecuária', 'icon' => 'none',
            'url' => ['site/calendario2', 'area' => 'Agricultura e Pecuária'],
            'encode' => false,
        ];
        $menuItems[] = ['label' => 'COMPONENTE II', 'header' => true, 'options' => ['style' => 'padding-left: 40px;font-size: 12px;']];
        $menuItems[] = [
            'label' => '<span class="event-color" style="background-color: #cccc33;"></span> Nutrição', 'icon' => 'none',
            'url' => ['site/calendario2', 'area' => 'Nutrição'],
            'encode' => false,
        ];
        $menuItems[] = [
            'label' => '<span class="event-color" style="background-color: #00c3ff;"></span> Água', 'icon' => 'none',
            'url' => ['site/calendario2', 'area' => 'Água'],
            'encode' => false,
        ];
        $menuItems[] = ['label' => 'COMPONENTE III', 'header' => true, 'options' => ['style' => 'padding-left: 40px;font-size: 12px;']];
        $menuItems[] = [
            'label' => '<span class="event-color" style="background-color: #003399;"></span> Reforço Institucional', 'icon' => 'none',
            'url' => ['site/calendario2', 'area' => 'Reforço Institucional'],
            'encode' => false,
        ];
        $menuItems[] = ['label' => 'OUTRAS', 'header' => true, 'options' => ['style' => 'padding-left: 40px;']];
        $menuItems[] = [
            'label' => '<span class="event-color" style="background-color: #71b13c;"></span> Coordenação','icon' => 'none',
            'url' => ['site/calendario2', 'area' => 'Coordenação'],
            'encode' => false,
        ];
        $menuItems[] = [
            'label' => '<span class="event-color" style="background-color: #663399;"></span> M&A','icon' => 'none',
            'url' => ['site/calendario2', 'area' => 'M&A'],
            'encode' => false,
        ];
        $menuItems[] = [
            'label' => '<span class="event-color" style="background-color: black;"></span> Outras','icon' => 'none',
            'url' => ['site/calendario2', 'area' => 'Outra'],
            'encode' => false,
        ];
    }
    $menuItems[] = ['label' => 'Resumo de Eventos', 'url' => ['event/index']];
    $menuItems[] = ['label' => 'Contactos', 'url' => ['/contacto']];
    $menuItems[] = ['template' => '<hr>'];
    $menuItems [] =         
        [
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
     $menuItems[] = ['template' => '<hr>'];

// Agrupe os itens "Resumo Monitoria", "Resumo Recomendações" e "Resumo Boas Práticas" sob o item "Resumo"
$menuItems[] = [
    'label' => 'Resumo',
    'items' => [
        ['label' => 'Monitoria', 'url' => ['/biblioteca/index2']],
        ['label' => 'Recomendações', 'url' => ['/biblioteca/index3']],
        ['label' => 'Boas Práticas', 'url' => ['/biblioteca/index3']],
    ]
];

// Os outros itens finais do menu
$menuItems[] = ['label' => 'Biblioteca', 'url' => ['/biblioteca/index']];
$menuItems[] = ['label' => 'Galeria', 'url' => ['site/galeria']];
$menuItems[] = ['template' => '<hr>'];

// Itens de administração (se aplicável)...



    // Adicione itens de administração se o usuário for administrador
    if ($isAdmin) {
        $menuItems[] = [
            'label' => 'Administração',
            'items' => [
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
