<?php

namespace Datatable\Entity;

use Datatable\LanguageConfig;

class LanguageOptions extends Option
{
    protected $oPaginate;
    protected $sEmptyTable;
    protected $sInfo;
    protected $sInfoEmpty;
    protected $sInfoFiltered;
    protected $sInfoPostFix;
    protected $sLengthMenu;
    protected $sSearch;
    protected $sZeroRecords;
    protected $sUrl;
    protected $sProcessing;

    /**
     * @return mixed
     */
    public function getOPaginate()
    {
        return $this->oPaginate;
    }

    /**
     * @param mixed $oPaginate
     * @return $this
     */
    public function setOPaginate(LanguagePagination $oPaginate)
    {
        $this->oPaginate = $oPaginate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSEmptyTable()
    {
        return $this->sEmptyTable;
    }

    /**
     * @param mixed $sEmptyTable
     * @return $this
     */
    public function setSEmptyTable($sEmptyTable)
    {
        $this->sEmptyTable = $sEmptyTable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSInfo()
    {
        return $this->sInfo;
    }

    /**
     * @param mixed $sInfo
     * @return $this
     */
    public function setSInfo($sInfo)
    {
        $this->sInfo = $sInfo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSInfoEmpty()
    {
        return $this->sInfoEmpty;
    }

    /**
     * @param mixed $sInfoEmpty
     * @return $this
     */
    public function setSInfoEmpty($sInfoEmpty)
    {
        $this->sInfoEmpty = $sInfoEmpty;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSInfoFiltered()
    {
        return $this->sInfoFiltered;
    }

    /**
     * @param mixed $sInfoFiltered
     * @return $this
     */
    public function setSInfoFiltered($sInfoFiltered)
    {
        $this->sInfoFiltered = $sInfoFiltered;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSInfoPostFix()
    {
        return $this->sInfoPostFix;
    }

    /**
     * @param mixed $sInfoPostFix
     * @return $this
     */
    public function setSInfoPostFix($sInfoPostFix)
    {
        $this->sInfoPostFix = $sInfoPostFix;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSLengthMenu()
    {
        return $this->sLengthMenu;
    }

    /**
     * @param mixed $sLengthMenu
     * @return $this
     */
    public function setSLengthMenu($sLengthMenu)
    {
        $this->sLengthMenu = $sLengthMenu;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSSearch()
    {
        return $this->sSearch;
    }

    /**
     * @param mixed $sSearch
     * @return $this
     */
    public function setSSearch($sSearch)
    {
        $this->sSearch = $sSearch;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSZeroRecords()
    {
        return $this->sZeroRecords;
    }

    /**
     * @param mixed $sZeroRecords
     * @return $this
     */
    public function setSZeroRecords($sZeroRecords)
    {
        $this->sZeroRecords = $sZeroRecords;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSUrl()
    {
        return $this->sUrl;
    }

    /**
     * @param mixed $sUrl
     * @return $this
     */
    public function setSUrl($sUrl)
    {
        $this->sUrl = $sUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSProcessing()
    {
        return $this->sProcessing;
    }

    /**
     * @param mixed $sProcessing
     * @return $this
     */
    public function setSProcessing($sProcessing)
    {
        $this->sProcessing = $sProcessing;
        return $this;
    }

    public static function fromConfig(LanguageConfig $config)
    {
        $options = new self();
        return $options->setSEmptyTable($config->getEmptyTable())
            ->setSInfo($config->getInfo())
            ->setSInfoEmpty($config->getInfoEmpty())
            ->setSInfoFiltered($config->getInfoFiltered())
            ->setSInfoPostFix($config->getInfoPostFix())
            ->setSLengthMenu($config->getLengthMenu())
            ->setSSearch($config->getSearch())
            ->setSZeroRecords($config->getZeroRecords())
            ->setSUrl($config->getUrl())
            ->setSProcessing($config->getProcessing());
    }
}
