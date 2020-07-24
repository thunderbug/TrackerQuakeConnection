<?php

namespace Thunderbug\QuakeConnection\Master;

use PHPUnit\Framework\TestCase;

class MasterTest extends TestCase
{
        public function testMasterList()
        {
            $master = new Master("cod4master.activision.com", 20810);
            $list = $master->getServerList();

            $this->assertIsArray($list);
        }
}
