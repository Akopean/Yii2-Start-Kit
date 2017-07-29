<?php

use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\web\View;
use backend\widgets\menu\SideNav;
/* @var $this View */

$items  = [
    [
        'label' => Yii::t('backend', 'Dashboard'),
        'icon' => 'dashboard',
        'iconClass' => 'media-left media-middle material-icons',
        'visible' => Helper::checkRoute('/'),
        'url' => '/',
        'linkOptions' => [
            'class' => 'pmd-ripple-effect',
        ],

    ],
    [
        'label' => Yii::t('backend', 'Roles'),
        'icon' => 'extension',
        'badge' => '5',
        'visible' =>
            Helper::checkRoute('/user/permission/index') ||
            Helper::checkRoute('/user/route/index') ||
            Helper::checkRoute('/user/role/index') ||
            Helper::checkRoute('/user/assignment/index') ||
            Helper::checkRoute('/user/route/index'),
        'iconClass' => 'media-left media-middle material-icons',
        'linkOptions' => [
            'aria-expanded' => 'false',
            'class' => 'btn-user dropdown-toggle media',
            'data-toggle' => "dropdown",
            'data-sidebar' => "true",
        ],
        'active' => in_array(Yii::$app->request->pathInfo, [
            'user/permission/index',
            'user/route/index',
            'user/rule/index',
            'user/assignment/index',
            'user/role/index',
        ]),
        'items' => [
            [
                'label' => Yii::t('backend', 'Permission'),
                'url' => '/user/permission/index',
                'visible' => Helper::checkRoute('/user/permission/index'),
                'linkOptions' => [
                    'aria-expanded' => 'false',
                    'class' => 'btn-user dropdown-toggle media',
                    'data-toggle' => "dropdown",
                    'data-sidebar' => "true",
                ],
            ],
            [
                'label' => Yii::t('backend', 'Route'),
                'url' => '/user/route/index',
                'visible' => Helper::checkRoute('/user/route/index'),
                'linkOptions' => [
                    'aria-expanded' => 'false',
                    'class' => 'btn-user dropdown-toggle media',
                    'data-toggle' => "dropdown",
                    'data-sidebar' => "true",
                ],
            ],
            [
                'label' => Yii::t('backend', 'Rules'),
                'url' => '/user/rule/index',
                'visible' => Helper::checkRoute('/user/role/index'),
                'linkOptions' => [
                    'aria-expanded' => 'false',
                    'class' => 'btn-user dropdown-toggle media',
                    'data-toggle' => "dropdown",
                    'data-sidebar' => "true",
                ],
            ],
            [
                'label' => Yii::t('backend', 'Assignments'),
                'url' => '/user/assignment/index',
                'visible' => Helper::checkRoute('/user/assignment/index'),
                'linkOptions' => [
                    'aria-expanded' => 'false',
                    'class' => 'btn-user dropdown-toggle media',
                    'data-toggle' => "dropdown",
                    'data-sidebar' => "true",
                ],
            ],
            [
                'label' => Yii::t('backend', 'Role'),
                'url' => '/user/role/index',
                'visible' => Helper::checkRoute('/user/role/index'),
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
        'label' => Yii::t('backend', 'User'),
        'url' => '/user/user/index',
        'icon' => 'person',
        'visible' => Helper::checkRoute('/user/user'),
        'iconClass' => 'media-left media-middle material-icons',
        'linkOptions' => [
            'class' => 'pmd-ripple-effect',
        ],
    ],
    [
        'label' => Yii::t('backend', 'Pages'),
        'icon' => 'content_copy',
        'badge' => '2',
        'visible' =>
            Helper::checkRoute('/page/index') ||
            Helper::checkRoute('/landing-page/index'),
        'iconClass' => 'media-left media-middle material-icons',
        'linkOptions' => [
            'aria-expanded' => 'false',
            'class' => 'btn-user dropdown-toggle media',
            'data-toggle' => "dropdown",
            'data-sidebar' => "true",
        ],
        'active' => in_array(Yii::$app->request->pathInfo, [
            'page/index',
            'landing-page/index',
        ]),
        'items' => [
            [
                'label' => Yii::t('backend', 'Static Page'),
                'url' => '/page/index',
                'visible' => Helper::checkRoute('/page/index'),
                'linkOptions' => [
                    'aria-expanded' => 'false',
                    'class' => 'btn-user dropdown-toggle media',
                    'data-toggle' => "dropdown",
                    'data-sidebar' => "true",
                ],
            ],
            [
                'label' => Yii::t('backend', 'Langing Page'),
                'url' => '/landing-page/index',
                'visible' => Helper::checkRoute('/landing-page/index'),
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
        'label' => Yii::t('backend', 'Menu'),
        'icon' => 'menu',
        'visible' => Helper::checkRoute('/menu/index'),
        'iconClass' => 'media-left media-middle material-icons',
        'url' => 'menu',
        'linkOptions' => [
            'class' => 'pmd-ripple-effect',
        ],

    ],
    [
        'label' => Yii::t('backend', 'File Manager'),
        'icon' => 'attach_file',
        'badge' => '2',
        'visible' =>
            Helper::checkRoute('/filemanager/file/index') ||
            Helper::checkRoute('/filemanager/default/settings'),
        'iconClass' => 'media-left media-middle material-icons',
        'linkOptions' => [
            'aria-expanded' => 'false',
            'class' => 'btn-user dropdown-toggle media',
            'data-toggle' => "dropdown",
            'data-sidebar' => "true",
        ],
        'active' => in_array(Yii::$app->request->pathInfo, [
            'filemanager/file/index',
            'filemanager/default/settings',
        ]),
        'items' => [
            [
                'label' => Yii::t('backend', 'Files'),
                'url' => '/filemanager/file/index',
                'visible' => Helper::checkRoute('/filemanager/file/index'),
                'linkOptions' => [
                    'aria-expanded' => 'false',
                    'class' => 'btn-user dropdown-toggle media',
                    'data-toggle' => "dropdown",
                    'data-sidebar' => "true",
                ],
            ],
            [
                'label' => Yii::t('backend', 'Settings'),
                'url' => '/filemanager/default/settings',
                'visible' => Helper::checkRoute('/filemanager/default/settings'),
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
        'label' => Yii::t('backend', 'Settings'),
        'icon' => 'settings',
        'visible' => Helper::checkRoute('/settings/index'),
        'iconClass' => 'media-left media-middle material-icons',
        'url' => '/settings',
        'linkOptions' => [
            'class' => 'pmd-ripple-effect',
        ],

    ],
];
?>
<!-- Sidebar Starts -->
<div class="pmd-sidebar-overlay"></div>

<!-- Left sidebar -->
<aside class="pmd-sidebar sidebar-default pmd-sidebar-slide-push pmd-sidebar-left pmd-sidebar-open bg-fill-darkblue sidebar-with-icons" role="navigation">
    <section class="sidebar">
        <ul class="nav pmd-sidebar-nav">
            <!-- User info -->
            <li class="dropdown pmd-dropdown pmd-user-info visible-xs visible-md visible-sm visible-lg">
                <a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true">
                    <div class="media-left">
                        <img src="/themes/images/user-icon.png" alt="New User">
                    </div>
                    <div class="media-body media-middle">Propeller <?= ucfirst(Yii::$app->user->identity->username)?></div>
                    <div class="media-right media-middle"><i class="dic-more-vert dic"></i></div>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <form action="<?= Yii::$app->urlManager->createUrl('logout') ?>" method="post">
                           <?=Html::hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []) ?>
                            <button type="submit" class="btn pmd-ripple-effect btn-link color-white">Logout</button>
                        </form>
                    </li>
                </ul>
            </li><!-- End user info -->
        </ul>

        <?= SideNav::widget([
            'encodeLabels' => false,
            'activateParents' => true,
            'submenuTemplate' => '<div class="pmd-dropdown-menu-container"><div class="pmd-dropdown-menu-bg"></div><ul class="dropdown-menu">{items}</ul></div>',
            'items' => $items,
            'options' => ['class' => 'nav pmd-sidebar-nav', 'id' => 'menu']]) ?>
    </section>
</aside><!-- End Left sidebar -->
<!-- Sidebar Ends -->