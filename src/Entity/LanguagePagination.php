<?php

namespace Datatable\Entity;


use Datatable\LanguageConfig;

class LanguagePagination implements \JsonSerializable
{
    protected $sFirst;
    protected $sLast;
    protected $sNext;
    protected $sPrevious;

    /**
     * @return mixed
     */
    public function getSFirst()
    {
        return $this->sFirst;
    }

    /**
     * @param mixed $sFirst
     * @return $this
     */
    public function setSFirst($sFirst)
    {
        $this->sFirst = $sFirst;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSLast()
    {
        return $this->sLast;
    }

    /**
     * @param mixed $sLast
     * @return $this
     */
    public function setSLast($sLast)
    {
        $this->sLast = $sLast;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSNext()
    {
        return $this->sNext;
    }

    /**
     * @param mixed $sNext
     * @return $this
     */
    public function setSNext($sNext)
    {
        $this->sNext = $sNext;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSPrevious()
    {
        return $this->sPrevious;
    }

    /**
     * @param mixed $sPrevious
     * @return $this
     */
    public function setSPrevious($sPrevious)
    {
        $this->sPrevious = $sPrevious;
        return $this;
    }

    public static function fromConfig(LanguageConfig $config)
    {
        $pagination = new self();
        return $pagination->setSFirst($config->getPaginateFirst())
            ->setSLast($config->getPaginateLast())
            ->setSNext($config->getPaginateNext())
            ->setSPrevious($config->getPaginatePrevious());
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $json = array();
        foreach ($this as $key => $value) {
            if ($value) {
                $json[$key] = $value;
            }
        }
        return $json;
    }
}