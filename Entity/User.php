<?php

namespace IgniteYourProject\ApiAuthenticationBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * User constructor.
     * @param string $name
     * @param string $apiKey
     */
    public function __construct($name, $apiKey)
    {
        $this->name = $name;
        $this->apiKey = $apiKey;
    }


    public function getUsername()
    {
        return $this->name;
    }

    public function getRoles()
    {
        return ['ROLE_API'];
    }

    public function validApiKey($apiKey)
    {
        return $this->apiKey === $apiKey;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

}