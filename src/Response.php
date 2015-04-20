<?php

namespace Datatable;

use Symfony\Component\PropertyAccess\PropertyAccess;

class Response
{
    protected $data;
    protected $config;

    public function __construct($data, $config)
    {
        $this->data = $data;
        $this->config = $config;
    }

    /**
     * Get the JSON formatted date for a AJAX request
     * @return array
     */
    public function toArray()
    {
        $result = $this->data;
        if (!$result instanceof DataResult) {
            $result = new DataResult($result, count($result));
        }
        return $this->renderReturnData($result, Request::createFromGlobals());
    }

    /**
     * Get the JSON formatted date for a AJAX request
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray($this->data));
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
        $property = $column->getName();
        if (is_array($object)) {
            $property = "[{$property}]";
        }

        return $accessor->getValue($object, $property);
    }
}