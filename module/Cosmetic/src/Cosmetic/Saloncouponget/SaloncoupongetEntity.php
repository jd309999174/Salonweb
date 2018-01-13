<?php
namespace Cosmetic\Saloncouponget;

class SaloncoupongetEntity
{
    protected $scgid;
    protected $salnumber;
    protected $cusid;
    protected $sciid;
    protected $scgstate;
    protected $scimoney;
    /**
     * @return the $scimoney
     */
    public function getScimoney()
    {
        return $this->scimoney;
    }

    /**
     * @param field_type $scimoney
     */
    public function setScimoney($scimoney)
    {
        $this->scimoney = $scimoney;
    }

    /**
     * @return the $scgid
     */
    public function getScgid()
    {
        return $this->scgid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $cusid
     */
    public function getCusid()
    {
        return $this->cusid;
    }

    /**
     * @return the $sciid
     */
    public function getSciid()
    {
        return $this->sciid;
    }

    /**
     * @return the $scgstate
     */
    public function getScgstate()
    {
        return $this->scgstate;
    }

    /**
     * @param field_type $scgid
     */
    public function setScgid($scgid)
    {
        $this->scgid = $scgid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $cusid
     */
    public function setCusid($cusid)
    {
        $this->cusid = $cusid;
    }

    /**
     * @param field_type $sciid
     */
    public function setSciid($sciid)
    {
        $this->sciid = $sciid;
    }

    /**
     * @param field_type $scgstate
     */
    public function setScgstate($scgstate)
    {
        $this->scgstate = $scgstate;
    }

   

    
    
    
}