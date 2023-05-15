<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use TXC\Box\Action\ActionPayload;
use TXC\Box\Attribute\Route\GroupRoute;
use TXC\Box\Attribute\Route\IsRoutable;
use TXC\Box\Attribute\Route\Route;
use App\Repository\UserRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

#[IsRoutable, GroupRoute(pattern: '/users')]
class UserHandler extends Action implements \TXC\Box\Interface\RestInterface
{
    private UserRepository $userRepository;

    public function __construct(ContainerInterface $container, UserRepository $userRepository)
    {
        parent::__construct($container);
        $this->userRepository = $userRepository;
    }

    #[Route(pattern: '', verb: Route::GET)]
    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $users = $this->userRepository->findAll();

        $this->logger->info("Users list was viewed.");

        return $this->respondWithData($users);
    }

    #[Route(pattern: '', verb: Route::POST)]
    public function store(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->respond(new ActionPayload(501));
    }

    #[Route(pattern: '/{entityId}', verb: Route::GET)]
    public function show(
        ServerRequestInterface $request,
        ResponseInterface $response,
        int $entityId
    ): ResponseInterface {
        $user = $this->userRepository->find($entityId);

        $this->logger->info('User of id `' . $entityId . '` was viewed.');

        return $this->respondWithData($user);
    }

    #[Route(pattern: '/{entityId}', verb: Route::PATCH)]
    public function update(
        ServerRequestInterface $request,
        ResponseInterface $response,
        int $entityId
    ): ResponseInterface {
        return $this->respond(new ActionPayload(501));
    }

    #[Route(pattern: '/{entityId}', verb: Route::DELETE)]
    public function destroy(
        ServerRequestInterface $request,
        ResponseInterface $response,
        int $entityId
    ): ResponseInterface {
        return $this->respond(new ActionPayload(501));
    }
}
