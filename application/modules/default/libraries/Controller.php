<?php

class Default_Controller extends Lumia_Controller_Action
{
    /**
     * Initialize object
     * Called from {@link __construct()} as final step of object instantiation.
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        
        // Logout if user is not student
        if (!$this->view->studentSession()->hasStudent()) 
        {
            $this->_redirect('/session/logout');
        }
    }
}
