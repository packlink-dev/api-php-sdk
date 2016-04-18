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

include_once __DIR__ . '/../Shipment.php';
include_once __DIR__ . '/TestBase.php';

include_once __DIR__ . '/../Data/Shipment.php';


class SendShipmentTest extends TestBase
{
    public function testSend()
    {
        // deliberately commented out "empty" values to test using default class values (null)
        
        $package = new Data\Package();
        // $package->weight = '';
        // $package->length = '';
        // $package->width = '';
        // $package->height = '';

        $additionalData = new Data\Additional();
        // $additionalData->postalZoneIdFrom = '';
        // $additionalData->postalZoneIdTo = '';
        // $additionalData->postalZoneNameFrom = '';
        // $additionalData->postalZoneNameTo = '';
        // $additionalData->zipCodeIdFrom = '';
        // $additionalData->zipCodeIdTo = '';
        // $additionalData->shippingServiceName = '';
        // $additionalData->shippingServiceSelected = '';

        $adrFrom = new Data\Address();
        // $adrFrom->country = '';
        // $adrFrom->city = '';
        // $adrFrom->state = '';
        // $adrFrom->zipCode = '';
        // $adrFrom->zip = '';
        // $adrFrom->lastName = '';
        // $adrFrom->firstName = '';
        // $adrFrom->street = '';
        // $adrFrom->email = '';
        // $adrFrom->phone = '';
        // $adrFrom->company = '';

        $adrTo = new Data\Address();
        // $adrTo->country = '';
        // $adrTo->city = '';
        // $adrTo->state = '';
        // $adrTo->zipCode = '';
        // $adrTo->zip = '';
        // $adrTo->lastName = '';
        // $adrTo->firstName = '';
        // $adrTo->street = '';
        // $adrTo->email = '';
        // $adrTo->phone = '';
        // $adrTo->company = '';


        $obj = new Data\Shipment();
        $obj->source = 'PHP API TEST';
        $obj->insurance = new Data\Insurance();
        $obj->additionalData = $additionalData;
        // $obj->contentValue = 0;
        // $obj->content = '';
        $obj->from = $adrFrom;
        $obj->packages = array($package);
        // $obj->serviceId = null;
        $obj->to = $adrTo;

        $shipment = new Shipment(
            self::$cfg['url'],
            self::$cfg['auth'],
            $obj
        );
        $shipment->send();
    }
}
