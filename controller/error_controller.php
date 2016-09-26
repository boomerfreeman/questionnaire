<?php

/**
 * Error page controller
 */
class Error_Controller extends Page_Controller
{
    public function __construct($language, $body)
    {
        parent::__construct();
        $this->setErrorPageProperties($language, $body, array());
        $this->show();
    }
    
    public function setErrorPageProperties(string $language, string $body, array $parameters): void
    {
        header("HTTP/1.0 404 Not Found");
        $this->setPageLanguage($language);
        $this->setPageBody($body);
        $this->setPageParameters($parameters);
    }
}
