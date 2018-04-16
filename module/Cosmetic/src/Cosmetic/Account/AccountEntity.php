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
    protected $prodsum;
    protected $prodtimes;
    protected $tipsum;
    protected $tiptimes;
    protected $salname;
    protected $saladdress;
    protected $sallicense;
    
    public function __construct()
    {
        $this->accountregdate = date('Y-m-d H:i:s');
        $this->salnumber =date('YmdHis').random_int(100,999);
    }
    
    
    /**
     * @return the $sallicense
     */
    public function getSallicense()
    {
        return $this->sallicense;
    }

    /**
     * @param field_type $sallicense
     */
    public function setSallicense($sallicense)
    {
        $this->sallicense = $sallicense;
    }

    /**
     * @return the $salname
     */
    public function getSalname()
    {
        return $this->salname;
    }

    /**
     * @return the $saladdress
     */
    public function getSaladdress()
    {
        return $this->saladdress;
    }

    /**
     * @param field_type $salname
     */
    public function setSalname($salname)
    {
        $this->salname = $salname;
    }

    /**
     * @param field_type $saladdress
     */
    public function setSaladdress($saladdress)
    {
        $this->saladdress = $saladdress;
    }

    /**
     * @return the $prodsum
     */
    public function getProdsum()
    {
        return $this->prodsum;
    }

    /**
     * @return the $prodtimes
     */
    public function getProdtimes()
    {
        return $this->prodtimes;
    }

    /**
     * @return the $tipsum
     */
    public function getTipsum()
    {
        return $this->tipsum;
    }

    /**
     * @return the $tiptimes
     */
    public function getTiptimes()
    {
        return $this->tiptimes;
    }

    /**
     * @param field_type $prodsum
     */
    public function setProdsum($prodsum)
    {
        $this->prodsum = $prodsum;
    }

    /**
     * @param field_type $prodtimes
     */
    public function setProdtimes($prodtimes)
    {
        $this->prodtimes = $prodtimes;
    }

    /**
     * @param field_type $tipsum
     */
    public function setTipsum($tipsum)
    {
        $this->tipsum = $tipsum;
    }

    /**
     * @param field_type $tiptimes
     */
    public function setTiptimes($tiptimes)
    {
        $this->tiptimes = $tiptimes;
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