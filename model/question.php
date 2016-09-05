<?php

declare(strict_types=1);

/**
 * Model for questions from users
 */
class Question extends Model
{
    /**
     * Question text
     * @var type string
     */
    private $value;
    
    public function __construct(string $text): void
    {
        parent::__construct();
        $this->setQuestion($text);
    }
    
    /**
     * Save question in the database
     * @return type string
     */
    public function save(): int
    {
        $query = $this->db->prepare("INSERT INTO questions (question) VALUES (:question)");
        $query->execute(array(':question' => $this->getQuestion()));
        
        return (int) $this->db->lastInsertId();
    }
    
    /**
     * Remove question from the database
     * @param type $id
     */
    public function remove(): void
    {
        $query = $this->db->prepare("DELETE FROM questions WHERE id = :id");
        $query->execute(array(':id' => $this->getQuestion()));
    }
    
    /**
     * Get current question value
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->value;
    }
    
    /**
     * Set current question value
     * @param string $text
     */
    private function setQuestion(string $text): void
    {
        $this->value = $text;
    }
}
