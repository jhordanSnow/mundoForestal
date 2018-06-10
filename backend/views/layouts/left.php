<aside class="main-sidebar">

    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Arboricultura', 'icon' => 'tree', 'options' => ['class' => 'header']],
                    ['label' => 'Plantas', 'icon' => 'leaf', 'url' => ['/plant']],
                    ['label' => 'Familias botánicas', 'icon' => 'pagelines', 'url' => ['/botanical-family']],
                    ['label' => 'Tipos de plantas', 'icon' => 'tree', 'url' => ['/planttype']],
                    ['label' => 'Características', 'icon' => 'tint', 'url' => ['/characteristic']],
                    ['label' => 'Terminología', 'icon' => 'envira', 'url' => ['/terminology']],

                    ['label' => 'Dr Árbol', 'icon' => 'tree', 'options' => ['class' => 'header']],
                    ['label' => 'Consultas', 'icon' => 'question', 'url' => ['/question']],
                    ['label' => 'Categorías', 'icon' => 'tasks', 'url' => ['/question-category']],

                    ['label' => 'Usuarios', 'icon' => 'users', 'options' => ['class' => 'header']],
                    ['label' => 'Administradores', 'icon' => 'users', 'url' => ['/admin']],
                    ['label' => 'Usuarios finales', 'icon' => 'user', 'url' => ['/user']],
                    ['label' => 'Perfil', 'icon' => 'user-circle', 'url' => ['/user/profile']],
                    ['label' => 'Contenido', 'icon' => 'file', 'url' => ['/pagedata/index']],
                ],
            ]
        ) ?>

    </section>

</aside>
