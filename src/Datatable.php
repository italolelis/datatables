<?php

namespace Datatable;

use Datatable\Render\DatatableRenderer;
use Datatable\Render\RenderInterface;

class Datatable
{
    /**
     * The Config object
     * @var Config
     */
    protected $config;

    /**
     * The RenderInterface object
     * @var RenderInterface
     */
    protected $renderer;

    /**
     * The Request object
     * @var Request
     */
    protected $request;

    /**
     * Initializes an instance of Datatable
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->renderer = new DatatableRenderer($config);
        $this->request = Request::createFromGlobals();
    }

    /**
     * @param null $data
     * @return string
     */
    public function render($data = null)
    {
        return $this->renderer->render($data);
    }

    /**
     * @param $data
     * @return Response
     */
    public function process($data)
    {
        return new Response($data, $this->config);
    }

    /**
     * @return RenderInterface
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
