<?php

namespace humanized\translation\widgets\grid;

use Yii;
use humanized\translation\models\LanguageSearch;
use humanized\translation\helpers\CallbackHelper;
use humanized\translation\helpers\TemplateHelper;
use humanized\translation\widgets\grid\assets\GridViewAsset;

/**
 * Translation Gridview Widget - By Humanized
 * 
 * Provides an administration widget for managing yii-2 site translation languages
 *   
 * 
 * @name Yii2 TranslationGridView Widget Class
 * @author Jeffrey Geyssens <jeffrey@humanized.be>
 * @package yii2-translation
 * @version 0.1
 * @since 0.1 
 */
class GridView extends \yii\grid\GridView
{
    /*
     * -------------------------------------------------------------------------
     *                      Widget Configuration Parameters
     * ------------------------------------------------------------------------
     */

    public $tableOptions = ['class' => 'table table-bordered'];

    /**
     * 
     * @var string The template used for composing grid column visibility and sort order.
     * Tokens enclosed within curly brackets are treated as column names.
     * Following default column names are supported:
     * <table>
     * <tr><td>{id}</td><td>The iso-639-1 language code (see also https://en.wikipedia.org/wiki/ISO_639)</td></tr>
     * <tr><td>{status}</td><td>-1 if disabled, 0 if enabled, 1 if default and enabled.</td></tr>
     * <tr><td>{source}</td><td>The language display name in source (or native) language</td></tr>
     * <tr><td>{translation}</td><td>The language display name in current application language</td></tr>
     * <tr><td>{action}</td><td>Action column (defaults to the ActionColumn provided by the translation package)</td></tr>
     * </table> 
     * @default '{id}{status}{source}{translation}{action}'
     */
    public $template = '{id}{status}{source}{translation}{action}';

    /**
     * 
     * @var string The message category for label interface translations
     * @default 'app' 
     */
    public $category = 'app';

    /**
     *
     * @var array 
     */
    public $columnOptions = [];

    /**
     *
     * @var boolean -
     * @default false  
     */
    public $enableRegionalLocales = false;

    /**
     *
     * @var array<string> - null
     * @default null  
     */
    public $customAvailableLocales = null;

    /**
     *
     * @var array<string> - null
     * @default null  
     */
    public $customRegionalLocales = null;

    /**
     *
     * @var array array containing gridview column template entries (without curly brackets)  
     */
    private $_template = [];

    /*
     * -------------------------------------------------------------------------
     *               Overwritten Widget Initialisation Methods
     * ------------------------------------------------------------------------
     */

    /**
     * @inheritdoc
     */
    public function init()
    {
        $config = $this->_initConfig();
        //Setup dataprovider
        $this->dataProvider = (new LanguageSearch())->search($config);

        if (empty($this->rowOptions)) {
            $this->rowOptions = function($model, $key, $index, $grid) {
                return ['class' => ($model['status'] == -1 ? 'danger' : ($model['status'] == 1 ? 'info' : 'active'))];
            };
        }

        //Parse widget template configuration string in to an array
        $this->_template = TemplateHelper::explode($this->template);
        //Run parent Gridview initialisation invokes overwritten initColumns method
        parent::init();
    }

    private function _initConfig()
    {
        $config = [];
        if ($this->enableRegionalLocales) {
            $config['enableRegionalLocales'] = true;
        }
        if (isset($this->customAvailableLocales) && !empty($this->customAvailableLocales)) {
            $config['customAvailableLocales '] = $this->customAvailableLocales;
        }
        if (isset($this->customPrimaryLocales) && !empty($this->customPrimaryLocales)) {
            $config['customPrimaryLocales '] = $this->customPrimaryLocales;
        }
        return $config;
    }

    /**
     * @inheritdoc
     */
    protected function initColumns()
    {

        foreach ($this->_template as $column) {
            if ($column != 'action') {
                $this->setupDataColumn($column);
            }
            if ($column == 'action') {
                $this->setupActionColumn();
            }
        }
        parent::initColumns();
    }

    /*
     * -------------------------------------------------------------------------
     *              Protected Gridview Column Intialisation Methods
     * ------------------------------------------------------------------------
     */

    /**
     * 
     * @param string $column The column name
     * 
     * Setup & add single GridView data column
     * 
     * Individual column default options can be specified through the columnOptions configuration array. 
     * 
     * If no columnOptions are explicitly set for the column,   
     * 
     *  
     */
    protected function setupDataColumn($column)
    {
        $label = isset($this->columnOptions[$column]['label']) ? $this->columnOptions[$column]['label'] : $column;
        $value = isset($this->columnOptions[$column]['value']) ? $this->columnOptions[$column]['value'] : [new CallbackHelper, $column . 'ColumnFn'];
        $this->columns[] = ['attribute' => $label, 'label' => Yii::t($this->category, $label), 'value' => $value];
    }

    /**
     * 
     */
    protected function setupActionColumn()
    {
        if (!isset($this->columnOptions['action'])) {
            $this->columnOptions['action'] = [];
        }
        if (!isset($this->columnOptions['action']['class'])) {
            $this->columnOptions['action']['class'] = ActionColumn::className();
            //$this->columnOptions['action']['label'] = 'Status';
            $this->columnOptions['action']['header'] = 'status';
        }
        $this->columns[] = $this->columnOptions['action'];
    }
    
    

    public function run()
    {
        parent::run();
        if (\Yii::$app->request->isPjax) {
            return;
        }
        GridViewAsset::register($this->view);
    }

}
