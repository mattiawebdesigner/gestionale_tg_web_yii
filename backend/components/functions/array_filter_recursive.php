<?php
namespace backend\components\functions;

/**
 * Filtra un array multimensionale
 * 
 * @param type $input
 * @return type
 */
function array_filter_recursive($input)
{
    foreach ($input as &$value)
    {
        if (is_array($value))
        {
            $value = array_filter_recursive($value);
        }
    }

    return array_filter($input);
}