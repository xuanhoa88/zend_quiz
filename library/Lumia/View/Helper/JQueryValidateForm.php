<?php

/**
 * Lumia_View_Helper_JQueryValidateForm
 *
 * @category   Lumia
 * @package    Lumia_View_Helper
 */
class Lumia_View_Helper_JQueryValidateForm extends Zend_View_Helper_Abstract
{

    /**
     * Renders form validations for jqueryvalidation plugin (see http://jqueryvalidation.org/)
     *
     * @param Zend_Form $form
     *            the form for which a jqueryvalidation will be gerated and rendered
     * @param Array $options.
     *            Key => Value array. Keys supported:
     *            'showWarnings' => true/false (guess what... show warnings yes/no)
     *            'inject' => filename (File that holds additional jqueryvalidation options which will be rendered right after the messages section and before the rules section of the generated javascript code)
     */
    public function JQueryValidateForm(Zend_Form $form, array $options = null)
    {
        if (!Lumia_JQueryValidateForm::isEnabled())
        {
            return;
        }
        
        $formValidator = new Lumia_JQueryValidateForm($form);
        return $formValidator->render($this->view, $options);
    }
}