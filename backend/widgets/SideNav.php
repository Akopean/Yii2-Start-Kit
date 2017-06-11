<?php
namespace backend\widgets;

use backend\assets\PropellerAsset;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
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
 *             'badge' => '4',
 *             'badgeColor' => 'red',
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
class SideNav extends Widget
{
    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: boolean, optional, whether the item should be on active state or not.
     * - dropDownOptions: array, optional, the HTML options that will passed to the [[Dropdown]] widget.
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     */
    public $items = [];
    /**
     * @var boolean whether the nav items labels should be HTML-encoded.
     */
    public $encodeLabels = false;

    /**
     * @var string the route used to determine if a menu item is active or not.
     * If not set, it will use the route of the current request.
     * @see params
     * @see isItemActive
     */
    public $route;
    /**
     * @var array the parameters used to determine if a menu item is active or not.
     * If not set, it will use `$_GET`.
     * @see route
     * @see isItemActive
     */
    public $params;
    /**
     * @var string this property allows you to customize the HTML which is used to generate the drop down caret symbol,
     * which is displayed next to the button text to indicate the drop down functionality.
     * Defaults to `null` which means `<i class="fa fa-angle-left pull-right"></i>` will be used. To disable the caret, set this property to be an empty string.
     */
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

        //Html::addCssClass($this->options, ['widget' => '']);
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
    public function renderItems($items, $options, $child = false)
    {
        $lines = [];
        foreach ($items as $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            $lines[] = $this->renderItem($item);

        }
        if(!$child){
            $lines = $this->addUser($lines);
        }
        else {
            $options['class'] = 'dropdown-menu';
        }
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
            throw new InvalidConfigException("The 'label' option is required.");
        }

        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = ArrayHelper::getValue($item, 'label', '');
        if ($encodeLabel) {
            $label = Html::encode($label);
        }

        $icon = ArrayHelper::getValue($item, 'icon');
        $icon_class = ArrayHelper::getValue($item, 'icon-class');
        if ($icon && $icon_class) {
            $label =   '<i class="' . $icon_class . '">' .$icon . '</i><span class="media-body">' . $label . '</span>';
        }

        $badge = ArrayHelper::getValue($item, 'badge');
        if (!empty($badge)) {
            $label .= ' ' . Html::tag('div', Html::tag('i',$badge, ['class' => 'dic-more-vert dic"']), ['class' => 'media-right media-bottom']);
        }

        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);


        if ($items !== null) {
            Html::addCssClass($options, ['widget' => 'dropdown pmd-dropdown']);
            if ($this->treeviewCaret !== '') {
                $label .= ' ' . $this->treeviewCaret;
            }
            if (is_array($items)) {
                    if($this->isChildActive($items)){
                        Html::addCssClass($options, 'open');
                    }
                $items = $this->renderItems($items, $options, true);
            }
        }

        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }
    /**
     * Check to see if a child item is active optionally activating the parent.
     * @param array $items
     * @return bool
     */
    protected function isChildActive($items)
    {

       foreach ($items as $i ) {
           if ( mb_strrpos ($i['url'], Yii::$app->controller->action->controller->uniqueId)) {
             return true;
           }
        }
        return false;
    }

    /**
     * @param $lines
     * @return array
     */
    protected function addUser($lines) {
       array_unshift($lines , '        
        <!-- User info -->
        <li class="dropdown pmd-dropdown pmd-user-info visible-xs visible-md visible-sm visible-lg">
            <a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true" aria-expandedhref="javascript:void(0);">
                <div class="media-left">
                    <img src="/admin/themes/images/user-icon.png" alt="New User">
                </div>
                <div class="media-body media-middle">Propeller Admin</div>
                <div class="media-right media-middle"><i class="dic-more-vert dic"></i></div>
            </a>
            <ul class="dropdown-menu">
                <li><a href="login.html">Logout</a></li>
            </ul>
        </li><!-- End user info -->
       ');

       return $lines;
    }
}
