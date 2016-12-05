<?php 

class Lumia_View_Helper_Url extends Zend_View_Helper_Url
{
    /**
     * Generates an url given the name of a route.
     *
     * @access public
     *
     * @param  array $urlOptions Options passed to the assemble method of the Route object.
     * @param  mixed $name The name of a Route to use. If null it will use the current Route
     * @param  bool $reset Whether or not to reset the route defaults with those provided
     * @return string Url for the link href attribute.
     */
    public function url(array $urlOptions = array(), $name = null, $reset = false, $encode = true)
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $url = $router->assemble($urlOptions, $name, $reset, $encode);
        
//         if (Lumia_Auth::getInstance()->isLogged())
//         {
//             return Lumia_Utility_Common::buildUrl($url, array('query' => 'token=' . Lumia_Auth::getInstance()->getToken()), HTTP_URL_JOIN_QUERY);
//         }
        
        return $url;
    }
}