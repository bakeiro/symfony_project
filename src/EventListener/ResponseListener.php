<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Psr\Log\LoggerInterface;

class ResponseListener
{
    private $log;

    public function __construct(LoggerInterface $logger)
    {
        $this->log = $logger;
    }

    public function onKernelResponse(ResponseEvent  $event)
    {
        $this->log->info("Response finished ". date("d/m/Y H:i"). "\n");
    }
}
