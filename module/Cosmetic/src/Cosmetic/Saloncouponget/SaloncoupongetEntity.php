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
    protected $scirestriction;
    protected $comparedate;
    
    /**
     * @return the $scirestriction
     */
    public function getScirestriction()
    {
        return $this->scirestriction;
    }

    /**
     * @return the $comparedate
     */
    public function getComparedate()
    {
        return $this->comparedate;
    }

    /**
     * @param field_type $scirestriction
     */
    public function setScirestriction($scirestriction)
    {
        $this->scirestriction = $scirestriction;
    }

    /**
     * @param field_type $comparedate
     */
    public function setComparedate($comparedate)
    {
        $this->comparedate = $comparedate;
    }

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