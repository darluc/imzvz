<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
//    public function testHomePageRedirection()
//    {
//        $this->call('GET', '/');
//        $this->assertRedirectedTo('cat');
//    }
//
//    public function testGuestIsRedirected()
//    {
//        $this->call('GET', '/cat/create');
//        $this->assertRedirectedTo('login');
//    }
//
//    public function testLoggedInUserCanCreateCat()
//    {
//        $user = new Furbook\User(['name' => 'John Doe', 'is_admin' => false,]);
//        $this->be($user);
//        $this->call('GET', '/cats/create');
//        $this->assertResponseOk();
//    }
    public function testFoo()
    {
        $str = 'cat';
        $result = 'cat';
        $this->assertSame($result, $str);
    }

    public function testGoogleTraslate()
    {
        $tr = app('translateEngine');
        $this->assertInstanceOf(Furbook\Services\GoogleTranslateEngine::class, $tr);
//        $tr = new \Furbook\Services\GoogleTranslation();
//        $result = $tr->setTarget('zh-CN')->translate('me');
//        $this->assertEquals('我', $result);
    }

}
