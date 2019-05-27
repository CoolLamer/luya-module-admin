<?php

namespace admintests\admin\proxy;

use admintests\AdminTestCase;
use admintests\data\mocks\proxy\ClientTableMock;
use luya\admin\proxy\ClientBuild;
use luya\admin\commands\ProxyController;
use luya\Exception;
use Yii;

class ClientTableTest extends AdminTestCase
{
    /**
     * @throws \yii\db\Exception
     */
    public function testSyncDataWithConnectionLost()
    {
        $this->app->db->createCommand('CREATE TABLE IF NOT EXISTS temp_synctest LIKE admin_user')->execute();
    
        Yii::$app->controller = new ProxyController('proxyctrl', $this->app);
        $build = new ClientBuild(Yii::$app->controller, $this->app->db, [
            'buildConfig' => ['tables' => ['temp_synctest' => ['name' => 'temp_synctest', 'rows' => 0]]],
        ]);
        $table = new ClientTableMock($build, ['name' => 'temp_synctest', 'rows' => 0]);
    
        $this->expectException(Exception::class);
        $this->expectExceptionMessageRegExp('#Connection lost. Server has gone away?#');
        $table->syncData();
    }
}
