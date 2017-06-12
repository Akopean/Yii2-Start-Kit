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


        echo SideNav::widget([
                'items' => Yii::$app->params['sidebar_menu'],
                'options' => ['class' =>'nav pmd-sidebar-nav'],
        ]);
        ?>
    </section>
</aside><!-- End Left sidebar -->
<!-- Sidebar Ends -->


<aside class="main-sidebar">


</aside>