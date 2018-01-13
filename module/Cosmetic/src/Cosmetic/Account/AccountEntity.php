<?php
namespace Cosmetic\Account;

class AccountEntity
{
    protected $accountid;
    protected $salnumber;
    protected $salaccount;
    protected $salpassword;
    protected $salbossname;
    protected $salbossphone;
    protected $salbossphoto;
    protected $salbossidentity;
    protected $accountregdate;
    
    public function __construct()
    {
        $this->accountregdate = date('Y-m-d H:i:s');
    }
    /**
     * @return the $accountid
     */
    public function getAccountid()
    {
        return $this->accountid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $salaccount
     */
    public function getSalaccount()
    {
        return $this->salaccount;
    }

    /**
     * @return the $salpassword
     */
    public function getSalpassword()
    {
        return $this->salpassword;
    }

    /**
     * @return the $salbossname
     */
    public function getSalbossname()
    {
        return $this->salbossname;
    }

    /**
     * @return the $salbossphone
     */
    public function getSalbossphone()
    {
        return $this->salbossphone;
    }

    /**
     * @return the $salbossphoto
     */
    public function getSalbossphoto()
    {
        return $this->salbossphoto;
    }

    /**
     * @return the $salbossidentity
     */
    public function getSalbossidentity()
    {
        return $this->salbossidentity;
    }

    /**
     * @return the $accountregdate
     */
    public function getAccountregdate()
    {
        return $this->accountregdate;
    }

    /**
     * @param field_type $accountid
     */
    public function setAccountid($accountid)
    {
        $this->accountid = $accountid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $salaccount
     */
    public function setSalaccount($salaccount)
    {
        $this->salaccount = $salaccount;
    }

    /**
     * @param field_type $salpassword
     */
    public function setSalpassword($salpassword)
    {
        $this->salpassword = $salpassword;
    }

    /**
     * @param field_type $salbossname
     */
    public function setSalbossname($salbossname)
    {
        $this->salbossname = $salbossname;
    }

    /**
     * @param field_type $salbossphone
     */
    public function setSalbossphone($salbossphone)
    {
        $this->salbossphone = $salbossphone;
    }

    /**
     * @param field_type $salbossphoto
     */
    public function setSalbossphoto($salbossphoto)
    {
        $this->salbossphoto = $salbossphoto;
    }

    /**
     * @param field_type $salbossidentity
     */
    public function setSalbossidentity($salbossidentity)
    {
        $this->salbossidentity = $salbossidentity;
    }

    /**
     * @param string $accountregdate
     */
    public function setAccountregdate($accountregdate)
    {
        $this->accountregdate = $accountregdate;
    }

    
    
    
}