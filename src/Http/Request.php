<?php


namespace Wog\Http;


use Wog\Controller\Controller;

class Request implements RequestInterface
{
    /**
     * @var string
     */
    private $uri,
        /**
         * @var string
         */
        $method,
        /**
         * @var array
         */
        $headers,
        /**
         * @var array
         */
        $bodyGet,
        /**
         * @var array
         */
        $bodyPost,
        /**
         * @var \stdClass
         */
        $bodyJson;

    public function __construct()
    {
        $this->uri = explode("?", $_SERVER["REQUEST_URI"])[0];
        $this->method = strtolower($_SERVER["REQUEST_METHOD"]);
        $this->headers = [];
        foreach ($_SERVER as $key => $value) {
            $keys = explode("_", $key);
            if ("HTTP" !== $keys[0]) {
                continue;
            }
            array_shift($keys);
            foreach ($keys as $subKey => $subValue) {
                $keys[$subKey] = ucfirst(strtolower($subValue));
            }
            $this->headers[implode("_", $keys)] = $value;
        }
        $this->bodyGet = $_GET;

        $this->bodyPost = $_POST;
        $this->bodyJson = json_decode(stream_get_contents(fopen("php://input", "r")));
        if (null === $this->bodyJson) {
            $this->bodyJson = new \stdClass();
        }
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getBodyGet(): array
    {
        return $this->bodyGet;
    }

    /**
     * @param array $bodyGet
     * @return Request
     */
    public function setBodyGet(array $bodyGet): Request
    {
        $this->bodyGet = $bodyGet;
        return $this;
    }

    /**
     * @return array
     */
    public function getBodyPost(): array
    {
        return $this->bodyPost;
    }

    /**
     * @param array $bodyPost
     * @return Request
     */
    public function setBodyPost(string $bodyPost): Request
    {
        $this->bodyPost = $bodyPost;
        return $this;
    }

    /**
     * @return \stdClass
     */
    public function getBodyJson(): \stdClass
    {
        return $this->bodyJson;
    }


}