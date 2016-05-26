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

class Postal extends Connection
{
    const DEFAULT_LANGUAGE = 'es_ES';
    private static $countryToLanguage = array(
        'DE' => 'de_DE',
        'FR' => 'fr_FR',
        'IT' => 'it_IT',
        'ES' => 'es_ES',
    );
    private $country, $locale, $zipCode;
    private $postalZoneId, $zipCodeId, $postalZoneName;

    /**
     * @param $url
     * @param $auth
     * @param $country string ISO2 country code
     * @param $zipCode string ZIP (postal) code
     * @param $locale string locale code
     */
    public function __construct($url, $auth, $country, $zipCode, $locale = null)
    {
        parent::__construct($url, $auth);

        $this->country = strtoupper($country);
        $this->locale = $locale ?: self::getLanguage($country);
        $this->zipCode = $zipCode;

        $this->getPostalCodes();
    }

    /**
     * @param $iso2 string ISO2 country code
     *
     * @return string
     */
    public static function getLanguage($iso2)
    {
        if(!is_string($iso2)) {
            return self::DEFAULT_LANGUAGE; // shortcut
        }
        $iso2 = strtoupper($iso2);

        return array_key_exists($iso2, self::$countryToLanguage)
            ? self::$countryToLanguage[$iso2] : self::DEFAULT_LANGUAGE;
    }

    private function getPostalCodes()
    {
        $country = urlencode($this->country);
        $locale = urlencode($this->locale);
        $zipCode = urlencode($this->zipCode);
        $ret = $this->curlGet("/locations/postalcodes/{$country}/{$zipCode}?language={$locale}&platform=PRO&platform_country={$country}");
        $ret = json_decode($ret, true);
        $ret = reset($ret);

        $this->postalZoneId = $ret['postalZoneId'];
        $this->zipCodeId = $ret['id'];
        $this->postalZoneName = $ret['postalZone']['translations'][$locale];
    }

    /**
     * @return int
     */
    public function getPostalZoneId()
    {
        return (string)$this->postalZoneId;
    }

    /**
     * @return string
     */
    public function getPostalZoneName()
    {
        return $this->postalZoneName;
    }

    /**
     * @return string
     */
    public function getZipCodeId()
    {
        return $this->zipCodeId;
    }
}
