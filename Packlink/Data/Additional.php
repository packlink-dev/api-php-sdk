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


namespace Packlink\Data;
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Part.php';

/**
 * Class Additional
 *
 * @property string postalZoneIdFrom
 * @property string postalZoneIdTo
 * @property string postalZoneNameFrom
 * @property string postalZoneNameTo
 * @property string zipCodeIdFrom
 * @property string zipCodeIdTo
 * @property string shippingServiceName
 * @property string shippingServiceSelected
 * @package Packlink\Data
 */
class Additional extends Part
{
    /**
     * @inheritDoc
     */
    protected function getFieldMap()
    {
        return array(
            'postalZoneIdFrom' => 'postal_zone_id_from',
            'postalZoneIdTo' => 'postal_zone_id_to',
            'postalZoneNameFrom' => 'postal_zone_name_from',
            'postalZoneNameTo' => 'postal_zone_name_to',
            'zipCodeIdFrom' => 'zip_code_id_from',
            'zipCodeIdTo' => 'zip_code_id_to',
            'shippingServiceName' => 'shipping_service_name',
            'shippingServiceSelected' => 'shipping_service_selected',
        );
    }
}
