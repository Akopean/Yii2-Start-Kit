<?php
use mdm\admin\components\Helper;
use yii\web\View;
use backend\widgets\SideNav;
use yii\helpers\ArrayHelper;
//use yii\helpers\Html;
/* @var $this View */
$items = ArrayHelper::getValue($this->params, 'sideMenu', []);
?>
<!-- Sidebar Starts -->
<div class="pmd-sidebar-overlay"></div>

<!-- Left sidebar -->
<aside class="pmd-sidebar sidebar-default pmd-sidebar-slide-push pmd-sidebar-left pmd-sidebar-open bg-fill-darkblue sidebar-with-icons" role="navigation">
    <section class="sidebar">
        <?php
        $items = [
            [
                'label' => 'Dashboard',
                'icon' => 'dashboard',
                'icon-class' => 'media-left media-middle material-icons',
                'url' => '/admin',
                'linkOptions' => [
                    'class' => 'pmd-ripple-effect',
                ],

            ],
            [
                'label' => 'User',
                'icon' => 'extension',
                'badge' => '4',
                'url' => 'javascript:void(0)',
                'icon-class' => 'media-left media-middle material-icons',
                'linkOptions' => [
                    'aria-expanded' => 'false',
                    'class' => 'btn-user dropdown-toggle media',
                    'data-toggle' => "dropdown",
                    'data-sidebar' => "true",
                ],
                'items' => [
                    [
                        'label' => 'All User',
                        'url' => '/admin/user/admin',
                        'linkOptions' => [
                            'aria-expanded' => 'false',
                            'class' => 'btn-user dropdown-toggle media',
                            'data-toggle' => "dropdown",
                            'data-sidebar' => "true",
                        ],
                    ],
                    [
                        'label' => 'Permission',
                        'url' => '/admin/users/permission',
                        'linkOptions' => [
                            'aria-expanded' => 'false',
                            'class' => 'btn-user dropdown-toggle media',
                            'data-toggle' => "dropdown",
                            'data-sidebar' => "true",
                        ],
                    ],
                    [
                        'label' => 'Route',
                        'url' => '/admin/users/route',
                        'linkOptions' => [
                            'aria-expanded' => 'false',
                            'class' => 'btn-user dropdown-toggle media',
                            'data-toggle' => "dropdown",
                            'data-sidebar' => "true",
                        ],
                    ],
                    [
                        'label' => 'Rules',
                        'url' => '/admin/users/rule',
                        'linkOptions' => [
                            'aria-expanded' => 'false',
                            'class' => 'btn-user dropdown-toggle media',
                            'data-toggle' => "dropdown",
                            'data-sidebar' => "true",
                        ],
                    ],
                    [
                        'label' => 'Assignments',
                        'url' => '/admin/users/assignment',
                        'linkOptions' => [
                            'aria-expanded' => 'false',
                            'class' => 'btn-user dropdown-toggle media',
                            'data-toggle' => "dropdown",
                            'data-sidebar' => "true",
                        ],
                    ],
                    [
                        'label' => 'Role',
                        'url' => '/admin/users/role
                        ',
                        'linkOptions' => [
                            'aria-expanded' => 'false',
                            'class' => 'btn-user dropdown-toggle media',
                            'data-toggle' => "dropdown",
                            'data-sidebar' => "true",
                        ],
                    ],
                ],
            ],
            [
                'label' => 'Settings',
                'icon' => 'settings',
                'icon-class' => 'media-left media-middle material-icons',
                'url' => '/admin/settings',
                'linkOptions' => [
                    'class' => 'pmd-ripple-effect',
                ],

            ],
            [
                'label' => 'Menu',
                'icon' => 'menu',
                'icon-class' => 'media-left media-middle material-icons',
                'url' => '/admin/users/menu',
                'linkOptions' => [
                    'class' => 'pmd-ripple-effect',
                ],

            ],
        ];

        echo SideNav::widget([
                'items' => $items,
                'options' => ['class' =>'nav pmd-sidebar-nav'],
        ]);
        ?>
    </section>
</aside><!-- End Left sidebar -->
<!-- Sidebar Ends -->


<aside class="main-sidebar">


</aside>