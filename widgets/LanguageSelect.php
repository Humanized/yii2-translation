<?php

namespace humanized\translation\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use humanized\translation\models\Language;

/**
 * LanguageSelect Widget - By Humanized
 * 
 * @name Yii2 LanguageSelect Widget Class
 * @author Jeffrey Geyssens <jeffrey@humanized.be>
 * @package yii2-translation
 * @version 0.1
 * @since 0.1 
 */
class LanguageSelect extends Widget
{
    /*
     * -------------------------------------------------------------------------
     *                          Class Constants
     * ------------------------------------------------------------------------
     */

    //Widget displays enabled languages either through inline (default) or select list

    const MODE_INLINE = 1;
    const MODE_SELECT = 2;
    const MODE_DROPDOWN = 3;
    const MODE_BUTTON = 4;
    const MODE_CUSTOM = 100;

    /*
     * -------------------------------------------------------------------------
     *                      Custom Widget Parameters
     * ------------------------------------------------------------------------
     */

    /**
     * LanguageSelect widget display mode.
     * 
     * 
     * @var integer Valid configuration values:

     * <table>
     * <tr><td><b>Numerical </b></td><td><b>Constant Shortcut </b></td><td><b>Description</b></td></tr>
     * <tr><td>1</td><td>LanguageSelect::MODE_INLINE</td><td>Displays enabled language selection using an inline-list</td></tr>
     * <tr><td>2</td><td>LanguageSelect::MODE_SELECT</td><td>Displays enabled languages selection using an dropdown-list</td></tr>
     * <tr><td>3</td><td>LanguageSelect::MODE_DROPDOWN</td><td>Displays enabled languages selection using a bootstrap dropdown-list</td></tr>
     * <tr><td>4</td><td>LanguageSelect::MODE_BUTTON</td><td>Displays enabled languages selection using a bootstrap buttondropdown-list</td></tr>
     * <tr><td>100</td><td>LanguageSelect::MODE_CUSTOM</td><td>Roll your own function to display language selection. Requires specification of widget parameter fnCustom, a function callback</td></tr>
     * </table>
     */
    public $mode = self::MODE_INLINE;

    /**
     * @var string Text-based separator for language options - Only useful when widget display mode is set LanguageSelect::MODE_INLINE (or 1)
     */
    public $separator = ' ';

    /**
     *
     * @var array<mixed> Additional dropdown configuration options (see http://www.yiiframework.com/doc-2.0/yii-bootstrap-buttondropdown.html)  Only useful when widget display mode is set LanguageSelect::MODE_DROPDOWN (or 3)
     */
    public $dropdownConfig = [];

    /**
     *
     * @var array<mixed> Additional button dropdown configuration options (see http://www.yiiframework.com/doc-2.0/yii-bootstrap-buttondropdown.html)  Only useful when widget display mode is set LanguageSelect::MODE_BUTTON (or 4)
     */
    public $buttonConfig = [];

    /**
     *
     * @var type 
     */
    public $fnLabel = NULL;
    public $fnCustom = NULL;

    public function run()
    {
        $out = '';
        switch ($this->mode) {
            case self::MODE_INLINE: {
                    $out = implode($this->separator, Language::enabled($this->_getOutputFn()));
                    break;
                }
            case self::MODE_DROPDOWN || self::MODE_BUTTON: {
                    $this->_getBtsOutput($out);
                    break;
                }
        }
        return $out;
    }

    private function _getBtsOutput(&$out)
    {
        //Common preprocessing for obtaining current locale label
        $currentLocale = Yii::$app->language;
        $fnLabel = $this->fnLabel;
        $currentLocaleLabel = isset($fnLabel) ? $fnLabel($currentLocale) : $currentLocale;

        //Generate list of hyperlink items
        $itemList = ['items' => Language::enabled($this->_getOutputFn())];
        if ($this->mode == self::MODE_BUTTON) {
            $itemList = ['dropdown' => $itemList];
        }
        //Build widget configuration options
        $label = $this->mode == self::MODE_BUTTON ? ['label' => $currentLocaleLabel] : [];
        $extraOptions = $this->mode == self::MODE_DROPDOWN ? $this->dropdownConfig : $this->buttonConfig;
        $config = array_merge($label, $itemList, $extraOptions);
        $class = $this->mode == self::MODE_DROPDOWN ? '\\yii\\bootstrap\\Dropdown' : '\\yii\\bootstrap\\ButtonDropdown';
        $out .= $class::widget($config);
        if ($this->mode == self::MODE_DROPDOWN) {
            $out = '<div class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">' . $currentLocaleLabel . ' <b class="caret"></b></a>' . $out . '</div>';
        }
    }

    private function _getOutputFn()
    {
        $fn = NULL;
        switch ($this->mode) {
            case self::MODE_INLINE: {
                    $this->_setupInlineFn($fn);

                    break;
                };
            case self::MODE_DROPDOWN || self::MODE_BUTTON: {
                    $this->_setupButtonFn($fn);
                    break;
                };
            case self::MODE_CUSTOM && !isset($this->fnCustom) && gettype($this->fnCustom) != 'function' : {
                    $fn = $this->fnCustom;
                    break;
                };
        }
        return $fn;
    }

    private function _setupInlineFn(&$fn)
    {
        $urlContainer = $this->_getUrls();
        $fnLabel = $this->fnLabel;
        $fn = function($locale) use ($urlContainer, $fnLabel) {
            return Html::a(isset($fnLabel) ? $fnLabel($locale) : $locale, $urlContainer[$locale]);
        };
    }

    private function _setupButtonFn(&$fn)
    {
        $urlContainer = $this->_getUrls();
        $fnLabel = $this->fnLabel;
        $fn = function($locale) use ($urlContainer, $fnLabel) {
            return ['label' => isset($fnLabel) ? $fnLabel($locale) : $locale, 'url' => $urlContainer[$locale]];
        };
    }

    private function _getUrls()
    {
        $route = \Yii::$app->controller->route;
        $urls = [];
        foreach (Language::enabled() as $locale) {
            $urls[$locale] = ["/$route", 'language' => $locale];
        }
        return $urls;
    }

}
