<?php

namespace Tests\Datatable;

use Datatable\Datatable;
use Datatable\Request;

class DatatableTest extends DatatablesTestCase
{
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

    public function testRendererInstanceValid()
    {
        $datatable = new Datatable($this->config);
        $this->assertInstanceOf('Datatable\Render\RenderInterface', $datatable->getRenderer());
    }

    public function testToArray()
    {
        $datatable = new Datatable($this->config);
        $this->assertEquals([
            'iTotalRecords' => 0,
            'iTotalDisplayRecords' => 0,
            'aaData' => [],
            'sEcho' => 1
        ], $datatable->process([])->toArray());
    }

    public function testRenderJson()
    {
        $datatable = new Datatable($this->config);
        $this->assertJson('{"iTotalRecords":0,"iTotalDisplayRecords":0,"aaData":[],"sEcho":1}', $datatable->process([])->toJson());
    }
}
