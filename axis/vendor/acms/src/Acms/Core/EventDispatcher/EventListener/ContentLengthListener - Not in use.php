<?php
namespace Acms\Core\EventDispatcher\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Acms\Core\EventDispatcher\Event\ResponseEvent;

class ContentLengthListener implements EventSubscriberInterface
{
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
    }

	public static function getSubscribedEvents()
	{
		return array('response' => array('onResponse', -255));
	}
}