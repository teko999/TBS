<?php
function d($varible, $hasDie = true)
{
    echo '<pre>'; print_r($varible); echo '</pre>';
    if($hasDie) die;
}

function bt($hasDie = true)
{
    echo '<pre>'; debug_print_backtrace(); echo '</pre>';
    if($hasDie) die;
}

function is($obj, $prop, $defaultValue = null)
{
    if(!isset($obj)) return $defaultValue;

    if(is_object($obj) && isset($obj->$prop))
    {
        return $obj->$prop;
    }else if(is_array($obj) && isset($obj[$prop])) {
        return $obj[$prop];
    }

    return $defaultValue;
}

// Extract current loowercase item
function extractCLItem(array &$items, $removeItem = true)
{
    $item = strtolower(current($items));
    if($removeItem) array_shift($items);

    return $item;
}

function __($key, $defaultValue = '')
{
    return Lang::get($key, $defaultValue);
}

function simplfyArrayByKey($array, $key = 'id') {
    $result = [];
    foreach($array as $item) {
        if(is($item, $key) && count($item == 2)) {
            $k = $item[$key];
            unset($item[$key]);
            $result[$k] = array_values($item)[0];
        }
    }
    return $result;
}

function filter($data){
     $data = trim($data);
     $data = strip_tags($data);
     $data = stripslashes($data);
     $data = htmlentities($data);
     return $data;
 }
