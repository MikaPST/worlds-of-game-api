<?php


namespace Wog\Controller\Api;


use Wog\Controller\Controller;
use Wog\Controller\CRUDControllerInterface;
use Wog\Http\RequestInterface;
use Wog\Http\ResponseInterface;
use Wog\Repository\UserRepository;

class LoginController extends Controller implements CRUDControllerInterface
{
    /**
     * @var RequestInterface
     */
    private $request,
        /**
         * @var ResponseInterface
         */

        $response;

    /**
     * LoginController constructor.
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */

    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function retrieve(): ResponseInterface
    {
        try {
            if (!array_key_exists("email", $this->request->getBodyGet())
                || !array_key_exists("password", $this->request->getBodyGet())) {
                $this->response->setStatus(422, "Unprocessable Entity");
                $this->response->setJsonErr("User incomplete: missing parameters");
                return $this->response;
            }
            $repository = new UserRepository();
            $user = $repository->selectByEmail($this->request->getBodyGet()["email"]);
            if(!password_verify($this->request->getBodyGet()["password"], $user->getPassword())) {
                throw new \TypeError();
            }
            $json = json_decode(json_encode($user));
            $json->token = $user->getToken();
            $this->response->setStatus(200, "OK");
            $this->response->setBody(json_encode($json));
        } catch (\TypeError $exception) {
            $this->response->setStatus(404, "No Found");
            $this->response->setJsonErr("The URI:"
                . $this->request->getUri()
                . "?email=" . $this->request->getBodyGet()["email"]
                . "&password=" . $this->request->getBodyGet()["password"]
                . " is Not Found");
        }
        return $this->response;

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
    public function update(): ResponseInterface
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function delete(): ResponseInterface
    {
        // TODO: Implement delete() method.
    }
}