<?php
namespace Cosmetic\Salonslide;

class SalonslideEntity
{
    protected $ssid;
    protected $salnumber;
    protected $ssphoto1;
    protected $ssphoto2;
    protected $ssphoto3;
    protected $sssrc1;
    protected $sssrc2;
    protected $sssrc3;
    /**
     * @return the $ssid
     */
    public function getSsid()
    {
        return $this->ssid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $ssphoto1
     */
    public function getSsphoto1()
    {
        return $this->ssphoto1;
    }

    /**
     * @return the $ssphoto2
     */
    public function getSsphoto2()
    {
        return $this->ssphoto2;
    }

    /**
     * @return the $ssphoto3
     */
    public function getSsphoto3()
    {
        return $this->ssphoto3;
    }

    /**
     * @return the $sssrc1
     */
    public function getSssrc1()
    {
        return $this->sssrc1;
    }

    /**
     * @return the $sssrc2
     */
    public function getSssrc2()
    {
        return $this->sssrc2;
    }

    /**
     * @return the $sssrc3
     */
    public function getSssrc3()
    {
        return $this->sssrc3;
    }

    /**
     * @param field_type $ssid
     */
    public function setSsid($ssid)
    {
        $this->ssid = $ssid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $ssphoto1
     */
    public function setSsphoto1($ssphoto1)
    {
        $this->ssphoto1 = $ssphoto1;
    }

    /**
     * @param field_type $ssphoto2
     */
    public function setSsphoto2($ssphoto2)
    {
        $this->ssphoto2 = $ssphoto2;
    }

    /**
     * @param field_type $ssphoto3
     */
    public function setSsphoto3($ssphoto3)
    {
        $this->ssphoto3 = $ssphoto3;
    }

    /**
     * @param field_type $sssrc1
     */
    public function setSssrc1($sssrc1)
    {
        $this->sssrc1 = $sssrc1;
    }

    /**
     * @param field_type $sssrc2
     */
    public function setSssrc2($sssrc2)
    {
        $this->sssrc2 = $sssrc2;
    }

    /**
     * @param field_type $sssrc3
     */
    public function setSssrc3($sssrc3)
    {
        $this->sssrc3 = $sssrc3;
    }

    
    
    

    
    
    
}