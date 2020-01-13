<?php

if (! function_exists('object2array')) {
    /**
     * Transforms an object into an array
     *
     * @param  object|array $stdClassObject
     * @return array
     */
    function object2array($stdClassObject) : array
    {
        $array = [];
        $_array = is_object($stdClassObject) ? get_object_vars($stdClassObject) : $stdClassObject;
        foreach ($_array as $key => $value) {
            $value = is_array($value) || is_object($value) ? object2array($value) : $value;
            $array[$key] = $value;
        }
        return $array;
    }
}


if (! function_exists('filepath2fqcn')) {
    /**
     * Filepath to Fully Qualified Class Name
     *
     * @param  string $filepath
     * @param  string $prefix
     * @return string FQCN of $filepath
     */
    function filepath2fqcn(string $filepath, string $prefix = '') : string
    {
        if (! empty($prefix)) {
            $prefix = str_finish($prefix, '/');
        }
        return ucfirst(str_replace([$prefix, '/', '.php'], ['', '\\', ''], $filepath));
    }
}
