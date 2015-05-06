<?php

class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    public function __construct() {
        DB::table('ziyaretciler')->insert(
                array(
                    'HTTP_ACCEPT' => Request::server('HTTP_ACCEPT'),
                    'HTTP_ACCEPT_ENCODING' => Request::server('HTTP_ACCEPT_ENCODING'),
                    'HTTP_ACCEPT_LANGUAGE' => Request::server('HTTP_ACCEPT_LANGUAGE'),
                    'HTTP_CONNECTION' => Request::server('HTTP_CONNECTION'),
                    'HTTP_COOKIE' => Request::server('HTTP_COOKIE'),
                    'HTTP_HOST' => Request::server('HTTP_HOST'),
                    'HTTP_USER_AGENT' => Request::server('HTTP_USER_AGENT'),
                    'DOCUMENT_ROOT' => Request::server('DOCUMENT_ROOT'),
                    'HTTP_CLIENT_IP' => Request::server('HTTP_CLIENT_IP'),
                    'REMOTE_ADDR' => Request::server('REMOTE_ADDR'),
                    'REMOTE_PORT' => Request::server('REMOTE_PORT'),
                    'SERVER_ADDR' => Request::server('SERVER_ADDR'),
                    'SERVER_NAME' => Request::server('SERVER_NAME'),
                    'SERVER_ADMIN' => Request::server('SERVER_ADMIN'),
                    'SERVER_PORT' => Request::server('SERVER_PORT'),
                    'REQUEST_URI' => Request::server('REQUEST_URI'),
                    'SCRIPT_FILENAME' => Request::server('SCRIPT_FILENAME'),
                    'QUERY_STRING' => Request::server('QUERY_STRING'),
                    'SCRIPT_URI' => Request::server('SCRIPT_URI'),
                    'SCRIPT_URL' => Request::server('SCRIPT_URL'),
                    'SCRIPT_NAME' => Request::server('SCRIPT_NAME'),
                    'SERVER_PROTOCOL' => Request::server('SERVER_PROTOCOL'),
                    'SERVER_SOFTWARE' => Request::server('SERVER_SOFTWARE'),
                    'REQUEST_METHOD' => Request::server('REQUEST_METHOD'),
                    'REQUEST_TIME_FLOAT' => Request::server('REQUEST_TIME_FLOAT'),
                    'REQUEST_TIME' => Request::server('REQUEST_TIME')
                )
        );
    }

    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

}
