<?php
final class Session{
    protected function __construct(){

    }
    public static function init(){
        session_start();
    }

    public static function is_login(){
        if(session('id') && session('username')){
            if($_SERVER['REMOTE_ADDR'] == session('login_ip')){
                return true;
            }
        }
        return false;
    }
}