<?php

namespace IgniteYourProject\ApiAuthenticationBundle\Security;

use IgniteYourProject\ApiAuthenticationBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface
{
    /**
     * @var User[]
     */
    private $users;

    /**
     * UserProvider constructor.
     * @param \IgniteYourProject\ApiAuthenticationBundle\Entity\User[] $users
     */
    public function __construct(array $users)
    {
        foreach ($users as $arrUser) {
            $this->users[] = new User($arrUser['name'], $arrUser['token']);
        }
    }

    /**
     * There is no Username this is the token!
     *
     * @param string $token
     * @return User
     */
    public function loadUserByUsername($token)
    {
        $user = $this->findUser($token);

        if ($user instanceof User) {
            return $user;
        }

        throw new UsernameNotFoundException(sprintf('Token "%s" does not exist.', $token));
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getToken());
    }

    public function supportsClass($class)
    {
        return $class === 'IgniteYourProject\ApiAuthenticationBundle\Security\Entity\User';
    }

    private function findUser($token)
    {
        foreach ($this->users as $user) {
            if ($user->validApiKey($token)) {
                return $user;
            }
        }

        return null;
    }
}
