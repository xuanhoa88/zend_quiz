<?php 

class Lumia_View_Helper_BaseUrl extends Zend_View_Helper_BaseUrl
{
    /**
     * Returns site's base url, or file with base url prepended
     *
     * $file is appended to the base url for simplicity
     *
     * @param  string|null $file
     * @return string
     */
    public function baseUrl($file = null)
    {
        // Get baseUrl
        $url = $this->getBaseUrl();
    
        // Remove trailing slashes
        if (null !== $file) {
            $url .= '/' . ltrim($file, '/\\');
        }
        
//         if (Lumia_Auth::getInstance()->isLogged())
//         {
//             return Lumia_Utility_Common::buildUrl($url, array('query' => 'token=' . Lumia_Auth::getInstance()->getToken()), HTTP_URL_JOIN_QUERY);
//         }
        
        return $url;
    }
}