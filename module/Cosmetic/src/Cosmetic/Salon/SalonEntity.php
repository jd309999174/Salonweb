<?php
namespace Cosmetic\Salon;

class SalonEntity
{
    protected $salid;
    protected $salnumber;
    protected $salbranch;
    protected $salname;
    protected $salphone;
    protected $saladdress;
    protected $salphoto1;
    protected $salphoto2;
    protected $salphoto3;
    protected $salregnumber;
    protected $salregdate;
    protected $pageid;

    
   
    /**
     * @return the $pageid
     */
    public function getPageid()
    {
        return $this->pageid;
    }

    /**
     * @param field_type $pageid
     */
    public function setPageid($pageid)
    {
        $this->pageid = $pageid;
    }

    /**
     * @return the $salid
     */
    public function getSalid()
    {
        return $this->salid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $salbranch
     */
    public function getSalbranch()
    {
        return $this->salbranch;
    }

    /**
     * @return the $salname
     */
    public function getSalname()
    {
        return $this->salname;
    }

    /**
     * @return the $salphone
     */
    public function getSalphone()
    {
        return $this->salphone;
    }

    /**
     * @return the $saladdress
     */
    public function getSaladdress()
    {
        return $this->saladdress;
    }

    /**
     * @return the $salphoto1
     */
    public function getSalphoto1()
    {
        return $this->salphoto1;
    }

    /**
     * @return the $salphoto2
     */
    public function getSalphoto2()
    {
        return $this->salphoto2;
    }

    /**
     * @return the $salphoto3
     */
    public function getSalphoto3()
    {
        return $this->salphoto3;
    }

    /**
     * @return the $salregnumber
     */
    public function getSalregnumber()
    {
        return $this->salregnumber;
    }

    /**
     * @return the $salregdate
     */
    public function getSalregdate()
    {
        return $this->salregdate;
    }

    /**
     * @param field_type $salid
     */
    public function setSalid($salid)
    {
        $this->salid = $salid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $salbranch
     */
    public function setSalbranch($salbranch)
    {
        $this->salbranch = $salbranch;
    }

    /**
     * @param field_type $salname
     */
    public function setSalname($salname)
    {
        $this->salname = $salname;
    }

    /**
     * @param field_type $salphone
     */
    public function setSalphone($salphone)
    {
        $this->salphone = $salphone;
    }

    /**
     * @param field_type $saladdress
     */
    public function setSaladdress($saladdress)
    {
        $this->saladdress = $saladdress;
    }

    /**
     * @param field_type $salphoto1
     */
    public function setSalphoto1($salphoto1)
    {
        $this->salphoto1 = $salphoto1;
    }

    /**
     * @param field_type $salphoto2
     */
    public function setSalphoto2($salphoto2)
    {
        $this->salphoto2 = $salphoto2;
    }

    /**
     * @param field_type $salphoto3
     */
    public function setSalphoto3($salphoto3)
    {
        $this->salphoto3 = $salphoto3;
    }

    /**
     * @param field_type $salregnumber
     */
    public function setSalregnumber($salregnumber)
    {
        $this->salregnumber = $salregnumber;
    }

    /**
     * @param string $salregdate
     */
    public function setSalregdate($salregdate)
    {
        $this->salregdate = $salregdate;
    }

    public function __construct()
    {
        $this->salregdate = date('Y-m-d H:i:s');
    }
    
    
}