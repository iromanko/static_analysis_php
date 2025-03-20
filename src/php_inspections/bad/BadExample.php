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

        // Потенциальный баг: isset() + доступ к массиву
        if (isset($data['key']) && $data['key'] == 'value') {
            echo "Key exists!";
        }

        return $result;
    }
}
