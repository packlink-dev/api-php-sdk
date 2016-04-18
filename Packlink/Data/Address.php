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
 * Address data structure providing conversion to Packlin service format.
 *
 * @package Packlink
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $zipCode
 * @property string $zip
 * @property string $lastName
 * @property string $firstName
 * @property string $street
 * @property string $email
 * @property string $phone
 * @property string $company
 */
class Address extends Part
{
    /**
     * @inheritDoc
     */
    protected function getFieldMap()
    {
        return array(
            'country' => 'country',
            'city' => 'city',
            'state' => 'state',
            'zipCode' => 'zip_code',
            'zip' => 'zip',
            'lastName' => 'surname',
            'firstName' => 'name',
            'street' => 'street1',
            'email' => 'email',
            'phone' => 'phone',
            'company' => 'company',
        );
    }
}
