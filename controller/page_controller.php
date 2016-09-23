<?php

declare(strict_types=1);

/**
 * The common page controller decides which sub-controller and sub-model is going to be used
 */
class Page_Controller
{
    /**
     * The status of the page message
     * @var type string
     */
    public $message_status = null;
    
    /**
     * The text of the page message
     * @var type string
     */
    public $message = null;
    
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
     * The page parameters
     * @var type string
     */
    private $parameters = array();
    
    /**
     * Page generation
     * @param type $language
     * @param type $body
     */
    public function __construct() {}
    
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
     * Get the parameters of the current page
     * @return array
     */
    public function getPageParameters(): array
    {
        return $this->parameters;
    }
    
    /**
     * Set page language (from URL)
     * @param type $language
     */
    public function setPageLanguage(string $language)
    {
        $this->language = strlen($language) == 2 ? htmlspecialchars($language) : '';
    }
    
    /**
     * Set page template (from URL)
     * @param string $body
     */
    public function setPageBody(string $body)
    {
        $this->body = file_exists('view/' . $body . '.php') ? $body : '';
    }
    
    /**
     * Set the parameters for the current page
     * @return array
     */
    public function setPageParameters(array $parameters)
    {
        $this->parameters = $parameters;
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
     * Show a custom message on the page
     * @param string $status
     * @param string $text
     */
    public function showMessage(string $status, string $text)
    {
        $status_list = array('success', 'info', 'warning', 'danger');
        $this->message_status = in_array($status, $status_list) ? $status : false;
        $this->message = $text;
    }
}
