<?php

    namespace SilverGoldBull;

    class ExternalLibrariesTest extends \PHPUnit_Framework_TestCase {
        function testExternalLibraries() {
            $this->assertTrue(function_exists('curl_init'));
            $this->assertTrue(function_exists('json_decode'));
        }
    }

?>