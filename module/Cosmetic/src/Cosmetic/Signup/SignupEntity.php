<?php
namespace Cosmetic\Signup;

class SignupEntity
{
    protected $id;
    protected $salnumber;
    protected $pageid;
    protected $pagename;
    protected $pageexpiration;
    protected $pageheaddata1;
    protected $pageheaddata2;
    protected $cusid;
    protected $cusname;
    protected $cusphone;
    protected $cusphoto;
    protected $signupdate;

    /**
     * @return the $pageexpiration
     */
    public function getPageexpiration()
    {
        return $this->pageexpiration;
    }

    /**
     * @return the $pageheaddata1
     */
    public function getPageheaddata1()
    {
        return $this->pageheaddata1;
    }

    /**
     * @return the $pageheaddata2
     */
    public function getPageheaddata2()
    {
        return $this->pageheaddata2;
    }

    /**
     * @param field_type $pageexpiration
     */
    public function setPageexpiration($pageexpiration)
    {
        $this->pageexpiration = $pageexpiration;
    }

    /**
     * @param field_type $pageheaddata1
     */
    public function setPageheaddata1($pageheaddata1)
    {
        $this->pageheaddata1 = $pageheaddata1;
    }

    /**
     * @param field_type $pageheaddata2
     */
    public function setPageheaddata2($pageheaddata2)
    {
        $this->pageheaddata2 = $pageheaddata2;
    }

    public function __construct()
    {
        $this->signupdate = date('Y-m-d H:i:s');
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
     * @return the $pageid
     */
    public function getPageid()
    {
        return $this->pageid;
    }

    /**
     * @return the $pagename
     */
    public function getPagename()
    {
        return $this->pagename;
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
     * @return the $cusphone
     */
    public function getCusphone()
    {
        return $this->cusphone;
    }

    /**
     * @return the $cusphoto
     */
    public function getCusphoto()
    {
        return $this->cusphoto;
    }

    /**
     * @return the $signupdate
     */
    public function getSignupdate()
    {
        return $this->signupdate;
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
     * @param field_type $pageid
     */
    public function setPageid($pageid)
    {
        $this->pageid = $pageid;
    }

    /**
     * @param field_type $pagename
     */
    public function setPagename($pagename)
    {
        $this->pagename = $pagename;
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
     * @param field_type $cusphone
     */
    public function setCusphone($cusphone)
    {
        $this->cusphone = $cusphone;
    }

    /**
     * @param field_type $cusphoto
     */
    public function setCusphoto($cusphoto)
    {
        $this->cusphoto = $cusphoto;
    }

    /**
     * @param string $signupdate
     */
    public function setSignupdate($signupdate)
    {
        $this->signupdate = $signupdate;
    }


    
    

}