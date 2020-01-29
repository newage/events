<?php

declare(strict_types=1);

namespace Event\Common\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\TextResponse;
use Laminas\Diagnostics\Result\FailureInterface;
use Laminas\Diagnostics\Runner\Runner;

class MetricsHandler implements RequestHandlerInterface
{
    private CONST PROMETHEUS_MESSAGE = 'api_http_event_%s{response="%s", message="%s", method="GET"}';

    /**
     * @var \SplObjectStorage
     */
    private $collection;

    public function __construct(\SplObjectStorage $collection)
    {
        $this->collection = $collection;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        /* Create Runner instance */
        $runner = new Runner();

        foreach ($this->collection as $checker) {
            $runner->addCheck($checker);
        }

        // Run all checks
        $results = $runner->run();

        $textString = 'api_http_event_metrics{response="Ok", message="" method="GET"}' . "\n";
        foreach ($this->collection as $checker) {
            $textString .= sprintf(
                    self::PROMETHEUS_MESSAGE,
                    $this->collection->getInfo(),
                    $results[$checker] instanceof FailureInterface ? 'Fail' : 'Ok',
                    $results[$checker]->getMessage()
                ) . "\n";
        }

        return new TextResponse($textString);
    }
}
