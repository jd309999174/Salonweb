<?php
namespace Cosmetic\Stage;

class StageEntity
{
    protected $staid;
    protected $treid;
    protected $salnumber;
    protected $cosid;
    protected $stascore;
    protected $stacomment;
    protected $stacommentdate;
    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    public function __construct()
    {
        $this->stacommentdate = date('Y-m-d H:i:s');
    }
    /**
     * @return the $staid
     */
    public function getStaid()
    {
        return $this->staid;
    }

    /**
     * @return the $treid
     */
    public function getTreid()
    {
        return $this->treid;
    }

    /**
     * @return the $cosid
     */
    public function getCosid()
    {
        return $this->cosid;
    }

    /**
     * @return the $stascore
     */
    public function getStascore()
    {
        return $this->stascore;
    }

    /**
     * @return the $stacomment
     */
    public function getStacomment()
    {
        return $this->stacomment;
    }

    /**
     * @return the $stacommentdate
     */
    public function getStacommentdate()
    {
        return $this->stacommentdate;
    }

    /**
     * @param field_type $staid
     */
    public function setStaid($staid)
    {
        $this->staid = $staid;
    }

    /**
     * @param field_type $treid
     */
    public function setTreid($treid)
    {
        $this->treid = $treid;
    }

    /**
     * @param field_type $cosid
     */
    public function setCosid($cosid)
    {
        $this->cosid = $cosid;
    }

    /**
     * @param field_type $stascore
     */
    public function setStascore($stascore)
    {
        $this->stascore = $stascore;
    }

    /**
     * @param field_type $stacomment
     */
    public function setStacomment($stacomment)
    {
        $this->stacomment = $stacomment;
    }

    /**
     * @param string $stacommentdate
     */
    public function setStacommentdate($stacommentdate)
    {
        $this->stacommentdate = $stacommentdate;
    }

    
    
    
}