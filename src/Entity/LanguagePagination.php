<?php

namespace Datatable\Entity;

use Datatable\LanguageConfig;

class LanguagePagination extends Option
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
}
