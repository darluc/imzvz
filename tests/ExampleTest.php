<?php

use Furbook\Cat;
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

    private function generateReport($runData, $namespace)
    {
        $xhprof_runs = new XHProfRuns_Default();
        $run_id = $xhprof_runs->save_run($runData, $namespace);
        echo "---------------\n" .
            "XHProf: you can view run at \n" .
            "http://xhprof.test/index.php?run=$run_id&source=$namespace\n" .
            "---------------\n";
    }

    public function slimPdo()
    {
        $dsn = 'mysql:host=localhost;dbname=furbook;charset=utf8';
        $usr = 'root';
        $pwd = 'ddff999666';
        $ahuaData = [
            'name' => 'ahua',
            'breed_id' => 3,
            'user_id' => 1
        ];
        $keys = array_keys($ahuaData);
        $vals = array_values($ahuaData);
        xhprof_enable();
        $pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

        $selectStatement = $pdo->select(['name'])
            ->from('cats');
        $stmt = $selectStatement->execute();
        $cats = $stmt->fetchAll();
        var_dump($cats);
        $this->assertEquals(1, count($cats));

        $insertStatement = $pdo->insert($keys)
            ->into('cats')
            ->values($vals);
        $insertStatement->execute(false);
        
        $selectStatement = $pdo->select(['name'])
            ->from('cats');
        $stmt = $selectStatement->execute();
        $cats = $stmt->fetchAll();
        $this->assertEquals(2, count($cats));

        $deleteStatement = $pdo->delete()
            ->from('cats')
            ->where('name', '=', 'ahua');
        $deleteStatement->execute();

        for ($i = 0; $i < 10000; $i++) {
            $selectStatement = $pdo->select(['name'])
                ->from('cats');
            $stmt = $selectStatement->execute();
            $cats = $stmt->fetchAll();
        }
        $this->assertEquals(1, count($cats));
        $xhprofData = xhprof_disable();
        $this->generateReport($xhprofData, 'slim-pdo');
    }

    public function testDBPerformance()
    {
        include_once __DIR__ . "/xhprof_lib/utils/xhprof_lib.php";
        include_once __DIR__ . "/xhprof_lib/utils/xhprof_runs.php";
        $ahuaData = [
            'name' => 'ahua',
            'breed_id' => 3,
            'user_id' => 1
        ];
        $this->slimPdo();

        $lockfile = __DIR__ . '/.dblock';

        if (file_exists($lockfile)) {
            //------------------- Query builder ------------------
            xhprof_enable();
            DB::table('cats')->insert($ahuaData);
            $cats = DB::table('cats')->select('name')->get();
            $this->assertEquals(2, count($cats));
            DB::table('cats')->where('name', '=', 'ahua')->delete();
            for ($i = 0; $i < 10000; $i++) {
                $cats = DB::table('cats')->select('name')->get();
            }
            $this->assertEquals(1, count($cats));
            $xhprof_data = xhprof_disable();

            $this->generateReport($xhprof_data, 'query-builder');
            unlink($lockfile);
        } else {
            //------------------- Eloquent -------------------
            xhprof_enable();
            Cat::create($ahuaData);
            $cats = Cat::all('name');
            $this->assertEquals(2, count($cats));
            Cat::where('name', '=', 'ahua')->delete();
            for ($i = 0; $i < 10000; $i++) {
                $cats = Cat::all('name');
            }
            $this->assertEquals(1, count($cats));
            $xhprof_data = xhprof_disable();

            $this->generateReport($xhprof_data, 'eloquent');
            touch($lockfile);
        }


    }


}
