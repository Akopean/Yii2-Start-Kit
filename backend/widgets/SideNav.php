<?php
namespace backend\widgets;

use backend\assets\PropellerAsset;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 */
class SideNav extends Widget
{
    public $submenuTemplate = "\n<ul>\n{items}\n</ul>\n";

    public $activateParents = false;

    public $activateItems = true;

    public $items = [];

    public $encodeLabels = false;

    public $route;

    public $params;

    public $treeviewCaret;

    /**
     * @var nav-tab to get tab-styled navigation
     */
    public $options;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
    }
    /**
     * Renders the widget.
     */
    public function run()
    {
        PropellerAsset::register($this->getView());

        return $this->renderItems($this->items, $this->options);
    }

    /**
     *  Renders widget items.
     * @param $items
     * @param $options
     * @param bool $child
     * @return string
     */
    public function renderItems($items, $options = [], $child = false)
    {
        $lines = [];
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            $lines[] = $this->renderItem($item);
        }

        if($child)
            $options['class'] = 'dropdown-menu';

        return Html::tag('ul', implode("\n", $lines), $options);
    }
    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label']) && !isset($item['icon']) && !isset($item['icon-class'])) {
            throw new InvalidConfigException("The 'label, icon, icon-class' option is required.");
        }

        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = ArrayHelper::getValue($item, 'label', '');
        if ($encodeLabel) {
            $label = Html::encode($label);
        }

        $icon = ArrayHelper::getValue($item, 'icon');
        $iconClass = ArrayHelper::getValue($item, 'iconClass');
        if ($icon && $iconClass) {
            $label =   '<i class="' . $iconClass . '">' .$icon . '</i><span class="media-body">' . $label . '</span>';
        }

        $badge = ArrayHelper::getValue($item, 'badge');
        if (!empty($badge)) {
            $label .= ' ' . Html::tag('div', Html::tag('i',$badge, ['class' => 'dic-more-vert dic"']), ['class' => 'media-right media-bottom']);
        }

        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        $url = ArrayHelper::getValue($item, 'url', '#');

        $url = (!isset($url) ? 'javascript:void(0)' : Yii::$app->request->baseUrl . $url);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);

        }

        if ($items !== null) {
            Html::addCssClass($options, ['widget' => 'dropdown pmd-dropdown']);
            if ($this->treeviewCaret !== '') {
                $label .= ' ' . $this->treeviewCaret;
            }
            if (is_array($items)) {
                if ($this->activateItems) {
                    $items = $this->isChildActive($items, $active);
                }
                $items = $this->renderItems($items, $options, true);
            }
        }
        if ($this->activateItems && $active) {

            Html::addCssClass($options, 'open');
        }

        return Html::tag('li', Html::a($label, Yii::$app->urlManager->createUrl($url), $linkOptions) . $items, $options);
    }

    /**
     * Check to see if a child item is active optionally activating the parent.
     * @param array $items @see items
     * @param boolean $active should the parent be active too
     * @return array @see items
     */
    protected function isChildActive($items, &$active)
    {
        foreach ($items as $i => $child) {
            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
                Html::addCssClass($options, 'open');
                Html::addCssClass($items[$i]['options'], 'open');
                if ($this->activateParents) {
                    $active = true;
                }
            }
        }
        return $items;
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {

        if (isset($item['url']) && isset($item['url'][0])) {
            $route = Yii::getAlias($item['url'][0]);

            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this->route) {
                return false;
            }
            unset($item['url']['#']);

            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }
}
