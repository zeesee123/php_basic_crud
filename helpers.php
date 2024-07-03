<?php


function sess_starter(){

    if(session_status()==PHP_SESSION_NONE){

        session_start();

        session_regenerate_id(true);//need to use this because php will continue using the same session id if i am not expiring the cookies

        //use session_id() to see the current session which is running

    }

    
}


function sess_destroy(){


    $_SESSION=[];

    session_destroy();
}