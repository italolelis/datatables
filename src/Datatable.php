<?php

namespace Datatable;

use Datatable\Render\DatatableRenderer;
use Datatable\Render\RenderInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

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

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->renderer = new DatatableRenderer($config);
        $this->request = Request::createFromGlobals();
    }

    public function render()
    {
        return $this->renderer->render();
    }

    /**
     * Get the JSON formatted date for a AJAX request
     *
     * @param DataResult $result
     * @return string
     */
    public function toArray($result)
    {
        if (!$result instanceof DataResult) {
            $result = new DataResult($result, count($result));
        }
        return $this->renderReturnData($result, $this->request);
    }

    /**
     * Get the JSON formatted date for a AJAX request
     *
     * @param DataResult $result
     * @return string
     */
    public function toJson($result)
    {
        return json_encode($this->toArray($result));
    }

    /**
     * Render the return JSON data for the AJAX request with the DataTable_DataResult
     * returned from the current DataTable's loadData() method
     *
     * @param DataResult $result
     * @return string
     */
    protected function renderReturnData(DataResult $result, Request $request)
    {
        $rows = [];
        foreach ($result->getData() as $object) {
            $row = [];
            foreach ($this->config->getColumns() as $column) {
                $row[] = $this->getDataForColumn($object, $column);
            }
            $rows[] = $row;
        }
        $data = [
            'iTotalRecords' => $result->getNumTotalResults(),
            'iTotalDisplayRecords' => !is_null($result->getNumFilteredResults()) ?
                $result->getNumFilteredResults() : $result->getNumTotalResults(),
            'aaData' => $rows,
            'sEcho' => $request->getEcho(),
        ];
        return $data;
    }

    /**
     * Get the data for for a column from the given data object row
     *
     * This method will first try calling the get method on the current
     * DataTable object. If the method doesn't exist, then it will default
     * to calling the method on the object for the current row
     *
     * @param object $object
     * @param Column $column
     * @return mixed
     */
    protected function getDataForColumn($object, Column $column)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        return $accessor->getValue($object, $column->getName());
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
