<?php

/**
 * Home page controller
 */
class Home_Controller extends Page_Controller
{
    public function __construct($language, $body)
    {
        parent::__construct();
        
        $question = new Question_Model();
        
        if (isset($_POST['question'])) {
            $question->save(htmlspecialchars($_POST['question']));
        }
        
        $parameters = $this->setHomePageParameters($question);
        $this->setHomePageProperties($language, $body, $parameters);
        
        $this->show();
    }
    
    /**
     * Set the data that goes from the model to the view
     * @param Question_Model $question
     * @return array
     */
    public function setHomePageParameters(Question_Model $question): array
    {
        $parameters['question_list'] = $question->showList();
        return $parameters;
    }
    
    /**
     * Set page language, view and parameters for Home page
     * @param string $language
     * @param string $body
     * @param array $parameters
     */
    public function setHomePageProperties(string $language, string $body, array $parameters): void
    {
        $this->setPageLanguage($language);
        $this->setPageBody($body);
        $this->setPageParameters($parameters);
    }
}
