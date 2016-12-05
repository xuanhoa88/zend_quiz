<?php

class Admin_SettingController extends Admin_Controller
{

    /**
     * Proxy to general action
     */
    public function indexAction()
    {
        $this->_forward('general');
    }

    /**
     * General setting
     */
    public function generalAction()
    {
        // Init model
        $configurationModel = Application_Model_Configuration::getInstance();
        
        // Init form
        $form = new Admin_Form_Setting_General();
        
        // Validate when submit form
        if ($this->getRequest()->isPost())
        {
            if ($form->isValid($this->getRequest()->getPost()))
            {
                $formValues = $form->getValues();
		        foreach (array_keys($formValues) as $_key)
		        {
		            $configurationModel->set($_key, $formValues[$_key]);
		        }
		        
		        $this->_helper->messenger('success')->addMessage($this->view->translate('Message:@The configuration has been successfully updated'));
		        
		        // Redirect
		        $this->redirect('/admin/setting/general');
            }
        } else
        {
            $form->populate($configurationModel->fetchPairs());
        }
        
        $this->view->form = $form;
    }
}