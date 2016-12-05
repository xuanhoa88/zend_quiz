<?php

class Admin_Controller extends Lumia_Controller_Action
{
    /**
     * Initialize object
     *
     * Called from {@link __construct()} as final step of object instantiation.
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        
        // Redirect to login page if end-user never logged
        if (!$this->view->userSession()->isLogged()) 
        {
            $this->_redirect('/admin/session/logout');
        }
        
        // Forward to error page if not pass condition
        if (!$this->_helper->userPermission()->hasPermission())
        {
        	$this->redirect('admin/access-denied/');
        }
    }
}
