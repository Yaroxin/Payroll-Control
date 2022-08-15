<?php

    require "lib/rb.php";
    R::setup( 'mysql:host=127.0.0.1;dbname=work_station', 'yaroxin', 'Ya35792817' );

    if ( !R::testConnection() ) {
        exit ('Нет соединения с базой данных');
    }

    R::ext('xdispense', function( $type ){
        return R::getRedBean()->dispense( $type );
    });


    $lifetime=(30*24*60*60);
    session_set_cookie_params($lifetime);
    session_start();
?>
