<?php

declare(strict_types=1);

/**
 * The common page controller
 */
class Page
{
    /**
     * Page controller
     * @var type string
     */
    private $controller = null;
    
    /**
     * Page language
     * @var type string
     */
    private $language = null;
    
    /**
     * Create new page
     */
    public function create()
    {
        $url = $this->splitURL();
        $this->setParameters($url);
        $this->createController();
        $this->createView();
    }
    
    /**
     * Get current language of the page
     * @return string
     */
    public function getLanguage(): string
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
    private function setParameters(array $url)
    {
        $lang = $url[0];
        $controller = $url[1] ?? 'home';
        
        $this->language = file_exists('assets/lang/' . $lang . '.php') ? $lang : 'en';
        $this->controller = file_exists('controller/' . $controller . '.php') && ! preg_match('/notfound|page/i', $controller) ? $controller : 'notfound';
    }
    
    /**
     * Create the defined page controller
     */
    private function createController()
    {
        new $this->controller();
    }
    
    /**
     * Create view for the defined page
     */
    private function createView()
    {
        require 'view/tmpl/header.php';
        require 'view/' . $this->controller . '.php';
        require 'view/tmpl/footer.php';
    }
}
