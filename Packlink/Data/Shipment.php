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
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Package.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Insurance.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Shipment.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Additional.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Address.php';

/**
 * @property string $source
 * @property Insurance $insurance
 * @property Additional $additionalData
 * @property string $contentValue
 * @property string $content
 * @property Address $from
 * @property array $packages
 * @property string $serviceId
 * @property Address $to
 * @package Packlink\Data
 */
class Shipment extends Part
{
    /**
     * @inheritDoc
     */
    protected function getFieldMap()
    {
        return array(
            'source' => 'source',
            'insurance' => 'insurance',
            'additionalData' => 'additional_data',
            'contentValue' => 'contentvalue',
            'content' => 'content',
            'from' => 'from',
            'packages' => 'packages',
            'serviceId' => 'service_id',
            'to' => 'to',
        );
    }
}
