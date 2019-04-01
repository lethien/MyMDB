<?php

class RestClient {
    static function call($endpoint, $method, $callData) {
        $requestHeaders = array("requesttype" => $method);
        
        $data = array_merge($requestHeaders, $callData);

        // Options for stream creation
        $options = array('http' => array(
            'header' => 'Content-Type: application/x-www-form-urlencoded\r\n',
            'method' => $method,
            'content' => http_build_query($data)
        ));

        // Generate Context
        $context = stream_context_create($options);
        $result = file_get_contents(API_URL.$endpoint, false, $context);

        return $result;
    }
}

?>