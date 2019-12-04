<?php


namespace Wog\Http;


interface ResponseInterface
{
    /**
     * @return string
     */

    public function getStatus(): string;

    /**
     * @param int $statusCode
     * @param string $statusText
     * @return Response
     */
    public function setStatus(int $statusCode, string $statusText): Response;

    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @param array $headers
     * @return Response
     */
    public function setHeaders(array $headers): Response;

    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @param string $body
     * @return Response
     */
    public function setBody(string $body): Response;

    function setJsonErr(string $message):void;


    function finalSend();
}