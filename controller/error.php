<?php

/**
 * Error page controller
 */
class Error extends Page
{
    public function __construct($language, $body)
    {
        parent::__construct();
        $this->setErrorPageProperties($language, $body, array());
        $this->show();
    }
    
    public function setErrorPageProperties($language, $body, array $parameters)
    {
        header("HTTP/1.0 404 Not Found");
        $this->setPageLanguage($language);
        $this->setPageBody($body);
        $this->setPageParameters($parameters);
    }
}
