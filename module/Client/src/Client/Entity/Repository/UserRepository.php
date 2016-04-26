<?php
namespace Client\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function findByEmailAndPassword($username, $password)
    {
        $user = $this->findOneByUserUsername($username);

        if ($user) {
            if ($user->encryptPassword($password) == $user->getUserPassword() && $user->getUserStatus() == 1) {
                return $user;
            }
            return false;
        }
        return false;
    }

}