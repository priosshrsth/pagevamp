<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/*
 * Protect Direct Access To Code Inside AppCode For Security Purpose
 */
if(!function_exists('url_origin')) {
    function url_origin( $s, $use_forwarded_host = false )
    {
        $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
        $sp       = strtolower( $s['SERVER_PROTOCOL'] );
        $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
        $port     = $s['SERVER_PORT'];
        $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
        $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
        $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host;
    }
}

if(!function_exists('full_url')) {
    function full_url( $s, $use_forwarded_host = false ) {
        return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
    }
}

$dir = str_replace('/AppCode','',realpath(__DIR__));
$absolute_url = full_url( $_SERVER );
$backtrace =  debug_backtrace();
$fileIncluder = $backtrace[0]['file'];
$isDirectCallToProtectedFile = strpos($absolute_url,str_replace($dir,'',$fileIncluder)) > -1;
if(!isset($_MODE) || (isset($_MODE) && $_MODE !== 'Dev')) {
    if($isDirectCallToProtectedFile) {
        die('You Are Not Welcome, Here!');
    }
} elseif(isset($_MODE) && $_MODE=='Dev' && $isDirectCallToProtectedFile) {
    trigger_error("You are accessing these in development mode!", E_USER_NOTICE);
}
if(!isset($BASE_URL)) {
    $BASE_URL = explode(basename($_SERVER['SCRIPT_FILENAME']), $absolute_url)[0];
    $BASE_URL = explode('/AppCode',$BASE_URL)[0];
    $BASE_URL = explode('admin',$BASE_URL)[0];
    $BASE_URL = explode('assets',$BASE_URL)[0];
    $BASE_URL = explode('Storage',$BASE_URL)[0];
    $BASE_URL = explode('Database',$BASE_URL)[0];
    $BASE_URL = explode('layouts',$BASE_URL)[0];
    $BASE_URL = explode('Test',$BASE_URL)[0];
    $BASE_URL = explode('vendor',$BASE_URL)[0];
}