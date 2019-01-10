<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Goulaheau\RestBundle\Entity\RestEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
 * @ORM\Table(name="user_user")
 */
class User extends RestEntity implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=180, unique=true)
     */
    protected $email;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    protected $roles = [];

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    protected $apiToken;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @return string
     *
     * @see UserInterface
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @return array
     *
     * @see UserInterface
     */
    public function getRoles()
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     *
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return string
     *
     * @see UserInterface
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     *
     * @return $this
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
