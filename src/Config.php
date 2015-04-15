<?php

namespace Datatable;

use Collections\ArrayList;
use Collections\CollectionInterface;

/**
 * Represents the datatables configuration
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
class Config
{
    /**
     * The possible pagination types
     */
    const PAGINATION_TYPE_FULL_NUMBERS = 'full_numbers';
    const PAGINATION_TYPE_TWO_BUTTON = 'two_button';

    protected $tableId = 'datatable';

    /**
     * The collection of columns
     * @var CollectionInterface
     */
    protected $columns;

    /**
     * The default display length of the table
     * @var integer
     */
    protected $displayLength = 10;

    /**
     * The AJAX source URL
     * @var string
     */
    protected $ajaxSource;
    protected $isProcessingEnabled = true;
    protected $isServerSideEnabled = false;
    protected $isPaginationEnabled = false;
    protected $isLengthChangeEnabled = false;
    protected $isFilterEnabled = false;
    protected $isInfoEnabled = false;
    protected $isSortEnabled = true;
    protected $isJQueryUIEnabled = true;
    protected $isAutoWidthEnabled = true;
    protected $isScrollCollapseEnabled = false;
    protected $isScrollInfiniteEnabled = false;
    protected $class;
    protected $lengthMenu = [10 => 10, 25 => 25, 50 => 50, 100 => 100];
    protected $scrollX;
    protected $scrollY;
    protected $scrollLoadGap;
    protected $paginationType = self::PAGINATION_TYPE_FULL_NUMBERS;
    protected $languageConfig;
    protected $loadingHtml = '<p>loading data</p>';
    protected $cookieDuration = 7200;
    protected $isSaveStateEnabled = false;
    protected $cookiePrefix;
    protected $stripClasses = ['odd', 'even'];

    /**
     * see http://datatables.net/usage/options#sDom
     *
     * @var string
     */
    protected $dom;

    /**
     * The maximum number of rows to render in HTML
     * when table is set to use static (non-ajax) data
     *
     * @var integer
     */
    protected $staticMaxLength = 100;

    public function __construct()
    {
        $this->columns = new ArrayList();
    }

    /**
     * @return string
     */
    public function getTableId()
    {
        return $this->tableId;
    }

    /**
     * @param string $tableId
     * @return $this
     */
    public function setTableId($tableId)
    {
        $this->tableId = $tableId;
        return $this;
    }

    public function setColumns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @return ArrayList
     */
    public function getColumns()
    {
        return $this->columns;
    }

    public function setDisplayLength($displayLength)
    {
        $this->displayLength = $displayLength;
        return $this;
    }

    public function getDisplayLength()
    {
        return $this->displayLength;
    }

    public function setPaginationEnabled($isPaginationEnabled)
    {
        $this->isPaginationEnabled = $isPaginationEnabled;
        return $this;
    }

    public function isPaginationEnabled()
    {
        return $this->isPaginationEnabled;
    }

    public function setLengthChangeEnabled($isLengthChangeEnabled)
    {
        $this->isLengthChangeEnabled = $isLengthChangeEnabled;
        return $this;
    }

    public function isLengthChangeEnabled()
    {
        return $this->isLengthChangeEnabled;
    }

    public function setFilterEnabled($isFilterEnabled)
    {
        $this->isFilterEnabled = $isFilterEnabled;
        return $this;
    }

    public function isFilterEnabled()
    {
        return $this->isFilterEnabled;
    }

    public function setInfoEnabled($isInfoEnabled)
    {
        $this->isInfoEnabled = $isInfoEnabled;
        return $this;
    }

    public function isInfoEnabled()
    {
        return $this->isInfoEnabled;
    }

    public function setSortEnabled($isSortEnabled)
    {
        $this->isSortEnabled = $isSortEnabled;
        return $this;
    }

    public function isSortEnabled()
    {
        return $this->isSortEnabled;
    }

    public function setAjaxSource($ajaxSource)
    {
        $this->ajaxSource = $ajaxSource;
        return $this;
    }

    public function getAjaxSource()
    {
        return $this->ajaxSource;
    }

    public function setServerSideEnabled($isServerSideEnabled)
    {
        $this->isServerSideEnabled = $isServerSideEnabled;
        return $this;
    }

    public function isServerSideEnabled()
    {
        return $this->isServerSideEnabled;
    }

    public function setProcessingEnabled($isProcessingEnabled)
    {
        $this->isProcessingEnabled = $isProcessingEnabled;
        return $this;
    }

    public function isProcessingEnabled()
    {
        return $this->isProcessingEnabled;
    }

    public function setJQueryUIEnabled($isJQueryUIEnabled)
    {
        $this->isJQueryUIEnabled = $isJQueryUIEnabled;
        return $this;
    }

    public function isJQueryUIEnabled()
    {
        return $this->isJQueryUIEnabled;
    }

    public function setAutoWidthEnabled($isAutoWidthEnabled)
    {
        $this->isAutoWidthEnabled = $isAutoWidthEnabled;
        return $this;
    }

    public function isAutoWidthEnabled()
    {
        return $this->isAutoWidthEnabled;
    }

    public function setScrollCollapseEnabled($isScrollCollapseEnabled)
    {
        $this->isScrollCollapseEnabled = $isScrollCollapseEnabled;
        return $this;
    }

    public function isScrollCollapseEnabled()
    {
        return $this->isScrollCollapseEnabled;
    }

    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function setLengthMenu($lengthMenu)
    {
        $this->lengthMenu = $lengthMenu;
        return $this;
    }

    public function getLengthMenu()
    {
        return $this->lengthMenu;
    }

    public function setScrollX($scrollX)
    {
        $this->scrollX = $scrollX;
        return $this;
    }

    public function getScrollX()
    {
        return $this->scrollX;
    }

    public function setScrollY($scrollY)
    {
        $this->scrollY = $scrollY;
        return $this;
    }

    public function getScrollY()
    {
        return $this->scrollY;
    }

    public function getScrollLoadGap()
    {
        return $this->scrollLoadGap;
    }

    public function setScrollLoadGap($scrollLoadGap)
    {
        $this->scrollLoadGap = $scrollLoadGap;
        return $this;
    }

    public function setPaginationType($paginationType)
    {
        $this->paginationType = $paginationType;
        return $this;
    }

    public function getPaginationType()
    {
        return $this->paginationType;
    }

    public function setLanguageConfig(LanguageConfig $languageConfig)
    {
        $this->languageConfig = $languageConfig;
        return $this;
    }

    /**
     * @return LanguageConfig
     */
    public function getLanguageConfig()
    {
        return $this->languageConfig;
    }

    public function isScrollInfiniteEnabled()
    {
        return $this->isScrollInfiniteEnabled;
    }

    public function setScrollInfiniteEnabled($isScrollInfiniteEnabled)
    {
        $this->isScrollInfiniteEnabled = $isScrollInfiniteEnabled;
        return $this;
    }

    public function setLoadingHtml($loadingHtml)
    {
        $this->loadingHtml = $loadingHtml;
        return $this;
    }

    public function getLoadingHtml()
    {
        return $this->loadingHtml;
    }

    public function getCookieDuration()
    {
        return $this->cookieDuration;
    }

    public function setCookieDuration($cookieDuration)
    {
        $this->cookieDuration = $cookieDuration;
        return $this;
    }

    public function isSaveStateEnabled()
    {
        return $this->isSaveStateEnabled;
    }

    public function setSaveStateEnabled($isSaveStateEnabled)
    {
        $this->isSaveStateEnabled = $isSaveStateEnabled;
        return $this;
    }

    public function getCookiePrefix()
    {
        return $this->cookiePrefix;
    }

    public function setCookiePrefix($cookiePrefix)
    {
        $this->cookiePrefix = $cookiePrefix;
        return $this;
    }

    public function getStripClasses()
    {
        return $this->stripClasses;
    }

    public function setStripClasses($stripClasses)
    {
        $this->stripClasses = $stripClasses;
        return $this;
    }

    public function getStaticMaxLength()
    {
        return $this->staticMaxLength;
    }

    public function setStaticMaxLength($staticMaxLength)
    {
        $this->staticMaxLength = $staticMaxLength;
        return $this;
    }

    public function getDom()
    {
        return $this->dom;
    }

    public function setDom($dom)
    {
        $this->dom = $dom;
        return $this;
    }
}
