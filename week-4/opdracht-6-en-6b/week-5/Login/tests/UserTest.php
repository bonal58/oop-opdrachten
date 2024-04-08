<?php

namespace Week5\classes;

use PHPUnit\Framework\TestCase;
use Week5\classes\Database;
use Week5\classes\User;

class UserTest extends TestCase {
    private $username;
    private $db;

    public function testRegisterUser(): void {
        // Test successful registration
        $this->assertTrue($this->user->registerUser('Berkay', 'Onal'));
    
        // Test registration with existing username (should fail)
        $this->assertFalse($this->user->registerUser('Berkay', 'Onal'));
    }
    

    public function testLoginUser(): void {
        
        $this->assertTrue($this->user->loginUser('Berkay', 'goodplayer'));

        
        $this->assertFalse($this->user->loginUser('Berkay', 'Pro'));

        
        $this->assertFalse($this->user->loginUser('blyat', 'suka'));
    }

    public function testIsLoggedin(): void {
        
        $this->assertFalse($this->user->isLoggedin());

    
        $this->user->loginUser('Arkansas', 'KatyParry');
        $this->assertTrue($this->user->isLoggedin());
    }

    public function testLogoutUser()
        {
        
            $this->username->Logout();

            $isDeleted = (session_status() == PHP_SESSION_NONE && empty(session_id()));
            $this->assertTrue($isDeleted);
        }
      
}
