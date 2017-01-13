<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use  Illuminate\Routing\Controller;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('http://joni.am/en/login')
            ->type('Taylor@mail.ru', 'email')
            ->type('T456789', 'password')
            ->press('login');

    }
}
