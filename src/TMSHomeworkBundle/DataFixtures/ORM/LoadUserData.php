<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 04/08/17
 * Time: 12:17
 */

namespace TMSHomeworkBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use TMSHomeworkBundle\Entity\User;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    private $usernames = [
        'testuser1',
        'testuser2',
        'testuser3'
    ];

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->usernames as $username) {
            $user = new User();
            $user->setUsername($username);
            $user->setEmail($this->createEmail($user));
            $this->setUserPassword($user, $user->getUsername());
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }

    public function createEmail(User $user)
    {
        return strtolower($user->getUsername() . '@tmshomework.com');
    }

    public function setUserPassword(User $user, $password)
    {
        $passwordEncoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $encodedPassword = $passwordEncoder->encodePassword($password, $user->getSalt());

        $user->setPassword($password);
    }

}