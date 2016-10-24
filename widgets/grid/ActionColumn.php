<?php

namespace humanized\translation\widgets\grid;

use humanized\translation\helpers\TemplateHelper;
use humanized\translation\helpers\CallbackHelper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActionColumn extends \yii\grid\ActionColumn
{

    /**
     * @var string  action button column template
     * 
     * Provides a template containing two buttons for following actions:
     * <ul>
     * <li>The update button serves to set the default application language</li>
     * <li>The delete button disables the language, i.e. removes the language
     * from database storage</li>   
     * </ul>
     * 
     * @default '{update}{delete}'
     */
    public $template = '{delete}';

    /**
     * Update Button Rendering Callback
     * 
     * @var function($url,$model,$key)  Function to return update button HTML code
     */
    public $updateButtonFn = null;

    /**
     * Delete Button Rendering Callback
     * 
     * @var function($url,$model,$key)  Function to return delete button HTML code
     */
    public $deleteButtonFn = null;

    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        foreach (TemplateHelper::explode($this->template) as $button) {
            $this->initDefaultButton($button);
        }
    }

    private function initDefaultButton($button)
    {
        if (!isset($this->buttons[$button])) {
            $buttonFn = $button . 'ButtonFn';
            if (!isset($this->$buttonFn)) {
                $this->$buttonFn = [new CallbackHelper, $buttonFn];
            }
            $this->buttons[$button] = $this->$buttonFn;
        }
    }

}
