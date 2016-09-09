<?php

declare(strict_types=1);

/**
 * The common page controller decides which sub-controller and sub-model is going to be used
 * TODO: createView
 */
class Page
{
    /**
     * Create view for the defined page
     */
    private function createView($page): void
    {
        require 'view/tmpl/header.php';
        require 'view/' . $page . '.php';
        require 'view/tmpl/footer.php';
    }
}
