<?php

namespace App\php_inspections\bad;

class BadExample
{
    function example($data) {
        $unusedVar = 'test';

        $result = [];
        foreach ($data as $item) {
            $result = array_merge($result, $item);
        }

        if (strpos($item, 'test') === false) {
            echo "Found!";
        }

        if (array_search($what, $where, true) === false) {
            /* some logic here */
        }

        return $result;
    }
}
