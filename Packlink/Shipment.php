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

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Connection.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Data' . DIRECTORY_SEPARATOR . 'Shipment.php';

class Shipment extends Connection
{
    /** @var Data\Shipment */
    private $shipment;

    /**
     * Shipment constructor.
     *
     * @param $url
     * @param $auth
     * @param Data\Shipment $shipment
     */
    public function __construct($url, $auth, Data\Shipment $shipment)
    {
        parent::__construct($url, $auth);
        $this->shipment = $shipment;
    }

    public function send()
    {
        $ret = $this->postToPacklink('shipments', $this->shipment);
        if(isset($ret['reference'])) {
            return $ret['reference'];
        }
        throw new Exception('Invalid return value ' . var_export($ret, true), 500);
    }
}
