<?php
namespace Cosmetic\Cusbrowsinghistory;

class CusbrowsinghistoryEntity{
    protected $id;
    protected $salnumber;
    protected $cusid;
    protected $cusname;
    protected $cusphoto;
    protected $cusip;
    protected $cusaddress;
    protected $cusaction;
    protected $cussub;
    protected $custhird;
    protected $cusdate;
    protected $gmtcusdate;
    /**
     * @return the $cusaddress
     */
    public function getCusaddress()
    {
        return $this->cusaddress;
    }

    /**
     * @param field_type $cusaddress
     */
    public function setCusaddress($cusaddress)
    {
        $this->cusaddress = $cusaddress;
    }

    /**
     * @return the $gmtcusdate
     */
    public function getGmtcusdate()
    {
        return $this->gmtcusdate;
    }

    /**
     * @param field_type $gmtcusdate
     */
    public function setGmtcusdate($gmtcusdate)
    {
        $this->gmtcusdate = $gmtcusdate;
    }

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
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
     * @return the $cusname
     */
    public function getCusname()
    {
        return $this->cusname;
    }

    /**
     * @return the $cusphoto
     */
    public function getCusphoto()
    {
        return $this->cusphoto;
    }

    /**
     * @return the $cusip
     */
    public function getCusip()
    {
        return $this->cusip;
    }

    /**
     * @return the $cusaction
     */
    public function getCusaction()
    {
        return $this->cusaction;
    }

    /**
     * @return the $cussub
     */
    public function getCussub()
    {
        return $this->cussub;
    }

    /**
     * @return the $custhird
     */
    public function getCusthird()
    {
        return $this->custhird;
    }

    /**
     * @return the $cusdate
     */
    public function getCusdate()
    {
        return $this->cusdate;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @param field_type $cusname
     */
    public function setCusname($cusname)
    {
        $this->cusname = $cusname;
    }

    /**
     * @param field_type $cusphoto
     */
    public function setCusphoto($cusphoto)
    {
        $this->cusphoto = $cusphoto;
    }

    /**
     * @param field_type $cusip
     */
    public function setCusip($cusip)
    {
        $this->cusip = $cusip;
    }

    /**
     * @param field_type $cusaction
     */
    public function setCusaction($cusaction)
    {
        $this->cusaction = $cusaction;
    }

    /**
     * @param field_type $cussub
     */
    public function setCussub($cussub)
    {
        $this->cussub = $cussub;
    }

    /**
     * @param field_type $custhird
     */
    public function setCusthird($custhird)
    {
        $this->custhird = $custhird;
    }

    /**
     * @param field_type $cusdate
     */
    public function setCusdate($cusdate)
    {
        $this->cusdate = $cusdate;
    }

    
    
}