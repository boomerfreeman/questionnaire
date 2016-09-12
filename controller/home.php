<?php

/**
 * Home page controller
 */
class Home extends Page
{
    public function __construct($language, $body)
    {
        $home_page = new Page($language, $body);
        $home_page->show();
    }
}
