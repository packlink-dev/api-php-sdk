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

use Packlink\Data\Address;

include_once __DIR__ . '/../../Data/Address.php';

class AddressTest extends \PHPUnit_Framework_TestCase
{
    public function testJSONConversion()
    {
        $obj = new Address();
        $obj->country = 'country';
        $obj->city = 'city';
        $obj->state = 'state';
        $obj->zipCode = 'zip_code';
        $obj->zip = 'zip';
        $obj->lastName = 'last_name';
        $obj->firstName = 'first_name';
        $obj->street = 'street';
        $obj->email = 'email';
        $obj->phone = 'phone';
        $obj->company = 'company';

        $expected = [
            'country' => 'country',
            'city' => 'city',
            'state' => 'state',
            'zip_code' => 'zip_code',
            'zip' => 'zip',
            'surname' => 'last_name',
            'name' => 'first_name',
            'street1' => 'street',
            'email' => 'email',
            'phone' => 'phone',
            'company' => 'company',
        ];

        $ret = json_encode($obj);
        self::assertSame($expected, json_decode($ret, true));
    }
}
