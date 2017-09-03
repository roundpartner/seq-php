<?php

namespace Test\Provider;

use \GuzzleHttp\Psr7\Response;

class ResponseProvider
{
    /**
     * @return Response[]
     */
    public static function get()
    {
        return [
            [[new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], '[{"id":1,"body":"hello world"}]')]]
        ];
    }

    /**
     * @return Response[]
     */
    public static function getEmpty()
    {
        return [
            [[new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], '[]')]]
        ];
    }

    /**
     * @return Response[]
     */
    public static function getMultiple()
    {
        return [
            [[new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], '[{"id":1,"body":"hello world"}]')]]
            [[new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], '[{"id":2,"body":"hello world"}]')]]
            [[new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], '[{"id":3,"body":"hello world"}]')]]
            [[new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], '[{"id":4,"body":"hello world"}]')]]
            [[new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], '[{"id":5,"body":"hello world"}]')]]
            [[new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], '[]')]]
        ];
    }

    /**
     * @return Response[]
     */
    public static function post()
    {
        return [
            [[new Response(204, [], '')]]
        ];
    }

    /**
     * @return Response[]
     */
    public static function delete()
    {
        return [
            [[new Response(204, [], '')]]
        ];
    }

    /**
     * @return Response[]
     */
    public static function deleteNotFound()
    {
        return [
            [[new Response(404, [], '')]]
        ];
    }

    /**
     * @return Response[]
     */
    public static function internalError()
    {
        return [
            [[new Response(500, ['Content-Type' => 'application/json; charset=utf-8'], '{"error":"Internal Error"}')]]
        ];
    }
}
