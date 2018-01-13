<?php
namespace Cosmetic\Saloncouponissue;

class SaloncouponissueEntity
{
    protected $sciid;
    protected $salnumber;
    protected $cusid;
    protected $scirestriction;
    protected $scimoney;
    protected $sciavailable;
    protected $comparedate;
    protected $scitimes;
    
    /**
     * @return the $comparedate
     */
    public function getComparedate()
    {
        return $this->comparedate;
    }

    /**
     * @param field_type $comparedate
     */
    public function setComparedate($comparedate)
    {
        $this->comparedate = $comparedate;
    }

    /**
     * @return the $sciavailable
     */
    public function getSciavailable()
    {
        return $this->sciavailable;
    }

    /**
     * @return the $scitimes
     */
    public function getScitimes()
    {
        return $this->scitimes;
    }

    /**
     * @param field_type $sciavailable
     */
    public function setSciavailable($sciavailable)
    {
        $this->sciavailable = $sciavailable;
    }

    /**
     * @param field_type $scitimes
     */
    public function setScitimes($scitimes)
    {
        $this->scitimes = $scitimes;
    }

    /**
     * @return the $sciid
     */
    public function getSciid()
    {
        return $this->sciid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }



    /**
     * @return the $scirestriction
     */
    public function getScirestriction()
    {
        return $this->scirestriction;
    }

    /**
     * @return the $scimoney
     */
    public function getScimoney()
    {
        return $this->scimoney;
    }

    /**
     * @param field_type $sciid
     */
    public function setSciid($sciid)
    {
        $this->sciid = $sciid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

 

    /**
     * @return the $cusid
     */
    public function getCusid()
    {
        return $this->cusid;
    }

    /**
     * @param field_type $cusid
     */
    public function setCusid($cusid)
    {
        $this->cusid = $cusid;
    }

    /**
     * @param field_type $scirestriction
     */
    public function setScirestriction($scirestriction)
    {
        $this->scirestriction = $scirestriction;
    }

    /**
     * @param field_type $scimoney
     */
    public function setScimoney($scimoney)
    {
        $this->scimoney = $scimoney;
    }


    
    
    
}