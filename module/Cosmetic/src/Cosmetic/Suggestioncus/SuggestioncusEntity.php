<?php
namespace Cosmetic\Suggestioncus;

class SuggestioncusEntity
{
    protected $id;
    protected $salnumber;
    protected $salname;
    protected $salbossname;
    protected $salbossphone;
    protected $salbossphoto;
    protected $cusid;
    protected $cusname;
    protected $cusphone;
    protected $cusphoto;
    protected $cuscomment;
    protected $cuspicture;
    protected $datetime;

    function  __construct(){
        $this->datetime=time();
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
     * @return the $salname
     */
    public function getSalname()
    {
        return $this->salname;
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
     * @return the $cuscomment
     */
    public function getCuscomment()
    {
        return $this->cuscomment;
    }

    /**
     * @return the $cuspicture
     */
    public function getCuspicture()
    {
        return $this->cuspicture;
    }

    /**
     * @return the $datetime
     */
    public function getDatetime()
    {
        return $this->datetime;
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
     * @param field_type $salname
     */
    public function setSalname($salname)
    {
        $this->salname = $salname;
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
     * @param field_type $cuscomment
     */
    public function setCuscomment($cuscomment)
    {
        $this->cuscomment = $cuscomment;
    }

    /**
     * @param field_type $cuspicture
     */
    public function setCuspicture($cuspicture)
    {
        $this->cuspicture = $cuspicture;
    }

    /**
     * @param number $datetime
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    

}