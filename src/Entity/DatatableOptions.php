<?php

namespace Datatable\Entity;

use Datatable\Config;

class DatatableOptions extends Option
{
    protected $bPaginate;
    protected $bLengthChange;
    protected $bProcessing;
    protected $bFilter;
    protected $bSort;
    protected $bInfo;
    protected $bAutoWidth;
    protected $bScrollCollapse;
    protected $bScrollInfinite;
    protected $iDisplayLength;
    protected $bJQueryUI;
    protected $sPaginationType;
    protected $bStateSave;
    protected $iCookieDuration;
    protected $asStripClasses;
    protected $aoColumns;
    protected $aaSorting;
    protected $aLengthMenu;
    protected $bServerSide;
    protected $sAjaxSource;
    protected $sScrollX;
    protected $sScrollY;
    protected $iScrollLoadGap;
    protected $oLanguage;
    protected $sCookiePrefix;
    protected $sDom;

    /**
     * @return mixed
     */
    public function getBServerSide()
    {
        return $this->bServerSide;
    }

    /**
     * @param mixed $bServerSide
     * @return $this
     */
    public function setBServerSide($bServerSide)
    {
        $this->bServerSide = $bServerSide;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getBPaginate()
    {
        return $this->bPaginate;
    }

    /**
     * @param mixed $bPaginate
     * @return $this
     */
    public function setBPaginate($bPaginate)
    {
        $this->bPaginate = $bPaginate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBLengthChange()
    {
        return $this->bLengthChange;
    }

    /**
     * @param mixed $bLengthChange
     * @return $this
     */
    public function setBLengthChange($bLengthChange)
    {
        $this->bLengthChange = $bLengthChange;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBProcessing()
    {
        return $this->bProcessing;
    }

    /**
     * @param mixed $bProcessing
     * @return $this
     */
    public function setBProcessing($bProcessing)
    {
        $this->bProcessing = $bProcessing;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBFilter()
    {
        return $this->bFilter;
    }

    /**
     * @param mixed $bFilter
     * @return $this
     */
    public function setBFilter($bFilter)
    {
        $this->bFilter = $bFilter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBSort()
    {
        return $this->bSort;
    }

    /**
     * @param mixed $bSort
     * @return $this
     */
    public function setBSort($bSort)
    {
        $this->bSort = $bSort;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBInfo()
    {
        return $this->bInfo;
    }

    /**
     * @param mixed $bInfo
     * @return $this
     */
    public function setBInfo($bInfo)
    {
        $this->bInfo = $bInfo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBAutoWidth()
    {
        return $this->bAutoWidth;
    }

    /**
     * @param mixed $bAutoWidth
     * @return $this
     */
    public function setBAutoWidth($bAutoWidth)
    {
        $this->bAutoWidth = $bAutoWidth;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBScrollCollapse()
    {
        return $this->bScrollCollapse;
    }

    /**
     * @param mixed $bScrollCollapse
     * @return $this
     */
    public function setBScrollCollapse($bScrollCollapse)
    {
        $this->bScrollCollapse = $bScrollCollapse;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBScrollInfinite()
    {
        return $this->bScrollInfinite;
    }

    /**
     * @param mixed $bScrollInfinite
     * @return $this
     */
    public function setBScrollInfinite($bScrollInfinite)
    {
        $this->bScrollInfinite = $bScrollInfinite;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIDisplayLength()
    {
        return $this->iDisplayLength;
    }

    /**
     * @param mixed $iDisplayLength
     * @return $this
     */
    public function setIDisplayLength($iDisplayLength)
    {
        $this->iDisplayLength = $iDisplayLength;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBJQueryUI()
    {
        return $this->bJQueryUI;
    }

    /**
     * @param mixed $bJQueryUI
     * @return $this
     */
    public function setBJQueryUI($bJQueryUI)
    {
        $this->bJQueryUI = $bJQueryUI;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSPaginationType()
    {
        return $this->sPaginationType;
    }

    /**
     * @param mixed $sPaginationType
     * @return $this
     */
    public function setSPaginationType($sPaginationType)
    {
        $this->sPaginationType = $sPaginationType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBStateSave()
    {
        return $this->bStateSave;
    }

    /**
     * @param mixed $bStateSave
     * @return $this
     */
    public function setBStateSave($bStateSave)
    {
        $this->bStateSave = $bStateSave;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getICookieDuration()
    {
        return $this->iCookieDuration;
    }

    /**
     * @param mixed $iCookieDuration
     * @return $this
     */
    public function setICookieDuration($iCookieDuration)
    {
        $this->iCookieDuration = $iCookieDuration;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAsStripClasses()
    {
        return $this->asStripClasses;
    }

    /**
     * @param mixed $asStripClasses
     * @return $this
     */
    public function setAsStripClasses($asStripClasses)
    {
        $this->asStripClasses = $asStripClasses;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAoColumns()
    {
        return $this->aoColumns;
    }

    /**
     * @param mixed $aoColumns
     * @return $this
     */
    public function setAoColumns($aoColumns)
    {
        $this->aoColumns = $aoColumns;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAaSorting()
    {
        return $this->aaSorting;
    }

    /**
     * @param mixed $aaSorting
     * @return $this
     */
    public function setAaSorting($aaSorting)
    {
        $this->aaSorting = $aaSorting;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getALengthMenu()
    {
        return $this->aLengthMenu;
    }

    /**
     * @param mixed $aLengthMenu
     * @return $this
     */
    public function setALengthMenu($aLengthMenu)
    {
        $this->aLengthMenu = $aLengthMenu;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSAjaxSource()
    {
        return $this->sAjaxSource;
    }

    /**
     * @param mixed $sAjaxSource
     * @return $this
     */
    public function setSAjaxSource($sAjaxSource)
    {
        $this->sAjaxSource = $sAjaxSource;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSScrollX()
    {
        return $this->sScrollX;
    }

    /**
     * @param mixed $sScrollX
     * @return $this
     */
    public function setSScrollX($sScrollX)
    {
        $this->sScrollX = $sScrollX;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSScrollY()
    {
        return $this->sScrollY;
    }

    /**
     * @param mixed $sScrollY
     * @return $this
     */
    public function setSScrollY($sScrollY)
    {
        $this->sScrollY = $sScrollY;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIScrollLoadGap()
    {
        return $this->iScrollLoadGap;
    }

    /**
     * @param mixed $iScrollLoadGap
     * @return $this
     */
    public function setIScrollLoadGap($iScrollLoadGap)
    {
        $this->iScrollLoadGap = $iScrollLoadGap;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOLanguage()
    {
        return $this->oLanguage;
    }

    /**
     * @param mixed $oLanguage
     * @return $this
     */
    public function setOLanguage($oLanguage)
    {
        $this->oLanguage = $oLanguage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSCookiePrefix()
    {
        return $this->sCookiePrefix;
    }

    /**
     * @param mixed $sCookiePrefix
     * @return $this
     */
    public function setSCookiePrefix($sCookiePrefix)
    {
        $this->sCookiePrefix = $sCookiePrefix;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSDom()
    {
        return $this->sDom;
    }

    /**
     * @param mixed $sDom
     * @return $this
     */
    public function setSDom($sDom)
    {
        $this->sDom = $sDom;
        return $this;
    }

    public static function fromConfig(Config $config)
    {
        $options = new self();
        return $options->setBPaginate($config->isPaginationEnabled())
            ->setBLengthChange($config->isLengthChangeEnabled())
            ->setBProcessing($config->isProcessingEnabled())
            ->setBFilter($config->isFilterEnabled())
            ->setBSort($config->isSortEnabled())
            ->setBInfo($config->isInfoEnabled())
            ->setBAutoWidth($config->isAutoWidthEnabled())
            ->setBScrollCollapse($config->isScrollCollapseEnabled())
            ->setBScrollInfinite($config->isScrollInfiniteEnabled())
            ->setIDisplayLength($config->getDisplayLength())
            ->setBJQueryUI($config->isJQueryUIEnabled())
            ->setSPaginationType($config->getPaginationType())
            ->setBStateSave($config->isSaveStateEnabled())
            ->setICookieDuration($config->getCookieDuration())
            ->setAsStripClasses($config->getStripClasses())
            ->setBServerSide($config->isServerSideEnabled())
            ->setSAjaxSource($config->getAjaxSource())
            ->setSScrollX($config->getScrollX())
            ->setSScrollY($config->getScrollY())
            ->setIScrollLoadGap($config->getScrollLoadGap())
            ->setSCookiePrefix($config->getCookiePrefix())
            ->setSDom($config->getDom());
    }
}
