<?php

namespace humanized\translation\widgets;

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
    const MODE_CUSTOM = 100;

    /*
     * -------------------------------------------------------------------------
     *                      Custom Widget Parameters
     * ------------------------------------------------------------------------
     */

    /**
     * LanguageSelect widget display mode.
     * Supported values:
     * 
     * <table>
     * <tr><td><strong>Numerical Value</strong></td><td><strong>Constant Value</strong></td><td><strong>Description</strong></td></tr>
     * <tr><td>1</td><td>LanguageSelect::MODE_INLINE</td><td>Displays enabled language selection using an inline-list</td></tr>
     * <tr><td>2</td><td>LanguageSelect::MODE_SELECT</td><td>Displays enabled languages selection using an dropdown-list</td></tr>
     * <tr><td>100</td><td>LanguageSelect::MODE_CUSTOM</td><td>Roll your own function to display language selection. Requires specification of widget parameter fnCustom, a function callback</td></tr>
     * </table>
     * 
     * @var integer 
     */
    public $mode = self::INLINE;

    /**
     * 
     * Only useful when widget display mode is set LanguageSelect::MODE_INLINE (or 1)
     * @var string 
     */
    public $seperator = ' ';

    /**
     *
     * @var type 
     */
    public $fnLabel = NULL;
    public $fnCustom = NULL;

    public function run()
    {

        $fn = NULL;
        $out = NULL;
        switch ($this->displayMode) {
            case self::MODE_INLINE: {
                    break;
                };
            case self::MODE_SELECT: {
                    break;
                };
            case self::MODE_CUSTOM && !isset($this->fnCustom) && gettype($this->fnCustom) != 'function' : {
                    $fn = $this->fnCustom;
                    break;
                };
        }


        return $out;
    }

    private function _getUrls()
    {
        $route = \Yii::$app->controller->route;
        $urls = [];
        foreach (Language::enabled() as $language) {
            $locale = $language->id;
            if (strtolower(Language::current()) != strtolower($locale)) {
                $urls[] = Html::a($language->id, ["/$route", 'language' => $locale]);
            }
        }
        return $urls;
    }

}
