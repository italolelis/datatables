<?php

namespace Datatable\Render;

use Datatable\Config;

/**
 * Responsible for rendering the datatable HTML
 * @author Ítalo Lelis de Vietro <italolelis@gmail.com>
 */
class DatatableRenderer implements RenderInterface
{
    /**
     * The DataTable_Config object
     * @var Config
     */
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function render()
    {
        return $this->renderTable();
    }

    /**
     * Render the default table HTML
     *
     * @return string
     */
    protected function renderTable()
    {
        $html = '';
        $html .= "<table cellspacing=\"0\" class=\"{$this->config->getClass()}\" id=\"{$this->config->getTableId()}\">";
        $html .= "<thead><tr>";
        foreach ($this->config->getColumns() as $column) {
            if ($column->isVisible()) {
                $html .= "<th>{$column->getTitle()}</th>";
            } else {
                $html .= "<th style=\"display: none;\">{$column->getTitle()}</th>";
            }
        }
        $html .= "</tr></thead>";
        $html .= "<tbody>";

        if (!$this->config->isServerSideEnabled()) {
            $html .= $this->renderStaticData();
        } else {
            $html .= "<tr><td class=\"dataTables_empty\">{$this->config->getLoadingHtml()}</td></tr>";
        }

        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "<!-- Built with italolelis/datatables -->";

        return $html;
    }

    /**
     * Render the DataTable instantiation javascript code
     */
    public function renderJs()
    {
        $js = "
			<script type=\"text/javascript\">
			    $(document).ready(function(){
					var {$this->config->getTableId()} = $('#{$this->config->getTableId()}').dataTable({$this->renderDataTableOptions()});
			    });
			</script>
		";
        return $js;
    }

    /**
     * Convert all the DataTable_Config options into a javascript array string
     *
     * @return string
     */
    protected function renderDataTableOptions()
    {
        $options = [];
        $options["bPaginate"] = $this->config->isPaginationEnabled();
        $options["bLengthChange"] = $this->config->isLengthChangeEnabled();
        $options["bProcessing"] = $this->config->isProcessingEnabled();
        $options["bFilter"] = $this->config->isFilterEnabled();
        $options["bSort"] = $this->config->isSortEnabled();
        $options["bInfo"] = $this->config->isInfoEnabled();
        $options["bAutoWidth"] = $this->config->isAutoWidthEnabled();
        $options["bScrollCollapse"] = $this->config->isScrollCollapseEnabled();
        $options["bScrollInfinite"] = $this->config->isScrollInfiniteEnabled();
        $options["iDisplayLength"] = $this->config->getDisplayLength();
        $options["bJQueryUI"] = $this->config->isJQueryUIEnabled();
        $options["sPaginationType"] = $this->config->getPaginationType();
        $options["bStateSave"] = $this->config->isSaveStateEnabled();
        $options["iCookieDuration"] = $this->config->getCookieDuration();
        $options["asStripClasses"] = $this->config->getStripClasses();

        $options["aoColumns"] = $this->renderDataTableColumnOptions();
        $options["aaSorting"] = $this->renderDefaultSortColumns();
        $options["aLengthMenu"] = $this->renderLengthMenu();

        if ($this->config->isServerSideEnabled()) {
            $options["bServerSide"] = $this->config->isServerSideEnabled();
            $options["sAjaxSource"] = $this->config->getAjaxSource();
        }

        if (!is_null($this->config->getScrollX())) {
            $options["sScrollX"] = $this->config->getScrollX();
        }
        if (!is_null($this->config->getScrollY())) {
            $options["sScrollY"] = $this->config->getScrollY();
        }

        if (!is_null($this->config->getScrollLoadGap())) {
            $options["iScrollLoadGap"] = $this->config->getScrollLoadGap();
        }

        if (!is_null($this->config->getLanguageConfig())) {
            $options["oLanguage"] = $this->renderLanguageConfig();
        }

        if (!is_null($this->config->getCookiePrefix())) {
            $options["sCookiePrefix"] = $this->config->getCookiePrefix();
        }

        if (!is_null($this->config->getDom())) {
            $options["sDom"] = $this->config->getDom();
        }

        // build the initial json object
        $json = json_encode($options);

        // replace keys for functions with actual functions
//        $json = $this->replaceJsonFunctions($json);

        return $json;
    }

    /**
     * This method replaces any keys within the given json string
     * that were created in getCallbackFunctionProxy
     *
     * This essentially is a hack to make sure that the functions
     * don't have double quotes around them which keeps javascript
     * from interpreting them as functions.
     *
     * @param string $json
     * @return mixed|string
     */
    protected function replaceJsonFunctions($json)
    {
        if (!is_null($this->jsonFunctions)) {
            foreach ($this->jsonFunctions as $key => $function) {

                $search = '"' . $key . '"';

                $json = str_replace($search, $function, $json);
            }
        }

        return $json;
    }

    /**
     * Proxy method to call the current object's getRowCallBackFunction() method
     * and clean up the result for the javascript.
     *
     * This method also creates a unique key for each function which it returns
     * for later lookup against the function stored in $this->jsonFunctions
     *
     * @return string
     */
    protected function getCallbackFunctionProxy($function)
    {
        // get the js function string
        $js = call_user_func(array($this, $function));
        $jsonKey = $this->buildJsonFunctionKey($js);

        return $jsonKey;
    }

    /**
     * Build a unique key for the given javascript function
     * and store they key => function in the local jsonFunctions
     * variable.
     *
     * This key will get used later in replaceFunctions to replace
     * the key with the actual function to fix the final json string.
     *
     * @return string
     */
    protected function buildJsonFunctionKey($js)
    {
        // remove comments
        $js = preg_replace('!/\*.*?\*/!s', '', $js);  // removes /* comments */
        $js = preg_replace('!//.*?\n!', '', $js); // removes //comments

        // remove all extra whitespace
        $js = str_replace(array("\t", "\n", "\r\n"), '', trim($js));

        // build a temporary key
        $jsonKey = md5($js);

        // store key => function mapping
        $this->jsonFunctions[$jsonKey] = $js;

        return $jsonKey;
    }

    /**
     * Build the array for the 'aoColumns' DataTable option
     *
     * @return array
     */
    protected function renderDataTableColumnOptions()
    {
        $columns = array();
        foreach ($this->config->getColumns() as $column) {
            $tempColumn = [
                "bSortable" => $column->isSortable(),
                "sName" => $column->getName(),
                "bVisible" => $column->isVisible(),
                "bSearchable" => $column->isSearchable(),
            ];
            if (!is_null($column->getWidth())) {
                $tempColumn['sWidth'] = $column->getWidth();
            }
            if (!is_null($column->getClass())) {
                $tempColumn['sClass'] = $column->getClass();
            }
            if (!is_null($column->getRenderFunction())) {
                $tempColumn['fnRender'] = $this->buildJsonFunctionKey($column->getRenderFunction());
            }

            $columns[] = $tempColumn;
        }
        return $columns;
    }

    /**
     * Build the array for the 'aaSorting' option
     *
     * @return array
     */
    protected function renderDefaultSortColumns()
    {
        $columns = array();
        foreach ($this->config->getColumns() as $id => $column) {
            if ($column->isDefaultSort()) {
                $columns[] = array($id, $column->getDefaultSortDirection());
            }
        }
        return $columns;
    }

    /**
     * Build the array for the 'aLengthMenu' option
     *
     * @return array
     */
    protected function renderLengthMenu()
    {
        return array(array_keys($this->config->getLengthMenu()), array_values($this->config->getLengthMenu()));
    }

    /**
     * Build the array for the 'oLanguage' option from the LanguageConfig object
     *
     * @return array
     */
    protected function renderLanguageConfig()
    {
        $options = array();
        $paginate = array();
        if (!is_null($this->config->getLanguageConfig()->getPaginateFirst())) {
            $paginate["sFirst"] = $this->config->getLanguageConfig()->getPaginateFirst();
        }
        if (!is_null($this->config->getLanguageConfig()->getPaginateLast())) {
            $paginate["sLast"] = $this->config->getLanguageConfig()->getPaginateLast();
        }
        if (!is_null($this->config->getLanguageConfig()->getPaginateNext())) {
            $paginate["sNext"] = $this->config->getLanguageConfig()->getPaginateNext();
        }
        if (!is_null($this->config->getLanguageConfig()->getPaginatePrevious())) {
            $paginate["sPrevious"] = $this->config->getLanguageConfig()->getPaginatePrevious();
        }
        // add oPaginate to options if anything was set for object
        if (count($paginate) > 0) {
            $options["oPaginate"] = $paginate;
        }
        if (!is_null($this->config->getLanguageConfig()->getEmptyTable())) {
            $options["sEmptyTable"] = $this->config->getLanguageConfig()->getEmptyTable();
        }

        if (!is_null($this->config->getLanguageConfig()->getInfo())) {
            $options["sInfo"] = $this->config->getLanguageConfig()->getInfo();
        }

        if (!is_null($this->config->getLanguageConfig()->getInfoEmpty())) {
            $options["sInfoEmpty"] = $this->config->getLanguageConfig()->getInfoEmpty();
        }

        if (!is_null($this->config->getLanguageConfig()->getInfoFiltered())) {
            $options["sInfoFiltered"] = $this->config->getLanguageConfig()->getInfoFiltered();
        }

        if (!is_null($this->config->getLanguageConfig()->getInfoPostFix())) {
            $options["sInfoPostFix"] = $this->config->getLanguageConfig()->getInfoPostFix();
        }

        if (!is_null($this->config->getLanguageConfig()->getLengthMenu())) {
            $options["sLengthMenu"] = $this->config->getLanguageConfig()->getLengthMenu();
        }

        if (!is_null($this->config->getLanguageConfig()->getSearch())) {
            $options["sSearch"] = $this->config->getLanguageConfig()->getSearch();
        }
        if (!is_null($this->config->getLanguageConfig()->getZeroRecords())) {
            $options["sZeroRecords"] = $this->config->getLanguageConfig()->getZeroRecords();
        }

        if (!is_null($this->config->getLanguageConfig()->getUrl())) {
            $options["sUrl"] = $this->config->getLanguageConfig()->getUrl();
        }
        return $options;
    }
}
