<?php

class Lumia_Model_User_Permission extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Lumia_Db_Table_User_Permission');
	}

	/**
	 * Arrange navigation according to user
	 * 
	 * @param	array $navBar
	 * @param	int $userId
	 * @return	bool
	 */
	public function rearrangeNavbar(array $navBar, $userId)
	{
		// Left nav from session
		if ($navigation = Lumia_Auth::getInstance()->getNavigation())
		{
			$navigationGrouped = array();
			foreach ($navigation as $j => $item)
			{
				$navigationGrouped[$item['navigation_id']] = $item;
			}
				
			$navigation = $navigationGrouped;
			unset($navigationGrouped);
		
			$navigation = array_intersect_key($navigation, $navBar);
		
			foreach ($navigation as &$item)
			{
				$item = array_merge($item, $navBar[$item['navigation_id']]);
			}
			
			// Sorting
			usort($navigation, function ($a, $b)
        	{
        		if ($a['navigation_left'] == $b['navigation_left']) 
        		{
        			return 0;
        		}
        			
        		return ($a['navigation_left'] < $b['navigation_left']) ? -1 : 1;
        	});
		
			Lumia_Auth::getInstance()->setNavigation($navigation);
		}
		
		$userPermissions = $this->getByUser($userId);
		if (empty($userPermissions->permission_user))
		{
			return $this->insert(array(
				'permission_left_navigation' => Zend_Json::encode($navBar),
				'permission_user' => $userId
			));
		}
		
		return $this->update(array(
			'permission_left_navigation' => Zend_Json::encode($navBar)
		), array(
			'permission_user = ?' => $userId
		));
	}
	
	/**
	 * Collect privileges
	 * 
	 * @param	array $privileges
	 * @param	int $userId
	 * @return	void
	 */
	public function collectPrivileges(array $privileges, $userId)
	{
		// Cast to string
		$userId = (int) $userId;
		if ($userId > 0)
		{
			// Delete permission according to user id
			$this->delete(array('permission_user = ?' => $userId));
			
			// Insert new
			if ($privileges = Lumia_Model_Permission::filter($privileges))
			{
				$this->insert(array(
					'permission_user' => $userId,
					'permission_resource' => Zend_Json::encode($privileges)
				));
			}
		}
	}
}
