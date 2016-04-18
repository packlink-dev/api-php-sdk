<?php
/**
 * Copyright 2016 OMI Europa S.L (Packlink)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *  http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Packlink;
include_once __DIR__ . '/../Connection.php';
include_once __DIR__ . '/TestBase.php';

class ConnectionTest extends TestBase
{
    /** @var Connection */
    private $connection;

    public function testConfiguration()
    {
        self::assertNotEmpty(self::$cfg['url']);
        self::assertNotEmpty(self::$cfg['auth']);
    }

    public function testInit()
    {
        self::assertNotEmpty($this->connection);
    }

    protected function setUp()
    {
        $this->connection = new Connection(self::$cfg['url'], self::$cfg['auth']);
    }
}
