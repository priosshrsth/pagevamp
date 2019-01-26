<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Protect {

}

/*
 * Protect Direct Access To Code Inside AppCode For Security Purpose
 */
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

function full_url( $s, $use_forwarded_host = false )
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

$absolute_url = full_url( $_SERVER );
if(!isset($_MODE) || (isset($_MODE) && $_MODE !== 'Dev')) {
    if(strpos('AppCode', $absolute_url) > -1 || strpos('appcode', $absolute_url) > -1 || !class_exists('App')) {
        die('You Are Not Welcome, Here!');
    }
} elseif(isset($_MODE) && $_MODE=='Dev' && (strpos('AppCode', $absolute_url) > -1 || strpos('appcode', $absolute_url) > -1 || !class_exists('App'))) {
    trigger_error("You are accessing these in development mode!", E_USER_NOTICE);
}