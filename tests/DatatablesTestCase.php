<?php

namespace Tests\Datatable;

abstract class DatatablesTestCase extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        date_default_timezone_set('America/Recife');
    }
}
