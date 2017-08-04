<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 03/08/17
 * Time: 21:31
 */

namespace TMSHomeworkBundle\EventListener;


use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class RedirectAfterRegistrationSubscriber implements EventSubscriberInterface
{

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * RedirectAfterRegistrationSubscriber constructor.
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * On successful registration redirect to homepage
     *
     * @param FormEvent $event
     */
    public function onRegistrationSuccess(FormEvent $event)
    {
        $url = $this->router->generate('tms_homework_homepage');
        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        ];
    }
}