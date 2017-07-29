<?php
/**
 * Created by PhpStorm.
 * User: Agasi
 * Date: 24.07.2017
 * Time: 18:10
 */
namespace backend\widgets\field;

use yii\base\Widget;

class FormFieldWidget extends Widget {

    public $model = null;

    // Action Name
    public $_c = '';

    //Controller Name
    public $_m = '';

    protected $action = '';

    public $fields = [];
    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->action = '/' . $this->_c . (!empty($this->_m)) ? '/' . $this->_m : '';
        parent::init();
    }
    /**
     * Renders the widget.
     */
    public function run()
    {
        return $this->render('field', ['model' => $this->model, 'fields' => $this->fields, 'action' => $this->action, '_c' => $this->_c, '_m' => $this->_m]);
    }
}