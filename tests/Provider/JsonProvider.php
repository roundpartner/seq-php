<?php

namespace Test\Provider;

class JsonProvider
{
    /**
     * @return array
     */
    public static function validJson()
    {
        return [
            ['hello world', function ($obj) {
                return $obj;
            }, 'hello world'],
            [["name" => "tom"], function ($obj) {
                return $obj->name;
            }, 'tom'],
            [["total" => 1], function ($obj) {
                return $obj->total;
            }, 1],
        ];
    }
}
