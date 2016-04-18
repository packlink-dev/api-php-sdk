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


require_once __DIR__ . DIRECTORY_SEPARATOR . 'Exception.php';

class Connection
{
    protected $DEBUG = false;

    private $url, $auth;

    public function __construct($url, $auth)
    {
        $this->url = $url;
        $this->auth = $auth;
    }

    protected function curlGet($serviceURL)
    {
        $ch = $this->getConnection($serviceURL);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        $response = curl_exec($ch);

        // error
        if($response === false) {
            $err = curl_error($ch);
            curl_close($ch);
            throw new \Packlink\Exception($err);
        }

        curl_close($ch);

        return $response;
    }

    /**
     * @param $serviceURL string
     *
     * @return resource a cURL handle on success, false on errors.
     */
    protected function getConnection($serviceURL)
    {
        $serviceURL = ltrim($serviceURL, '/'); // get rid of leading '/' if present
        $this->debugOut("GET: {$this->url}/$serviceURL");
        $ch = curl_init("{$this->url}/$serviceURL");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->buildHeader(array(
            'Content-Type: application/json',
            'Accept: application/json',
        )));

        return $ch;
    }

    protected function debugOut($msg)
    {
        $this->debug('>>> ' . $msg);
    }

    protected function debug($msg)
    {
        if(!$this->DEBUG) {
            return;
        }
        print $msg . PHP_EOL;
    }

    private function buildHeader(array $headers)
    {
        // always add auth
        $headers[] = "Authorization: {$this->auth}";

        return $headers;
    }

    protected function postToPacklink($serviceURL, $data)
    {
        $ret = $this->curlPost($serviceURL, $data);
        if(!$ret) {
            throw new \Packlink\Exception('Got empty result');
        }

        $ret = json_decode($ret, true);

        // error message
        if(isset($ret['status'])) {
            $msg = "[{$ret['status']}] ";
            if($this->DEBUG && isset($ret['exception'])) {
                $msg .= $ret['exception'] . ' ';
            }
            if($this->DEBUG && isset($ret['path'])) {
                $msg .= $ret['path'] . ' ';
            }
            if(isset($ret['error'])) {
                $msg .= $ret['error'] . ' ';
            }
            if(isset($ret['message'])) {
                $msg .= PHP_EOL . $ret['message'];
            } else {
                $msg .= PHP_EOL . 'Unknown Error ' . print_r($ret, true);
            }
            throw new \Packlink\Exception($msg, $ret['status']);
        }

        return $ret;
    }

    protected function curlPost($serviceURL, $data)
    {
        $data = !is_string($data) ? json_encode($data) : $data;
        $ch = $this->getConnection($serviceURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->buildHeader(array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Content-Length: ' . strlen($data),
        )));
        $response = curl_exec($ch);

        // error
        if($response === false) {
            $err = curl_error($ch);
            curl_close($ch);
            throw new \Packlink\Exception($err);
        }

        curl_close($ch);

        return $response;
    }

    protected function debugIn($msg)
    {
        $this->debug('<<< ' . $msg);
    }
}
