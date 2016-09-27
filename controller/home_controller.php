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
        
        if (isset($_POST['rate'])) {
            $this->rateQuestion($question);
        }
        
        if (isset($_GET['loadmore'])) {
            $this->loadMoreQuestions($question);
        }
        
        if (isset($_POST['question']) && ! empty($_POST['question'])) {
            $question->save(htmlspecialchars($_POST['question'])) ? $this->showMessage('success', 'Your question has been sent for review') : null;
        } elseif (isset($_POST['question']) && empty($_POST['question'])) {
            $this->showMessage('danger', 'Nothing to ask');
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
        $parameters['questionList'] = $question->showList();
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
    
    /**
     * Send request to the model
     * @param Question_Model $question
     */
    private function rateQuestion(Question_Model $question): void
    {
        echo json_encode(array('result' => $question->rate($_POST['rate'])));
        exit;
    }
    
    /**
     * Load questions using AJAX and convert them to JSON format
     * @param Question_Model $question
     */
    private function loadMoreQuestions(Question_Model $question): void
    {
        $from = is_numeric($_GET['from']) ? htmlspecialchars($_GET['from']) : 0;
        $to = is_numeric($_GET['to']) ? htmlspecialchars($_GET['to']) : 5;
        
        echo json_encode($question->showList($from, $to));
        exit;
    }
}
