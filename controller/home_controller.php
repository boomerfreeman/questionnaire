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
        
        $parameters['question_list'] = $question->showList();
        
        $this->setPageLanguage($language);
        $this->setPageBody($body);
        $this->setPageParameters($parameters);
        
        $this->show();
    }
}
