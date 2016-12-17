<?php

/**
 * Home page controller
 */
class Home extends Page
{
    public function __construct($language, $body)
    {
        parent::__construct();

        $this->question = new Question();

        // Save question
        if (isset($_POST['question']) && ! empty($_POST['question'])) {
            $this->question->save(htmlspecialchars($_POST['question'])) ? $this->showMessage('success', 'Your question has been sent for review') : null;
        } elseif (isset($_POST['question']) && empty($_POST['question'])) {
            $this->showMessage('danger', 'Nothing to ask');
        }

        // Rate question
        if (isset($_POST['rate'])) $this->question->rate($_POST['rate']);

        // Load more questions
        if (isset($_GET['loadmore'])) $this->question->loadMore($_GET['from'], $_GET['to']);
        
        $parameters = $this->setHomePageParameters();
        $this->setHomePageProperties($language, $body, $parameters);
        
        $this->show();
    }

    public function index()
    {

    }

    public function add()
    {

    }

    public function view()
    {

    }
    
    /**
     * Set the data that goes from the model to the view
     * @param Question_Model $question
     * @return array
     */
    public function setHomePageParameters()
    {
        $parameters['questionList'] = $this->question->showList();
        return $parameters;
    }
    
    /**
     * Set page language, view and parameters for Home page
     * @param string $language
     * @param string $body
     * @param array $parameters
     */
    public function setHomePageProperties($language, $body, $parameters)
    {
        $this->setPageLanguage($language);
        $this->setPageBody($body);
        $this->setPageParameters($parameters);
    }
}
