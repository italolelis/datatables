<?php

namespace Datatable\Render;

use Collections\ArrayList;
use Datatable\Column;
use Datatable\Config;
use Datatable\DataResult;
use Datatable\Entity\DatatableOptions;
use Datatable\Entity\LanguageOptions;
use Datatable\Entity\LanguagePagination;
use Symfony\Component\PropertyAccess\PropertyAccess;

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

    public function render($data = null)
    {
        if (!$data instanceof DataResult) {
            $data = new DataResult($data, count($data));
        }
        return $this->renderTable($data);
    }

    /**
     * Render the DataTable instantiation javascript code
     */
    public function renderJs()
    {
        $options = json_encode($this->renderDataTableOptions());
        $js = "<script type=\"text/javascript\">$(document).ready(function(){var {$this->config->getTableId()} = $('#{$this->config->getTableId()}').dataTable({$options});});</script>";
        return $js;
    }

    /**
     * Render the default table HTML
     *
     * @param DataResult $data
     * @return string
     */
    protected function renderTable(DataResult $data = null)
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
            $html .= $this->renderStaticData($data);
        } else {
            $html .= "<tr><td class=\"dataTables_empty\">{$this->config->getLoadingHtml()}</td></tr>";
        }

        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "<!-- Built with italolelis/datatables -->";

        return $html;
    }

    /**
     * Render the table rows for a non-ajax datatable
     *
     * @param DataResult $dataResult
     * @return string
     */
    protected function renderStaticData(DataResult $dataResult)
    {
        $data = $dataResult->getData();
        $html = '';

        foreach ($data as $object) {
            $row = '';
            foreach ($this->config->getColumns() as $column) {
                $value = $this->getDataForColumn($object, $column);

                if ($column->isVisible()) {
                    $row .= "<td>{$value}</td>";
                } else {
                    $row .= "<td style=\"display: none;\">{$value}</td>";
                }
            }
            $html .= "<tr>{$row}</tr>";
        }

        return $html;
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

    /**
     * Convert all the DataTable_Config options into a javascript array string
     *
     * @return string
     */
    protected function renderDataTableOptions()
    {
        $options = DatatableOptions::fromConfig($this->config);
        $options->setAoColumns($this->renderDataTableColumnOptions())
            ->setAaSorting($this->renderDefaultSortColumns())
            ->setALengthMenu($this->renderLengthMenu());

        if ($this->config->getLanguageConfig()) {
            $options->setOLanguage($this->renderLanguageConfig());
        }

        return $options;
    }

    /**
     * Build the array for the 'aoColumns' DataTable option
     *
     * @return array
     */
    protected function renderDataTableColumnOptions()
    {
        $columns = [];
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
     * @return ArrayList
     */
    protected function renderDefaultSortColumns()
    {
        $columns = new ArrayList();
        foreach ($this->config->getColumns() as $id => $column) {
            if ($column->isDefaultSort()) {
                $columns->add([$id, $column->getDefaultSortDirection()]);
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
        return new ArrayList([array_keys($this->config->getLengthMenu()->toArray()), $this->config->getLengthMenu()->values()]);
    }

    /**
     * Build the array for the 'oLanguage' option from the LanguageConfig object
     *
     * @return array
     */
    protected function renderLanguageConfig()
    {
        $pagination = LanguagePagination::fromConfig($this->config->getLanguageConfig());
        $options = LanguageOptions::fromConfig($this->config->getLanguageConfig());
        $options->setOPaginate($pagination);
        return $options;
    }
}
