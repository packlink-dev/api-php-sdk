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
include_once __DIR__ . '/../Postal.php';
include_once __DIR__ . '/TestBase.php';

class PostalTest extends TestBase
{
    public function languageProvider()
    {
        return array(
            array('DE', 'de_DE'),
            array('FR', 'fr_FR'),
            array('IT', 'it_IT'),
            array('es', 'es_ES'),
            array('de', 'de_DE'),
            array('fR', 'fr_FR'),
            array('It', 'it_IT'),
            array('es', 'es_ES'),
            array('foo', 'es_ES'),
            array('', 'es_ES'),
            array(null, 'es_ES'),
            array(false, 'es_ES'),
            array(1, 'es_ES'),
            array('2', 'es_ES'),
            array(new \stdClass(), 'es_ES'),
        );
    }

    /**
     * @dataProvider languageProvider
     */
    public function testGetLanguage($iso2, $lang)
    {
        self::assertSame($lang, Postal::getLanguage($iso2));
    }

    public function testPostal()
    {
        $postal = new Postal(
            self::$cfg['url'],
            self::$cfg['auth'],
            'de',
            '56457'
        );

        self::assertSame(3, $postal->getPostalZoneId());
        self::assertSame('pc_de_38523', $postal->getZipCodeId());
        self::assertSame('Deutschland', $postal->getPostalZoneName());
    }
}
