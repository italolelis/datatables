<?php

namespace Tests\Datatable;

abstract class DatatablesTestCase extends \PHPUnit_Framework_TestCase
{
    protected $config;
    const DISPLAY_LENGHT = 10;

    protected function setUp()
    {
        date_default_timezone_set('America/Recife');
        $this->config = new Config();
        $this->config->setClass("display")
            ->setDisplayLength(static::DISPLAY_LENGHT)
            ->setPaginationEnabled(true)
            ->setLengthChangeEnabled(true)
            ->setFilterEnabled(true)
            ->setInfoEnabled(true)
            ->setSortEnabled(true)
            ->setAutoWidthEnabled(true)
            ->setScrollCollapseEnabled(false)
            ->setPaginationType(Config::PAGINATION_TYPE_FULL_NUMBERS)
            ->setJQueryUIEnabled(false)
            ->setServerSideEnabled(true)
            ->setAjaxSource('/list');

        $_GET['iDisplayLength'] = 10;
        $_GET['iDisplayStart'] = 0;
        $_GET['sEcho'] = 1;
        $_GET['sSearch'] = 'test';
    }
}
