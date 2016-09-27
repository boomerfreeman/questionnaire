<?php

declare(strict_types=1);

/**
 * Model for question data processing
 */
class Question_Model extends Main_Model
{
    /**
     * Question text
     * @var type string
     */
    private $value;
    
    /**
     * Show the question list with predefined limit
     * @param int $from
     * @param int $to
     * @return array
     */
    public function showList(int $from = 0, int $to = 5): array
    {
        $query = $this->db->prepare("
            SELECT question_id AS id, question_text AS text, question_author AS author, question_rating AS rating 
            FROM questions 
            ORDER BY question_rating DESC 
            LIMIT :from, :to
        ");
        
        $query->execute(array(':from' => $from, ':to' => $to));
        
        return $query->fetchAll();
    }
    
    /**
     * Save question in the database
     * @return type string
     */
    public function save(string $text): bool
    {
        $this->setQuestionValue($text);
        
        $query = $this->db->prepare("INSERT INTO questions (question_text, question_author) VALUES (:text, :author)");
        $query->execute(array(':text' => $this->getQuestionValue(), ':author' => 'Test Author'));
        
        $last_id = (int) $this->db->lastInsertId();
        
        return $last_id ? true : false;
    }
    
    /**
     * Increment question rating by 1
     * @param int $questionID
     * @return bool
     */
    public function rate(string $questionID): bool
    {
        $id = is_numeric($questionID) ? htmlspecialchars($questionID) : 0;
        
        if (is_null($_SESSION['question'][$id]['rated'])) {
            $_SESSION['question'][$id]['rated'] = true;
            $query = $this->db->prepare("UPDATE questions SET question_rating = question_rating + 1 WHERE question_id = :id");
            $result = $query->execute(array(':id' => $id)) ? true : false;
        } else {
            $result = false;
        }
        
        return $result;
    }
    
    /**
     * Remove question from the database
     * @param type $id
     */
    public function remove(): void
    {
        $query = $this->db->prepare("DELETE FROM questions WHERE id = :id");
        $query->execute(array(':id' => $this->getQuestionValue()));
    }
    
    /**
     * Get current question value
     * @return string
     */
    public function getQuestionValue(): string
    {
        return $this->value;
    }
    
    /**
     * Set current question value
     * @param string $text
     */
    private function setQuestionValue(string $text): void
    {
        $this->value = is_string($text) ? $text : null;
    }
}
