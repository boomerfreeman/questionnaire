<?php

/**
 * Error page controller
 */
class Notfound extends Page
{
    public function __construct($language, $body)
    {
        $error_page = new Page($language, $body);
        $error_page->show();
    }
}
