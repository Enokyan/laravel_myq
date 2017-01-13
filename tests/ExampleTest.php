<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
//        $this->visit('http://joni.am/en/login')
//            ->type('Taylor@mail.ru', 'email')
//            ->type('T456789', 'password')
//            ->press('login');
        $response = $this->call('POST','/createnewuser');

    }
}
