<?php

namespace Tests\Datatable;

use Datatable\Config;
use Datatable\Datatable;
use Datatable\Render\RenderInterface;
use Datatable\Request;

class DatatableRendererTest extends DatatablesTestCase
{
    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testInvalidInstance()
    {
        $datatable = new Datatable(null);
    }
}
