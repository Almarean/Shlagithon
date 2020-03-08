<?php

/**
 * Class Member.
 */
class Member
{
    /**
     * Name of the member.
     *
     * @var string
     */
    private $name;

    /**
     * Firstname of the member.
     *
     * @var string
     */
    private $firstname;

    /**
     * Login of the member.
     *
     * @var string
     */
    private $login;

    /**
     * Password of the member.
     *
     * @var string
     */
    private $password;

    /**
     * Type of the member, he can be a simple member or an administrator.
     * Represented by an ENUM type in database.
     *
     * @var string
     */
    private $type;

    /**
     * State of confirmation of the member.
     *
     * @var bool
     */
    private $isConfirmed;

    /**
     * Creation date of the member.
     *
     * @var string
     */
    private $creationDate;

    /**
     * Last connection date of the member.
     *
     * @var string
     */
    private $lastConnectionDate;

    /**
     * Constructor of the member class.
     *
     * @param string $name Name to set to the member.
     * @param string $firstname Firstname to set to the member.
     * @param string $login Login to set to the member.
     * @param string $password Password to set to the member.
     * @param string $type Type to set to the member.
     */
    public function __construct(string $name, string $firstname, string $login, string $password, string $type)
    {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->login = $login;
        $this->password = $password;
        $this->creationDate = date("Y-m-d h:i:s");
        $this->type = $type;
        $this->isConfirmed = false;

    }

    /**
     * Getter of the name of the member.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Setter of the of the member.
     *
     * @param string $name Name to set to the member.
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Getter of the firstname of the member.
     *
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Setter of the firstname of the member.
     *
     * @param string $firstname Firstname to set to the member.
     *
     * @return self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Getter of the login of the member.
     *
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Setter of the login of the member.
     *
     * @param string $login Login to set to the member.
     *
     * @return self
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    /**
     * Getter of the password of the member.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Setter of the password of the member.
     *
     * @param string $password Password to set to the member.
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Getter of the type of the member.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Setter of the type of the member.
     *
     * @param string $type Type to set to the member.
     *
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Getter of the state of confirmaion of the member.
     *
     * @return boolean
     */
    public function getIsConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    /**
     * Setter of the state of confirmation of the member.
     *
     * @param boolean $isConfirmed State of confirmation to set to the member.
     *
     * @return self
     */
    public function setIsConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }

    /**
     * Getter of the creation date of the member.
     *
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    /**
     * Getter of the last connection date of the member.
     *
     * @return string|null
     */
    public function getLastConnectionDate(): ?string
    {
        return $this->lastConnectionDate;
    }

    /**
     * Setter of the last connection date of the member.
     *
     * @return self
     */
    public function setLastConnectionDate(): self
    {
        $this->lastConnectionDate = date("Y-m-d h:i:s");
        return $this;
    }
}