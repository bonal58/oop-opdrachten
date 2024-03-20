<?php

// Author: Berkay Onal


namespace Opdracht6b\classes;


use PHPUnit\Framework\TestCase;


class UserTest extends TestCase {
    private $username;
    private $db;

    public function testRegisterUser(): void {
        // Testing a registrated user.
        $this -> assertTrue($this -> user -> registerUser('Berkay', 'Onaaaallll'));

        // Testing a registrated user that isn't in the system.
        $this -> assertFalse($this -> user -> registerUser('Berkay', 'Onal'));
    }

    public function testLoginUser(): void {
        $this -> assertTrue($this -> user -> loginUser('breky', 'niggy'));
        $this -> assertFalse($this -> user -> loginUser('giggy', 'diggy'));
        $this -> assertFalse($this -> user -> loginUser('veter', 'neger'));
    }

    public function testIsLoggedin(): void {
        $this -> assertFalse($this -> user -> isLoggedin());
        $this -> user -> loginUser('niggy', 'acheblaad');
        $this -> assertTrue($this -> user -> isLoggedin());
    }

    public function testLogoutUser() {
        $this -> username -> Logout();

        $isDeleted = (session_status() == PHP_SESSION_NONE && empty(session_id()));
        $this -> assertTrue($isDeleted);
    }  
}

?>