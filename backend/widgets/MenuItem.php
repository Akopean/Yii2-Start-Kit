<?php
namespace backend\widgets;

use backend\assets\PropellerAsset;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

/**
 * Nav renders a nav HTML component.
 *
 * For example:
 *
 * ```php
 * echo Nav::widget([
 *     'items' => [
 *         [
 *             'label' => 'Home',
 *             'url' => ['site/index'],
 *             'linkOptions' => [...],
 *         ],
 *         [
 *             'label' => '',
 *             'icon' => 'envelope-o',
 *             'badge' => ['type'=>'success','value'=>4],
 *             'items' => [
 *                  ['label' => 'You have 4 messages', 'options' => ['class'=>'header']],
 *                  '<li class="divider"></li>',
 *                  '<li class="dropdown-header">Dropdown Header</li>',
 *                  ['label' => 'See all messages', 'url' => ['/mail/inbox'], 'options' => ['class'=>'footer']],
 *             ],
 *         ],
 *         [
 *             'label' => 'Login',
 *             'url' => ['site/login'],
 *             'visible' => Yii::$app->user->isGuest
 *         ],
 *     ],
 *     'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
 * ]);
 * ```
 *
 * Note: Multilevel dropdowns beyond Level 1 are not supported in Bootstrap 3.
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class MenuItem extends Widget
{

    public $menuItem;

    /**
     * Renders the widget.
     */
    public function run()
    {
        return $this->renderItems($this->menuItem);
    }

    /**
     * Renders widget items.
     */
    public function renderItems($items)
    {
        $lines = [];
        foreach ($items as $item) {
            $lines[] = $this->renderItem($item);
        }
        return Html::tag('ol', implode("\n", $lines), ['class' => 'dd-list']);
    }

    /**
     * @param $item
     * @return string
     */
    public function renderItem($item)
    {
        $name = ArrayHelper::getValue($item, 'name');
        $id =  ArrayHelper::getValue($item, 'id');
        $url = ArrayHelper::getValue($item, 'url', '');

        $icon = Html::tag(
            'i',
            'delete_sweep',
            ['class' => "material-icons pmd-grid-icon"]
        );
        $btn = Html::tag(
            'div',
            $icon . Yii::t('backend', 'Delete') ,
            [
                'class' => "btn-sm btn-danger pull-right delete grid-button pmd-btn-raised pmd-ripple-effect",
                'data-id' => $id
            ]
        );
        $action = Html::tag(
            'div',
            $btn ,
            ['class' => "pull-right item_actions"]
        );
        $handle = Html::tag(
            'div',
            '<span>' . $name . '</span><small class="url">' . $url .'</small>',
            ['class' => "dd-handle"]
        );

        $items =  $item->getChildren()->all();
        if ($items !== null) {
            if (is_array($items)) {
                $items = $this->renderItems($items);
            }
        }
        return Html::tag('li', $action . $handle . $items, ['class' => "dd-item", 'data-id' => $id]);
    }
}