<?php

namespace Models;

use Models\Recipe;

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
     * Email of the member.
     *
     * @var string
     */
    private $email;

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
     * Recipes writed by the member.
     *
     * @var array
     */
    private $writtenRecipes;

    /**
     * Favorite recipes of the member.
     *
     * @var array
     */
    private $favoriteRecipes;

    /**
     * Constructor of the Member class.
     *
     * @param string $name Name to set to the member.
     * @param string $firstname Firstname to set to the member.
     * @param string $email Email to set to the member.
     * @param string $password Password to set to the member.
     * @param string $type Type to set to the member.
     */
    public function __construct(string $name, string $firstname, string $email, string $password, string $type)
    {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
        $this->creationDate = date("Y-m-d h:i:s");
        $this->getLastConnectionDate = null;
        $this->type = $type;
        $this->isConfirmed = false;
        $this->writtenRecipes = [];
        $this->favoriteRecipes = [];
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
     * Getter of the email of the member.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Setter of the email of the member.
     *
     * @param string $email Email to set to the member.
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
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

    /**
     * Getter of the written recipes of the member.
     *
     * @return array
     */
    public function getWrittenRecipes(): array
    {
        return $this->writtenRecipes;
    }

    /**
     * Add a written recipe to the member.
     *
     * @param Recipe $writtenRecipe Written recipe to add to the member.
     * 
     * @return array
     */
    public function addWrittenRecipe(Recipe $writtenRecipe): array
    {
        array_push($this->writtenRecipes, $writtenRecipe);
        return $this->writtenRecipes;
    }

    /**
     * Remove a written recipe from the member.
     *
     * @param Recipe $writtenRecipe Written recipe to remove from the member.
     * 
     * @return array
     */
    public function removeWrittenRecipe(Recipe $writtenRecipe): array
    {
        if (in_array($writtenRecipe, $this->writtenRecipes)) {
            unset($writtenRecipe);
            return array_values($this->writtenRecipes);
        } else {
            return $this->writtenRecipes;
        }
    }

    /**
     * Getter of the favorite recipes of the member.
     *
     * @return array
     */
    public function getFavoriteRecipes(): array
    {
        return $this->favoriteRecipes;
    }

    /**
     * Add a favorite recipe to the member.
     *
     * @param Recipe $favoriteRecipe Favorite recipe to add to the member.
     * 
     * @return array
     */
    public function addFavoriteRecipe(Recipe $favoriteRecipe): array
    {
        array_push($this->favoriteRecipes, $favoriteRecipe);
        return $this->favoriteRecipes;
    }

    /**
     * Remove a favorite recipe from the member.
     *
     * @param Recipe $favoriteRecipe Favorite recipe to remove from the member.
     * 
     * @return array
     */
    public function removeFavoriteRecipe(Recipe $favoriteRecipe): array
    {
        if (in_array($favoriteRecipe, $this->favoriteRecipes)) {
            unset($favoriteRecipe);
            return array_values($this->favoriteRecipes);
        } else {
            return $this->favoriteRecipes;
        }
    }
}