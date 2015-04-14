<?php

namespace Tests\Datatable;

use Datatable\Config;
use Datatable\Datatable;
use Datatable\Request;

class DatatableTest extends DatatablesTestCase
{
    /**
     * @var Config
     */
    private $config;
    const DISPLAY_LENGHT = 10;

    protected function setUp()
    {
        $this->config = new Config();
        $this->config->setClass("display")
            ->setDisplayLength(static::DISPLAY_LENGHT)
            ->setIsPaginationEnabled(true)
            ->setIsLengthChangeEnabled(true)
            ->setIsFilterEnabled(true)
            ->setIsInfoEnabled(true)
            ->setIsSortEnabled(true)
            ->setIsAutoWidthEnabled(true)
            ->setIsScrollCollapseEnabled(false)
            ->setPaginationType(Config::PAGINATION_TYPE_FULL_NUMBERS)
            ->setIsJQueryUIEnabled(false)
            ->setIsServerSideEnabled(true)
            ->setAjaxSource('/list');

        $_GET['iDisplayLength'] = 10;
        $_GET['iDisplayStart'] = 0;
        $_GET['sEcho'] = 1;
        $_GET['sSearch'] = 'test';
    }

    public function testValidInstance()
    {
        $datatable = new Datatable($this->config);
        $this->assertInstanceOf(Datatable::class, $datatable);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testInvalidInstance()
    {
        $datatable = new Datatable(null);
    }

    public function testRequestInstance()
    {
        $datatable = new Datatable($this->config);
        $this->assertInstanceOf(Request::class, $datatable->getRequest());
    }

    public function testRequestData()
    {
        $datatable = new Datatable($this->config);
        $this->assertInternalType('int', $datatable->getRequest()->getDisplayLength());
        $this->assertInternalType('int', $datatable->getRequest()->getDisplayStart());
        $this->assertInternalType('int', $datatable->getRequest()->getEcho());
        $this->assertInternalType('string', $datatable->getRequest()->getSearch());
    }

    public function testRenderJson()
    {
        $datatable = new Datatable($this->config);
        $this->assertJson('{"iTotalRecords":0,"iTotalDisplayRecords":0,"aaData":[],"sEcho":1}', $datatable->toJson([]));
    }
}
