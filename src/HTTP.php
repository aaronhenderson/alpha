<?php

class HTTP
{

    /**
     * Perform an HTTP get request
     *
     * @param $url
     * @param null $params
     * @return bool|string
     */
    public function get($url, $params = null)
    {
        $defaults = array(
            CURLOPT_URL => $url . (strpos($url, '?') === FALSE ? '?' : '') . http_build_query($params),
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 4,
            CURLOPT_SSL_VERIFYPEER => FALSE
        );

        $ch = curl_init();
        curl_setopt_array($ch, ($defaults));
        if (!$result = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }

        curl_close($ch);
        return $result;
    }

    /**
     * Perform an HTTP post request
     *
     * @param $url
     * @param null $params
     * @return bool|string
     */
    public function post($url, $params = null)
    {
        $defaults = array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 4,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_POSTFIELDS => http_build_query($params)
        );

        $ch = curl_init();
        curl_setopt_array($ch, ($defaults));
        if (!$result = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }
}