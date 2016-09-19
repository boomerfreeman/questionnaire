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
    private function splitURL(): array
    {
        return explode('/', filter_var(trim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
    }
    
    /**
     * Set the application language and controller parameters
     * @param array $url
     */
    private function setAppParams(array $url): void
    {
        // TODO: use list() function
        $lang = $url[0];
        $ctrl = $url[1] ?? 'home';
        
        $this->language = file_exists(APP . 'assets/lang/' . $lang . '.php') ? $lang : 'en';
        $this->controller = file_exists(APP . 'controller/' . $ctrl . '_controller.php') && ! preg_match('/error|page/i', $ctrl) ? $ctrl : 'error';
    }
    
    private function setUserSession(): void
    {
        session_start();
    }
    
    /**
     * Create the defined page controller
     */
    private function createAppPage(): void
    {
        $page_controller = $this->controller . '_controller';
        new $page_controller($this->language, $this->controller);
    }
}
