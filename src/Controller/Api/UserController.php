<?php

namespace Wog\Controller\Api;


use Wog\Controller\Controller;
use Wog\Http\RequestInterface;
use Wog\Http\ResponseInterface;
use Wog\Model\UserModel;
use Wog\Repository\UserRepository;

class UserController extends Controller
{
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        parent::__construct($request, $response);
    }

    /**
     * @return ResponseInterface
     * @throws \Exception
     */

    public function createUser(): ResponseInterface
    {
        try {
            $user = new UserModel($this->request->getBodyJson());
            var_dump($user);
            if (!$user->getEmail()
                || !$user->getPassword()
                || !$user->getSurname()
                || !$user->getFirstName()
                || !$user->getLastName()
                || !$user->getPhone()
                || !$user->getAdress()
                || !$user->getCity()
                || !$user->getZip()) {
                $this->response->setStatus(422, " Unprocessable Entity");
                return $this->response;
            }
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
            $user->setToken(md5($user->getPassword()));
            $userRepository = new UserRepository();
            $userRepository->insert($user);
            $this->response->setBody(json_encode($user));
            $this->response->setStatus(201, "Created");

        } catch (\PDOException $e) {
            if ("23000" === $e->getCode()) {
                $this->response->setStatus(409, "Conflict");
            }
            throw ($e);

        }
        return $this->response;
    }

    public function readUsers()
    {

    }

    public function update(): ResponseInterface
    {

    }

    public function delete(): ResponseInterface
    {

    }

    /**
     * @inheritDoc
     */
    public function create(): ResponseInterface
    {
        // TODO: Implement create() method.
    }

    /**
     * @inheritDoc
     */
    public function retrieve(): ResponseInterface
    {
        $userRepository = new UserRepository();
        return $this->response->setBody(json_encode($userRepository->select()));
    }
}