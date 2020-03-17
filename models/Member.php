<?php

namespace App\Models;

use App\Models\Recipe;
use App\Services\MemberManager;

/**
 * Class Member.
 */
class Member
{
    /**
     * ID of the member.
     *
     * @var integer|null
     */
    private $id;

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
     * @param int    $id
     * @param string $name
     * @param string $firstname
     * @param string $email
     * @param string $password
     * @param string $type
     */
    public function __construct(int $id, string $name, string $firstname, string $email, string $password, string $type = "MEMBER")
    {
        $this->id = $id;
        $this->name = ucwords($name);
        $this->firstname = ucwords($firstname);
        $this->email = $email;
        $this->password = md5($password);
        $this->creationDate = date("Y-m-d h:i:s");
        $this->lastConnectionDate = null;
        $this->type = $type;
        $this->isConfirmed = false;
        $this->writtenRecipes = [];
        $this->favoriteRecipes = [];
    }

    /**
     * Getter of the ID.
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = ucwords($name);
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
     * @param string $firstname
     *
     * @return self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = ucwords($firstname);
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
     * @param string $email
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
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = md5($password);
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
     * @param string $type
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
     * @param boolean $isConfirmed
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
     * Setter of the creation date of the member.
     *
     * @param string $creationDate
     *
     * @return self
     */
    public function setCreationDate(string $creationDate): self
    {
        $this->creationDate = $creationDate;
        return $this;
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
     * @param string $lastConnectionDate
     *
     * @return self
     */
    public function setLastConnectionDate(string $lastConnectionDate): self
    {
        $this->lastConnectionDate = $lastConnectionDate;
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
     * Setter of the written recipes of the member.
     *
     * @param array $writtenRecipes
     *
     * @return $this
     */
    public function setWrittenRecipes(array $writtenRecipes): self
    {
        $this->writtenRecipes = $writtenRecipes;
        return $this;
    }

    /**
     * Add a written recipe to the member.
     *
     * @param Recipe $writtenRecipe
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
     * @param Recipe $writtenRecipe
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
     * Setter of the favorite recipes of the member.
     *
     * @param array $favoriteRecipes
     *
     * @return $this
     */
    public function setFavoriteRecipes(array $favoriteRecipes): self
    {
        $this->favoriteRecipes = $favoriteRecipes;
        return $this;
    }

    /**
     * Add a favorite recipe to the member.
     *
     * @param Recipe $favoriteRecipe
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
     * @param Recipe $favoriteRecipe
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