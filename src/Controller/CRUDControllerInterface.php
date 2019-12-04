<?php


namespace Wog\Controller;

use Wog\Http\ResponseInterface;

interface CRUDControllerInterface
{

    /**
     * Triggered for POST HTTP method
     *
     * Responsible to query a model and put it in the response body
     * Must retrieve 200 response for found resource
     * Must retrieve 404 response for not found resource
     *
     * @return ResponseInterface
     *
     * @throws \PDOException for all pdo errors
     */

    public function create(): ResponseInterface;

    /**
     * Triggered for PUT HTTP method
     *
     * Responsible to query a model and put it in the response body
     * Must retrieve 201 response for found resource
     * Must retrieve 422 response for unprocessable entity
     * Must retrieve 409 response for not found resource
     *
     * @return ResponseInterface
     *
     * @throws \PDOException for all pdo errors except constraint integrity violation
     */

    public function retrieve(): ResponseInterface;

    /**
     * Triggered for PUT HTTP method
     *
     * Responsible to query a model and put it in the response body
     * Must retrieve 200 response for found resource
     * Must retrieve 409 response for conflit
     * Must retrieve 422 response for unprocessable entity
     *
     * @return ResponseInterface
     *
     * @throws \PDOException for all pdo errors except constraint integrity violation
     */

    public function update(): ResponseInterface;

    /**
     * Triggered for DELETE HTTP method
     *
     * Responsible to query a model and put it in the response body
     * Must retrieve 200 response for delete resource
     * Must retrieve 404 response for not found resource
     *
     * @return ResponseInterface
     *
     * @throws \PDOException for all pdo errors except constraint integrity violation
     */

    public function delete(): ResponseInterface;
}