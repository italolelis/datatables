<?php

namespace Datatable;

class DataResult
{
    /**
     * The results to pass back to the DataTable rendering
     *
     * This variable needs to be an array of objects
     *
     * @var array
     */
    protected $data;
    /**
     * The total number of results
     *
     * This is the total number of results that can be shown
     * in the datatable (before pagination)
     *
     * @var integer
     */
    protected $numTotalResults;
    /**
     * The total number of filtered results
     *
     * @var integer
     */
    protected $numFilteredResults;

    public function __construct($data, $numTotalResults, $numFilteredResults = null)
    {
        $this->data = $data;
        $this->numTotalResults = $numTotalResults;
        $this->numFilteredResults = $numFilteredResults;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getNumTotalResults()
    {
        return $this->numTotalResults;
    }

    public function getNumFilteredResults()
    {
        return $this->numFilteredResults;
    }
}