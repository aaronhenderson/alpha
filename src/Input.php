<?php

class Input
{
    /**
     * Getter method for accessing the GET super global
     *
     * @param string $index
     * @param null $default
     * @return mixed|null
     */
    public function get($index, $default = null)
    {
        return isset($_GET[$index]) ? $_GET[$index] : $default;
    }

    /**
     * Getter method for accessing the POST super global
     *
     * @param string $index
     * @param null $default
     * @return mixed|null
     */
    public function post($index, $default = null)
    {
        return isset($_POST[$index]) ? $_POST[$index] : $default;
    }
}