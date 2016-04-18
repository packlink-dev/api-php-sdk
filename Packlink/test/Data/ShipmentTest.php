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
use Packlink\Data\Address;
use Packlink\Data\Insurance;
use Packlink\Data\Package;
use Packlink\Data\Shipment;

include_once __DIR__ . '/../../Data/Shipment.php';

class ShipmentTest extends \PHPUnit_Framework_TestCase
{
    public function testJSONConversion()
    {
        $package = new Package();
        $package->weight = 'weight';
        $package->length = 'length';
        $package->width = 'width';
        $package->height = 'height';

        $additionalData = new Additional();
        $additionalData->postalZoneIdFrom = 'postal_zone_id_from';
        $additionalData->postalZoneIdTo = 'postal_zone_id_to';
        $additionalData->postalZoneNameFrom = 'postal_zone_name_from';
        $additionalData->postalZoneNameTo = 'postal_zone_name_to';
        $additionalData->zipCodeIdFrom = 'zip_code_id_from';
        $additionalData->zipCodeIdTo = 'zip_code_id_to';
        $additionalData->shippingServiceName = 'shipping_service_name';
        $additionalData->shippingServiceSelected = 'shipping_service_selected';

        $adr = new Address();
        $adr->country = 'country';
        $adr->city = 'city';
        $adr->state = 'state';
        $adr->zipCode = 'zip_code';
        $adr->zip = 'zip';
        $adr->lastName = 'last_name';
        $adr->firstName = 'first_name';
        $adr->street = 'street';
        $adr->email = 'email';
        $adr->phone = 'phone';
        $adr->company = 'company';


        $obj = new Shipment();
        $obj->source = 'source';
        $obj->insurance = new Insurance();
        $obj->additionalData = $additionalData;
        $obj->contentValue = 'contentvalue';
        $obj->content = 'content';
        $obj->from = $adr;
        $obj->packages = array($package);
        $obj->serviceId = 'service_id';
        $obj->to = $adr;
        $ret = json_encode($obj);

        $expected = [
            'source' => 'source',
            'insurance' => new \stdClass(),
            'additional_data' => [
                'postal_zone_id_from' => 'postal_zone_id_from',
                'postal_zone_id_to' => 'postal_zone_id_to',
                'postal_zone_name_from' => 'postal_zone_name_from',
                'postal_zone_name_to' => 'postal_zone_name_to',
                'zip_code_id_from' => 'zip_code_id_from',
                'zip_code_id_to' => 'zip_code_id_to',
                'shipping_service_name' => 'shipping_service_name',
                'shipping_service_selected' => 'shipping_service_selected',
            ],
            'contentvalue' => 'contentvalue',
            'content' => 'content',
            'from' => [
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
            ],
            'packages' => [
                [
                    'weight' => 'weight',
                    'length' => 'length',
                    'width' => 'width',
                    'height' => 'height',
                ],
            ],
            'service_id' => 'service_id',
            'to' => [
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
            ],
        ];

        self::assertSame(json_encode($expected), $ret);
        $expected['insurance'] = []; // stdClass is used to force {} in JSON but PHP will decode it as array
        self::assertSame($expected, json_decode($ret, true));
    }
}
