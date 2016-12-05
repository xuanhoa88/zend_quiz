<?php

class Application_View_Helper_UserSession extends Lumia_View_Helper_UserSession
{
	
	/**
	 * Are you teacher?
	 * 
	 * @return boolean
	 */
	public function isTeacher()
	{
		return $this->isLogged() && ($this->_userSession->user_role === Application_Const::ROLE_CODE_TEACHER);
	}
	
	/**
	 * Are you student?
	 * 
	 * @return boolean
	 */
	public function isStudent()
	{
		return $this->isLogged() && ($this->_userSession->user_role === Application_Const::ROLE_CODE_STUDENT);
	}
}
