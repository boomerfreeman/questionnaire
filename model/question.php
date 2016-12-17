<?php

/**
 * Model for question data processing
 */
class Question extends Main
{
    /**
     * Question text
     * @var null
     */
    private $value = null;

    /**
     * Question theme
     * @var null
     */
    private $theme = null;

    /**
     * Question list of themes
     * @var array
     */
    public $themeList = array(
        'life' => 'Life',
        'school' => 'School',
        'uncategorized' => 'Without category'
    );

    /**
     * Default question theme
     * @var string
     */
    public $defaultTheme = 'uncategorized';

    /**
     * Question constructor
     * @param null $value
     * @param null $theme
     */
    public function __construct($value = null, $theme = null)
    {
        parent::__construct();

        $this->setValue($value);
        $this->setTheme($theme);
    }

    /**
     * TODO:
     * Get current question value
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * TODO:
     * Get question theme
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }
    
    /**
     * Show the question list with predefined limit
     * @param int $from
     * @param int $to
     * @return array
     */
    public function showList($from = 0, $to = 5)
    {
        $query = $this->db->prepare("
            SELECT question_id AS id, question_text AS text, question_author AS author, question_rating AS rating 
            FROM question 
            ORDER BY question_rating DESC 
            LIMIT :from, :to
        ");
        
        $query->execute(array(':from' => $from, ':to' => $to));
        return $query->fetchAll();
    }

    /**
     * Load questions using AJAX and convert them to JSON format
     * @param $from
     * @param $to
     */
    public function loadMore($from, $to)
    {
        $from = is_numeric($from) ? htmlspecialchars($from) : 0;
        $to = is_numeric($to) ? htmlspecialchars($to) : 5;

        echo json_encode($this->showList($from, $to));
        exit;
    }

    /**
     * Save question in the database
     * @param null $text
     * @param null $theme
     * @return int
     */
    public function save($text = null, $theme = null)
    {
        $this->setValue($text);
        $this->setTheme($theme);
        
        $query = $this->db->prepare("INSERT INTO question (question_text, question_author) VALUES (:text, :author)");
        $query->execute(array(':text' => $this->getValue(), ':author' => 'Test Author'));
        
        $last_id = (int) $this->db->lastInsertId();
        return $last_id ? true : false;
    }

    /**
     * Try to increment question rating by 1, otherwise decline
     * @param $questionID
     */
    public function rate($questionID)
    {
        $id = is_numeric($questionID) ? htmlspecialchars($questionID) : 0;
        
        if ( ! isset($_SESSION['question'][$id]['rated'])) {
            $_SESSION['question'][$id]['rated'] = true;
            $query = $this->db->prepare("UPDATE question SET question_rating = question_rating + 1 WHERE question_id = :id");
            $status = $query->execute(array(':id' => $id)) ? true : false;
        } else {
            $status = false;
        }

        echo json_encode(array('result' => $status));
        exit;
    }

    /**
     * TODO:
     * Remove question from the database
     */
    public function remove()
    {
        $query = $this->db->prepare("DELETE FROM question WHERE id = :id");
        $query->execute(array(':id' => $this->getValue()));
    }

    /**
     * Set current question value
     * @param string $text
     */
    private function setValue($text)
    {
        $this->value = is_string($text) ? $text : null;
    }

    /**
     * Set default or specific question theme
     * @param $theme
     */
    private function setTheme($theme)
    {
        $this->theme = key_exists($theme, $this->themeList) ? $this->themeList[$theme] : $this->defaultTheme;
    }
}
