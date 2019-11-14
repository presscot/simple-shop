<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 13.11.19
 * Time: 14:02
 */

namespace App\Listeners;

use App\Entity\Product;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ProductSubscriber implements EventSubscriber
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function getSubscribedEvents()
    {
        return [
            'postPersist'
        ];
    }

    public function postPersist( LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();

        if($entity instanceof Product) {

            $swift = $this->mailer;

            $mail = (new \Swift_Message())
                ->setSubject("new ")
                ->setFrom("tokeneo@example.com")
                ->setTo("tokeneo@example.com")
                ->setBody("new Product: {$entity->getName()}");

            $swift->send($mail);
        }
    }
}