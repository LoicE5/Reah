<?php

function generateCode()

{

    return str_pad(rand(1,999999), 6, '0', STR_PAD_LEFT);

}

function emptyArray(?array $array)

{
    $error = false;

    foreach($array as $value)

    {

        if(empty($value) && !is_numeric($value))

        {

            $error = true;
            break;

        }

    }

    return $error;

}

function isNumber(?array $array)

{

    $isInt = true;

    foreach($array as $value)

    {

        if(!is_numeric($value))

        {

            $isInt = false;
            break;

        }

    }

    return $isInt;

}
