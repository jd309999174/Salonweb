<?php
namespace Cosmetic\Lottery;

class LotteryEntity
{
    protected $id;
    protected $salnumber;
    protected $cusid;
    protected $cusname;
    protected $cusphone;
    protected $cusphoto;
    protected $winningtime;
    protected $prizepicture;
    protected $receivetime;
    protected $receivestate;
    
    public function __construct()
    {
        $this->winningtime = time();
    }
    
    /**
     * @return the $cusphone
     */
    public function getCusphone()
    {
        return $this->cusphone;
    }

    /**
     * @param field_type $cusphone
     */
    public function setCusphone($cusphone)
    {
        $this->cusphone = $cusphone;
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
     * @return the $winningtime
     */
    public function getWinningtime()
    {
        return $this->winningtime;
    }

    /**
     * @return the $prizepicture
     */
    public function getPrizepicture()
    {
        return $this->prizepicture;
    }

    /**
     * @return the $receivetime
     */
    public function getReceivetime()
    {
        return $this->receivetime;
    }

    /**
     * @return the $receivestate
     */
    public function getReceivestate()
    {
        return $this->receivestate;
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
     * @param field_type $winningtime
     */
    public function setWinningtime($winningtime)
    {
        $this->winningtime = $winningtime;
    }

    /**
     * @param field_type $prizepicture
     */
    public function setPrizepicture($prizepicture)
    {
        $this->prizepicture = $prizepicture;
    }

    /**
     * @param field_type $receivetime
     */
    public function setReceivetime($receivetime)
    {
        $this->receivetime = $receivetime;
    }

    /**
     * @param field_type $receivestate
     */
    public function setReceivestate($receivestate)
    {
        $this->receivestate = $receivestate;
    }

    

}