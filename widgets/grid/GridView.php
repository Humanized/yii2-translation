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

    /**
     * 
     * @var string The template used for composing grid column visibility and sort order.
     * Tokens enclosed within curly brackets are treated as column names.
     * Following default column names are supported:
     * <table>
     * <tr><td>{code}</td><td>The iso-639-1 language code (see also https://en.wikipedia.org/wiki/ISO_639)</td></tr>
     * <tr><td>{default}</td><td>Flag for displaying if language is the default application language</td></tr>
     * <tr><td>{source}</td><td>The language display name in source (or native) language</td></tr>
     * <tr><td>{translation}</td><td>The language display name in current application language</td></tr>
     * <tr><td>{action}</td><td>Action column (defaults to the ActionColumn provided by the translation package)</td></tr>
     * </table> 
     * @default '{code}{default}{source}{translation}{action}'
     */
    public $template = '{code}{default}{source}{translation}{action}';

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
        //Setup dataprovider
        $this->dataProvider = (new LanguageSearch())->search([]);
        //Parse widget template configuration string in to an array
        $this->_template = TemplateHelper::explode($this->template);
        //Run parent Gridview initialisation invokes overwritten initColumns method
        parent::init();
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
        $this->columns[] = ['label' => Yii::t($this->category, $label), 'value' => $value];
    }

    /**
     * 
     */
    protected function setupActionColumn()
    {
        GridViewAsset::register($this->view);
        if (!isset($this->columnOptions['action'])) {
            $this->columnOptions['action'] = [];
        }
        if (!isset($this->columnOptions['action']['class'])) {
            $this->columnOptions['action']['class'] = ActionColumn::className();
        }
        $this->columns[] = $this->columnOptions['action'];
    }

}