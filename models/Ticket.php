<?php

namespace App\Models;

/**
 * Class Ticket.
 */
class Ticket
{
    /**
     * ID of the comment.
     *
     * @var integer
     */
    private $id;

    /**
     * Text of the comment.
     *
     * @var string
     */
    private $subject;

    /**
     * Text of the comment.
     *
     * @var string
     */
    private $text;

    /**
     * Ticket creation date.
     *
     * @var string
     */
    private $writingDate;

    /**
     * Ticket last update date.
     *
     * @var string
     */
    private $lastUpdateDate;

    /**
     * Ticket Author.
     *
     * @var Member
     */
    private $author;

    /**
     * bool onto the state of the ticket => Resolved or not
     */
    private $isResolved;

    /**
     * Ticket constructor.
     * @param int $id
     * @param string $subject
     * @param string $text
     * @param Member $author
     * @param string $writingDate
     * @param string $lastUpdateDate
     */
    public function __construct(int $id, string $subject, string $text, Member $author, string $writingDate, string $lastUpdateDate, bool $isResolved)
    {
        $this->id = $id;
        $this->subject = $subject;
        $this->text = $text;
        $this->writingDate = $writingDate;
        $this->author = $author;
        $this->lastUpdateDate = $lastUpdateDate;
        $this->isResolved = $isResolved;
    }

    /**
     * Getter of the ID of the ticket.
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter of the text of the ticket.
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Getter of isResolved
     *
     * @return bool
     */
    public function getIsResolved(): bool
    {
        return $this->isResolved;
    }

    /**
     * Setter of isResolved
     */
    public function setIsResolved(): bool
    {
        $this->isResolved = true;
    }

    /**
     * Subject Setter of a ticket.
     *
     * @param string $text
     *
     * @return self
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Subject getter of a ticket.
     *
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Setter of the text of the ticket.
     *
     * @param string $text
     *
     * @return self
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Getter of the writing date of the ticket.
     *
     * @return string
     */
    public function getWritingDate(): string
    {
        return $this->writingDate;
    }

    /**
     * Setter of the writing date of the ticket.
     *
     * @return self
     */
    public function setWritingDate(): self
    {
        $this->writingDate = date("Y-m-d H:i:s");
        return $this;
    }

    /**
     * Getter of the last update date of the ticket.
     *
     * @return string
     */
    public function getLastUpdateDate(): string
    {
        return $this->lastUpdateDate;
    }

    /**
     * Setter of the last update date of the ticket.
     *
     * @return self
     */
    public function setLastUpdateDate(): self
    {
        $this->lastUpdateDate = date("Y-m-d H:i:s");
        return $this;
    }


    /**
     * getter of the author of the ticket.
     *
     * @return Member
     */
    public function getAuthor(): Member
    {
        return $this->author;
    }

    /**
     * Setter of the author of the ticket.
     *
     * @param Member $author
     *
     * @return self
     */
    public function setAuthor(Member $author): self
    {
        $this->author = $author;
        return $this;
    }
}