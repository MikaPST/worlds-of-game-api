<?php


namespace Wog\Http;


interface RequestInterface
{

    /**
     * @return string
     */
    public function getUri(): string;

    /**
     * @return string
     */
    public function getMethod(): string;
    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @return array
     */
    public function getBodyGet(): array;

    /**
     * @param array $bodyGet
     * @return Request
     */
    public function setBodyGet(array $bodyGet): Request;

    /**
     * @return array
     */
    public function getBodyPost(): array;

    /**
     * @param array $bodyPost
     * @return Request
     */
    public function setBodyPost(string $bodyPost): Request;

    /**
     * @return \stdClass
     */
    public function getBodyJson(): \stdClass;



}