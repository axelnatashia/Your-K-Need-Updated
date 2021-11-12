<?php

    function returnIsLogin(){
        return (auth()->guard('admin')->check() || auth()->guard('seller')->check() || auth()->guard('buyer')->check()) ? 1 : 0;
    }

    function returnDataLogin(){
        if(auth()->guard('admin')->check()){
            return 'admin';
        }else if(auth()->guard('seller')->check()){
            return 'seller';
        }else if(auth()->guard('buyer')->check()){
            return 'buyer';
        }else{
            return false;
        }
    }

    function returnAuthName($key){
        return auth()->guard($key)->user()->name;
    }

    function returnAuthAvatar($key){
        return auth()->guard($key)->user()->avatar;
    }
?>
