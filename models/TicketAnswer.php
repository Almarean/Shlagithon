<?php

namespace App\Models;

/**
 * Class Ticket.
 */
class TicketAnswer
{
    /**
     * ID of the TicketAnswer.
     *
     * @var integer
     */
    private $id;

    /**
     * Text of the TicketAnswer.
     *
     * @var string
     */
    private $text;

    /**
     * TicketAnswer creation date.
     *
     * @var string
     */
    private $writingDate;

    /**
     * Ticket.
     *
     * @var Ticket
     */
    private $ticket;

    /**
     * TicketAnswer Author.
     *
     * @var Member
     */
    private $author;


    /**
     * TicketAnswer constructor.
     *
     * @param int $id
     * @param string $text
     * @param Ticket $ticket
     * @param string $writingDate
     * @param Member $author
     */
    public function __construct(int $id, string $text, Ticket $ticket, string $writingDate, Member $author)
    {
        $this->id = $id;
        $this->text = $text;
        $this->writingDate = $writingDate;
        $this->ticket = $ticket;
        $this->author = $author;
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
     * getter of the author of the ticket.
     *
     * @return Ticket
     */
    public function getTicket(): Ticket
    {
        return $this->ticket;
    }

    /**
     * Setter of the Ticket of the TicketAnwser.
     *
     * @param Ticket $ticket
     *
     * @return self
     */
    public function setTicket(Ticket $ticket): self
    {
        $this->ticket = $ticket;
        return $this;
    }

    /**
     * getter of the author of the ticketAnswer.
     *
     * @return Member
     */
    public function getAuthor(): Member
    {
        return $this->author;
    }

    /**
     * Setter of the author of the ticketAnswer.
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