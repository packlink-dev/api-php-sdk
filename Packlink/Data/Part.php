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


abstract class Part implements \JsonSerializable
{
    protected $data;
    private $fieldMap;

    public function __construct()
    {
        $this->data = array();

        // init field map
        $this->fieldMap = array();
        foreach($this->getFieldMap() as $f => $j) {
            $this->fieldMap[$f] = $j;
        }
    }

    /**
     * @return array list of all allowed fields.
     */
    abstract protected function getFieldMap();

    /**
     * Prepare data for the JSON encoding when sending to
     * the Packlink service.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $ret = array();
        foreach($this->fieldMap as $k => $jsonName) {
            $ret[$jsonName] = $this->$k;
        }

        return $ret;
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return (string)json_encode($this);
    }

    /**
     * @param $name
     *
     * @return mixed
     * @throws \UnexpectedValueException
     */
    public function __get($name)
    {
        if(array_key_exists($name, $this->fieldMap)) {
            return array_key_exists($name, $this->data) ? $this->data[$name] : null;
        }
        throw new \UnexpectedValueException("Undefined property via __get(): {$name}");
    }


    /**
     * @param $name string
     * @param $value mixed
     *
     * @throws \UnexpectedValueException
     */
    public function __set($name, $value)
    {
        if(!array_key_exists($name, $this->fieldMap)) {
            throw new \UnexpectedValueException("Undefined property via __set(): {$name}");
        }
        $this->data[$name] = $value;
    }

    /**
     * @inheritDoc
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @inheritDoc
     */
    public function __unset($name)
    {
        unset($this->data[$name]);
    }
}
