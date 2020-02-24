<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;

/*use Psr\Log\LoggerInterface; */

class FinishRequestListener
{
    public function onKernelFinishRequest(FinishRequestEvent $event /*, LoggerInterface $logger */)
    {
        $file_name = "test_file_on_finish_request.txt";

        if(!is_file($file_name)) {
            $fileResource = fopen($file_name, "w");
            fclose($fileResource);
        }

        file_put_contents($file_name, "Finished_request ". date("d/m/Y H:i"). "\n", FILE_APPEND);
    }
}