<?php
namespace Cosmetic\Tip;

class TipEntity
{
    protected $id;
    protected $cusid;
    protected $cusname;
    protected $cusphoto;
    protected $cosid;
    protected $cosname;
    protected $cosphoto;
    protected $salnumber;
    protected $tipstate;
    protected $orderid;
    protected $gmtclose;
    protected $paymethod;
    protected $payid;
    protected $tipmoney;
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
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
     * @return the $cosid
     */
    public function getCosid()
    {
        return $this->cosid;
    }

    /**
     * @return the $cosname
     */
    public function getCosname()
    {
        return $this->cosname;
    }

    /**
     * @return the $cosphoto
     */
    public function getCosphoto()
    {
        return $this->cosphoto;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $tipstate
     */
    public function getTipstate()
    {
        return $this->tipstate;
    }

    /**
     * @return the $orderid
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * @return the $gmtclose
     */
    public function getGmtclose()
    {
        return $this->gmtclose;
    }

    /**
     * @return the $paymethod
     */
    public function getPaymethod()
    {
        return $this->paymethod;
    }

    /**
     * @return the $payid
     */
    public function getPayid()
    {
        return $this->payid;
    }

    /**
     * @return the $tipmoney
     */
    public function getTipmoney()
    {
        return $this->tipmoney;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @param field_type $cosid
     */
    public function setCosid($cosid)
    {
        $this->cosid = $cosid;
    }

    /**
     * @param field_type $cosname
     */
    public function setCosname($cosname)
    {
        $this->cosname = $cosname;
    }

    /**
     * @param field_type $cosphoto
     */
    public function setCosphoto($cosphoto)
    {
        $this->cosphoto = $cosphoto;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $tipstate
     */
    public function setTipstate($tipstate)
    {
        $this->tipstate = $tipstate;
    }

    /**
     * @param field_type $orderid
     */
    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;
    }

    /**
     * @param field_type $gmtclose
     */
    public function setGmtclose($gmtclose)
    {
        $this->gmtclose = $gmtclose;
    }

    /**
     * @param field_type $paymethod
     */
    public function setPaymethod($paymethod)
    {
        $this->paymethod = $paymethod;
    }

    /**
     * @param field_type $payid
     */
    public function setPayid($payid)
    {
        $this->payid = $payid;
    }

    /**
     * @param field_type $tipmoney
     */
    public function setTipmoney($tipmoney)
    {
        $this->tipmoney = $tipmoney;
    }

    
    
    
}