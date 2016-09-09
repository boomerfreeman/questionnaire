<?php

class Application
{
    /**
     * Page controller
     * @var type string
     */
    private $controller = null;
    
    /**
     * Application language
     * @var type string
     */
    private $language = null;
    
    public function start()
    {
        $url = $this->splitURL();
        $this->setAppParams($url);
        $this->createController();
        $this->createView();
    }
    
    /**
     * Get current language of the page
     * @return string
     */
    public function getAppLang(): string
    {
        return $this->language;
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
     * Set language and controller parameters for the page
     * @param array $url
     */
    private function setAppParams(array $url): void
    {
        // TODO: use list() function
        $lang = $url[0];
        $controller = $url[1] ?? 'home';
        
        $this->setAppLang(file_exists('assets/lang/' . $lang . '.php') ? $lang : 'en');
        $this->controller = file_exists('controller/' . $controller . '.php') && ! preg_match('/notfound|page/i', $controller) ? $controller : 'notfound';
    }
    
    /**
     * Create the defined page controller
     */
    private function createController(): void
    {
        new $this->controller();
    }
    
    private function setAppLang(string $lang): string
    {
        return strlen($lang) == 2 ? $lang : '';
    }
}
