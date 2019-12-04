<?php

namespace Wog\Http;


use Wog\Controller\Controller;

class Response implements ResponseInterface
{

    /**
     * @var int
     */
    private $statusCode,
        /**
         * @var string
         */
        $statusText,
        /**
         * @var array
         */
        $headers,
        /**
         * @var string
         */
        $body;

    public function __construct()
    {
        $this->statusCode = 200;
        $this->statusText = "OK";
        $this->headers = [
            "Content-Type" => "application/json",
            "Access-Control-Allow-Origin" => "*",
            "Access-Control-Allow-Methods" => "GET, POST, PUT, DELETE, OPTIONS",
            "Access-Control-Allow-Headers" => "Content-Type",
        ];
        $this->body = "{}";
    }

    /**
     * @return string
     */

    public function getStatus(): string
    {
        return $this->statusCode
            . " "
            . $this->statusText;
    }

    /**
     * @param int $statusCode
     * @param string $statusText
     * @return Response
     */
    public function setStatus(int $statusCode, string $statusText): Response
    {
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return Response
     */
    public function setHeaders(array $headers): Response
    {
        return $this->headers = $headers;

    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Response
     */
    public function setBody(string $body): Response
    {
         $this->body = $body;
        return $this;
    }

    function setJsonErr(string $message):void {

     $this->setBody(json_encode([
         "Code :" => $this->statusCode,
             "message" =>utf8_encode($message)
         ]));
    }

    function finalSend()
    {
        header("HTTP/1.1 " . $this->getStatus());

        foreach ($this->getHeaders() as $key => $value) {
            header($key . ": " . $value);
        }
        die($this->getBody());
    }

}