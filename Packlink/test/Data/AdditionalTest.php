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

use Packlink\Data\Additional;

include_once __DIR__ . '/../../Data/Additional.php';

class AdditionalTest extends \PHPUnit_Framework_TestCase
{
    public function testJSONConversion()
    {
        $obj = new Additional();
        $obj->postalZoneIdFrom = 'postal_zone_id_from';
        $obj->postalZoneIdTo = 'postal_zone_id_to';
        $obj->postalZoneNameFrom = 'postal_zone_name_from';
        $obj->postalZoneNameTo = 'postal_zone_name_to';
        $obj->zipCodeIdFrom = 'zip_code_id_from';
        $obj->zipCodeIdTo = 'zip_code_id_to';
        $obj->shippingServiceName = 'shipping_service_name';
        $obj->shippingServiceSelected = 'shipping_service_selected';

        $expected = [
            'postal_zone_id_from' => 'postal_zone_id_from',
            'postal_zone_id_to' => 'postal_zone_id_to',
            'postal_zone_name_from' => 'postal_zone_name_from',
            'postal_zone_name_to' => 'postal_zone_name_to',
            'zip_code_id_from' => 'zip_code_id_from',
            'zip_code_id_to' => 'zip_code_id_to',
            'shipping_service_name' => 'shipping_service_name',
            'shipping_service_selected' => 'shipping_service_selected',
        ];

        $ret = json_encode($obj);
        self::assertSame($expected, json_decode($ret, true));
    }
}
