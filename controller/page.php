<?php

declare(strict_types=1);

/**
 * The common page controller decides which sub-controller and sub-model is going to be used
 */
class Page
{
    /**
     * The page common language
     * @var type string
     */
    private $language = null;
    
    /**
     * The page template
     * @var type string
     */
    private $body = null;
    
    /**
     * Page generation
     * @param type $language
     * @param type $body
     */
    public function __construct(string $language, string $body)
    {
        $this->setPageLanguage($language);
        $this->setPageBody($body);
    }
    
    /**
     * Create view for the defined page
     */
    public function show(): void
    {
        require 'view/tmpl/header.php';
        require 'view/' . $this->getPageBody() . '.php';
        require 'view/tmpl/footer.php';
    }
    
    /**
     * Get the current page language
     * @return string
     */
    public function getPageLanguage(): string
    {
        return $this->language;
    }
    
    /**
     * Get the current page template
     * @return string
     */
    public function getPageBody(): string
    {
        return $this->body;
    }
    
    /**
     * Set page language (from URL)
     * @param type $language
     */
    private function setPageLanguage(string $language)
    {
        $this->language = strlen($language) == 2 ? htmlspecialchars($language) : '';
    }
    
    /**
     * Set page template (from URL)
     * @param string $body
     */
    private function setPageBody(string $body)
    {
        $this->body = file_exists('view/' . $body . '.php') ? $body : '';
    }
}
