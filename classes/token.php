<?php

class Token {
    public static function generate() {
        return Session::put(Config::get('sessions/token_name'), md5(uniqid()));
    }

    public static function check($token,$isAjax=false) {
        $tokenName = Config::get('sessions/token_name');
			if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
				
				if(!$isAjax){
					
					Session::delete($tokenName);
					
				}
				return true;
			}

        return false;
    }
}