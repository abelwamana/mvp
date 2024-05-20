<aside class="main-sidebar elevation-4" style="background-color: whitesmoke;">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="color: #888C00 !important;"><b><?php echo strtoupper(\Yii::$app->user->identity->username); ?> | <?php echo \Yii::$app->user->identity->entidade; ?></b></a>
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
            $isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");

            $menuItems = [
                ['label' => 'Principais Resultados', 'url' => ['/site/index']],
                ['label' => 'Plataforma Pública', 'url' => Yii::$app->urlManagerFrontend->createUrl('/site/index')],
                ['label' => 'Onde Estamos', 'url' => ['/site/fresan']],
                [
                    'label' => 'Reportar Dados',
                    'items' => [
                        ['label' => 'Login', 'url' => ['/site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'COMPONENTE 1', 'header' => true],
                        ['label' => 'Agricultura e Pecuária', 'url' => ['/grupo/index']],
                        ['label' => 'COMPONENTE 2', 'header' => true],
                        [
                            'label' => 'Nutrição', 'icon' => 'th',
                            'items' => [
                                ['label' => 'Demostrações Culinárias', 'url' => ['/demostracoesculinarias/index'], 'iconStyle' => 'far'],
                                ['label' => 'Rastreio', 'url' => ['/rastreio/index'], 'iconStyle' => 'far'],
                                ['label' => 'Capacitações Técnicos de Saúde ', 'url' => ['/profissionaissaude/index'], 'iconStyle' => 'far'],
                                ['label' => 'Pacote Ped. FRESAN', 'url' => ['/pacotepedagfresan/index'], 'iconStyle' => 'far'],
                                ['label' => 'Suplementação', 'url' => ['/suplementacao/index'], 'iconStyle' => 'far'],
                                ['label' => 'Merenda Escolar', 'url' => ['/merendaescolar/index'], 'iconStyle' => 'far'],
                                ['label' => 'Capacitação', 'url' => ['/capacitacao/index'], 'iconStyle' => 'far'],
                                ['label' => 'Materiais', 'url' => ['/materiais/index'], 'iconStyle' => 'far'],
                                ['label' => 'Supervisão', 'url' => ['/supervisao/index'], 'iconStyle' => 'far'],
                            ]
                        ],
                        ['label' => 'Água', 'icon' => 'th', 'url' => ['/agua/index']],
                        ['label' => 'COMPONENTE 3', 'header' => true],
                        ['label' => 'Reforço Institucional', 'url' => ['/reforcoinstitucional/index']],
                        ['label' => 'SUPLEMENTOS', 'header' => true],
                        ['label' => 'Comunicação', 'url' => ['/doccomunicacao/index']],
                        ['label' => 'Eventos', 'url' => ['/eventos/index']],
                    ]
                ],
                ['template' => '<hr>',],
                ['label' => 'EVIDÊNCIAS', 'header' => true],
                [
                    'label' => 'Relatórios',
                    'items' => [
                        ['label' => 'Folha Trimestral', 'url' => ['/site/folhatrimestral'], 'iconStyle' => 'far'],
                        ['label' => 'Quadro Lógico', 'url' => ['/site/quadrologico'], 'iconStyle' => 'far'],
                        ['label' => 'Relatórios Intercalar', 'url' => ['/site/quadrologico'], 'iconStyle' => 'far'],
                        ['label' => 'Relatórios DELUE', 'url' => ['/site/quadrologico'], 'iconStyle' => 'far'],
                    ]
                ],
                ['label' => 'Monitoria das Acções', 'url' => ['/biblioteca/index2']],
                ['label' => 'Recomendações ', 'url' => ['/biblioteca/index3']],
                ['label' => 'Biblioteca', 'url' => ['/biblioteca/index']],
                ['label' => 'Galeria', 'url' => ['/galeria/index']],
                [
                    'label' => 'Eventos',
                    'url' => ['/site/calendario2','area' => 'inicio', 'reload' => 'true'],
                    'items' => [
                        ['label' => 'Calendário', 'url' => ['/site/calendario2','area' => 'inicio', 'reload' => 'true']],                        
                        [
                            'label' => '<span class="event-color" style="background-color: #999900;"></span> Agricultura e Pecuária',
                            'url' => ['site/calendario2', 'area' => 'Agricultura e Pecuária'], 
                            'encode' => false,                                                   
                        ],
                        [
                            'label' => '<span class="event-color" style="background-color: #cccc33;"></span> Nutrição',
                            'url' => ['site/calendario2', 'area' => 'Nutrição'], // Passa 'Nutrição' como parâmetro
                            'encode' => false,
                        ],
                        [
                            'label' => '<span class="event-color" style="background-color: #003399;"></span> Água',
                            'url' => ['site/calendario2', 'area' => 'Água'], // Passa 'Nutrição' como parâmetro
                            'encode' => false, 
                        ],
                        [
                            'label' => '<span class="event-color" style="background-color: gray;"></span> Reforço Institucional',
                            'url' => ['site/calendario2', 'area' => 'Reforço Institucional'], // Passa 'Nutrição' como parâmetro
                            'encode' => false, 
                        ],
                        [
                            'label' => '<span class="event-color" style="background-color: #71b13c;"></span> Coordenação',
                            'url' => ['site/calendario2', 'area' => 'Coordenação'], // Passa 'Nutrição' como parâmetro
                            'encode' => false, 
                        ],
                        [
                            'label' => '<span class="event-color" style="background-color: black;"></span> Outras',
                            'url' => ['site/calendario2', 'area' => 'Outras'], // Passa 'Nutrição' como parâmetro
                            'encode' => false, 
                        ],
                    ],
                ],
                ['label' => 'Recomendações', 'url' => ['/galeria/index1']],
                ['label' => 'Contactos', 'url' => ['/contactos/index']],
                ['template' => '<hr>']
            ];

            if ($isAdmin) {
                $menuItems[] = [
                    'label' => 'Administração',
                    'items' => [
//                        ['label' => 'ADMIN', 'header' => true],
                        [
                            'label' => 'Configurações', 'icon' => 'th',
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
                            ]
                        ],
                        ['label' => 'Administrar Usuários', 'url' => ['/user/index'], 'iconStyle' => 'far'],
                        //['label' => 'Eventos de usuários', 'url' => ['/reforcoinstitucional/relatorioreforco7'], 'iconStyle' => 'far'],
                        ['label' => 'Rotas', 'url' => ['/rbac/route'], 'iconStyle' => 'far'],
                        ['label' => 'Permissão Rotas', 'url' => ['/rbac/permission'], 'iconStyle' => 'far'],
                        ['label' => 'Perfil', 'url' => ['/rbac/role'], 'iconStyle' => 'far'],
                        ['label' => 'Atribuir Perfil a Usuário', 'url' => ['/rbac/assignment'], 'iconStyle' => 'far'],
                    ],
                ];
            }
            ?>

            <?= hail812\adminlte\widgets\Menu::widget(['items' => $menuItems]) ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
