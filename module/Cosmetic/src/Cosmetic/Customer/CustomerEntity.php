<?php
namespace Cosmetic\Customer;

class CustomerEntity
{
    protected $cusid;
    protected $salnumber;
    protected $cusnumber;
    protected $cusphone;
    protected $cuspassword;
    protected $cusname;
    protected $cusidentity;
    protected $cusaddress;
    protected $cusphoto;
    protected $cusbalance;
    protected $cusregdate;
    protected $cusregdatestamp;
    protected $currentstate;
    protected $currentip;
    protected $unread;
    

    
    public function __construct()
    {
        $this->cusregdate = date('Y-m-d H:i:s');
        $this->cusregdatestamp = time();
    }
    /**
     * @return the $cusid
     */
    public function getCusid()
    {
        return $this->cusid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $cusnumber
     */
    public function getCusnumber()
    {
        return $this->cusnumber;
    }

    /**
     * @return the $cusphone
     */
    public function getCusphone()
    {
        return $this->cusphone;
    }

    /**
     * @return the $cuspassword
     */
    public function getCuspassword()
    {
        return $this->cuspassword;
    }

    /**
     * @return the $cusname
     */
    public function getCusname()
    {
        return $this->cusname;
    }

    /**
     * @return the $cusidentity
     */
    public function getCusidentity()
    {
        return $this->cusidentity;
    }

    /**
     * @return the $cusaddress
     */
    public function getCusaddress()
    {
        return $this->cusaddress;
    }

    /**
     * @return the $cusphoto
     */
    public function getCusphoto()
    {
        return $this->cusphoto;
    }

    /**
     * @return the $cusbalance
     */
    public function getCusbalance()
    {
        return $this->cusbalance;
    }

    /**
     * @return the $cusregdate
     */
    public function getCusregdate()
    {
        return $this->cusregdate;
    }

    /**
     * @return the $cusregdatestamp
     */
    public function getCusregdatestamp()
    {
        return $this->cusregdatestamp;
    }

    /**
     * @return the $currentstate
     */
    public function getCurrentstate()
    {
        return $this->currentstate;
    }

    /**
     * @return the $currentip
     */
    public function getCurrentip()
    {
        return $this->currentip;
    }

    /**
     * @return the $unread
     */
    public function getUnread()
    {
        return $this->unread;
    }

    /**
     * @param field_type $cusid
     */
    public function setCusid($cusid)
    {
        $this->cusid = $cusid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $cusnumber
     */
    public function setCusnumber($cusnumber)
    {
        $this->cusnumber = $cusnumber;
    }

    /**
     * @param field_type $cusphone
     */
    public function setCusphone($cusphone)
    {
        $this->cusphone = $cusphone;
    }

    /**
     * @param field_type $cuspassword
     */
    public function setCuspassword($cuspassword)
    {
        $this->cuspassword = $cuspassword;
    }

    /**
     * @param field_type $cusname
     */
    public function setCusname($cusname)
    {
        $this->cusname = $cusname;
    }

    /**
     * @param field_type $cusidentity
     */
    public function setCusidentity($cusidentity)
    {
        $this->cusidentity = $cusidentity;
    }

    /**
     * @param field_type $cusaddress
     */
    public function setCusaddress($cusaddress)
    {
        $this->cusaddress = $cusaddress;
    }

    /**
     * @param field_type $cusphoto
     */
    public function setCusphoto($cusphoto)
    {
        $this->cusphoto = $cusphoto;
    }

    /**
     * @param field_type $cusbalance
     */
    public function setCusbalance($cusbalance)
    {
        $this->cusbalance = $cusbalance;
    }

    /**
     * @param string $cusregdate
     */
    public function setCusregdate($cusregdate)
    {
        $this->cusregdate = $cusregdate;
    }

    /**
     * @param number $cusregdatestamp
     */
    public function setCusregdatestamp($cusregdatestamp)
    {
        $this->cusregdatestamp = $cusregdatestamp;
    }

    /**
     * @param field_type $currentstate
     */
    public function setCurrentstate($currentstate)
    {
        $this->currentstate = $currentstate;
    }

    /**
     * @param field_type $currentip
     */
    public function setCurrentip($currentip)
    {
        $this->currentip = $currentip;
    }

    /**
     * @param field_type $unread
     */
    public function setUnread($unread)
    {
        $this->unread = $unread;
    }

    
   

    
}