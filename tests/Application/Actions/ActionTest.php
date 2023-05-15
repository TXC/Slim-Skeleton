<?php

declare(strict_types=1);

namespace App\Tests\Application\Actions;

use App\Application\Actions\Action;
use TXC\Box\Action\ActionPayload;
use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface as Response;

class ActionTest extends \App\Tests\WebTestCase
{
    public function testActionSetsHttpCodeInRespond()
    {
        $testAction = new class ($this->getContainer()) extends Action {
            public function action(): Response
            {
                return $this->respond(
                    new ActionPayload(
                        202,
                        [
                            'willBeDoneAt' => (new DateTimeImmutable())->format(\DateTimeInterface::ATOM)
                        ]
                    )
                );
            }
        };

        $app = $this->getApplication();
        $app->get('/test-action-response-code', $testAction);
        $request = $this->createRequest('GET', '/test-action-response-code');
        $response = $app->handle($request);

        $this->assertEquals(202, $response->getStatusCode());
    }

    public function testActionSetsHttpCodeRespondData()
    {
        $testAction = new class ($this->getContainer()) extends Action {
            public function action(): Response
            {
                return $this->respondWithData(
                    [
                        'willBeDoneAt' => (new DateTimeImmutable())->format(DateTimeImmutable::ATOM)
                    ],
                    202
                );
            }
        };

        $app = $this->getApplication();
        $app->get('/test-action-response-code', $testAction);
        $request = $this->createRequest('GET', '/test-action-response-code');
        $response = $app->handle($request);

        $this->assertEquals(202, $response->getStatusCode());
    }
}
