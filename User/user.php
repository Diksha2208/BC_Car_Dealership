<?php

class User {
    var $id;
    var $username = "";
    var $isSignedIn = false;
    var $userType = "";


    function isSignedIn() {
        return $this->isSignedIn;
    }
}

?>