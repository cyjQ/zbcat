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

    public static function set($key,$value){
        if(!(trim($key))){
            errlog('Session::set error: the param key request!');
            return false;
        }
        if(!(trim($value))){
            errlog('Session::set error: the param value request!');
            return false;
        }
        session($key,$value);
        return true;
    }

    public  static function get($key){
        if(!(trim($key))){
            error_log('Session::get error: the param key is request!');
            return false;
        }
        return session($key);

    }

    public static function uGoTo($is_redict=true){
        $url = self::get('goto')?self::get('goto'):'./?m=user&c=ucenter';
        if($is_redict){
            header('Location: ./?m=user&c=ucenter');
            return true;
        }
        return $url;


    }
}