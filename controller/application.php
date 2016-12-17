<?php

/**
 * Application controller + some kind of router
 */
class Application
{
    /**
     * Start application
     */
    public function start()
    {
        $url = $this->splitURL();
        $this->setAppParams($url);
        $this->setUserSession();
        $this->createAppPage();
    }
    
    /**
     * Split URL into the parts
     * @return array
     */
    private function splitURL()
    {
        return explode('/', filter_var(trim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
    }
    
    /**
     * Set the application language and controller parameters
     * @param array $url
     */
    private function setAppParams($url)
    {
        // TODO: use list() function
        $lang = $url[0];
        $ctrl = isset($url[1]) && ! empty($url[1]) ? $url[1] : 'home';
        
        $this->language = file_exists(APP . 'assets/lang/' . $lang . '.php') ? $lang : 'en';
        $this->controller = file_exists(APP . 'controller/' . $ctrl . '.php') && ! preg_match('/error|page/i', $ctrl) ? $ctrl : 'error';
    }
    
    private function setUserSession()
    {
        session_start();
    }
    
    /**
     * Create the defined page controller
     */
    private function createAppPage()
    {
        $page_controller = $this->controller;
        new $page_controller($this->language, $this->controller);
    }
}
