<?php
/**
 * Created by PhpStorm.
 * User: byoung
 * Date: 11/27/2015
 * Time: 12:33 PM
 */

namespace App;


class ProductImportOptions
{
    private $vendorId;
    private $uuid = '';
    private $fileName = '';
    private $includeHeaders = true;
    private $addAsActive = false;
    private $ignoreExisting = false;
    private $simulate = false;

    /**
     * ProductImportOptions constructor.
     */
    public function __construct()
    {

    }


    /**
     * @return mixed
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * @param mixed $vendorId
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return boolean
     */
    public function isIncludeHeaders()
    {
        return $this->includeHeaders;
    }

    /**
     * @param boolean $includeHeaders
     */
    public function setIncludeHeaders($includeHeaders)
    {
        $this->includeHeaders = $includeHeaders;
    }

    /**
     * @return boolean
     */
    public function isAddAsActive()
    {
        return $this->addAsActive;
    }

    /**
     * @param boolean $addAsActive
     */
    public function setAddAsActive($addAsActive)
    {
        $this->addAsActive = $addAsActive;
    }

    /**
     * @return boolean
     */
    public function isIgnoreExisting()
    {
        return $this->ignoreExisting;
    }

    /**
     * @param boolean $ignoreExisting
     */
    public function setIgnoreExisting($ignoreExisting)
    {
        $this->ignoreExisting = $ignoreExisting;
    }

    /**
     * @return boolean
     */
    public function isSimulate()
    {
        return $this->simulate;
    }

    /**
     * @param boolean $simulate
     */
    public function setSimulate($simulate)
    {
        $this->simulate = $simulate;
    }



}