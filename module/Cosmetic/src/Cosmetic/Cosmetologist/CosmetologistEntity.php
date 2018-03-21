<?php
namespace Cosmetic\Cosmetologist;

class CosmetologistEntity {
   protected $cosid;
   protected $cosnumber;
   protected $salnumber;
   protected $salbranch;
   protected $cosname;
   protected $cosbirthday;
   protected $cosaddress;
   protected $cosphone;
   protected $cosphoto;
   protected $cospassword;
   protected $cosposition;
   protected $cosspeciality;
   protected $cosyears;
   protected $cosidentity;
   protected $cosregdate;
   protected $currentstate;
   protected $currentip;
   protected $unread;
   protected $recentstar;
   protected $pageid;
   protected $tipsum;
   protected $tiptimes;
   
   
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
     * @return the $recentstar
     */
    public function getRecentstar()
    {
        return $this->recentstar;
    }

/**
     * @param field_type $recentstar
     */
    public function setRecentstar($recentstar)
    {
        $this->recentstar = $recentstar;
    }

    /**
     * @return the $unread
     */
    public function getUnread()
    {
        return $this->unread;
    }

/**
     * @param field_type $unread
     */
    public function setUnread($unread)
    {
        $this->unread = $unread;
    }

    /**
     * @return the $cospassword
     */
    public function getCospassword()
    {
        return $this->cospassword;
    }

/**
     * @param field_type $cospassword
     */
    public function setCospassword($cospassword)
    {
        $this->cospassword = $cospassword;
    }

public function __construct()
   {
       $this->cosregdate = date('Y-m-d H:i:s');
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
     * @return the $cosid
     */
    public function getCosid()
    {
        return $this->cosid;
    }

/**
     * @return the $cosnumber
     */
    public function getCosnumber()
    {
        return $this->cosnumber;
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
     * @return the $cosname
     */
    public function getCosname()
    {
        return $this->cosname;
    }

/**
     * @return the $cosbirthday
     */
    public function getCosbirthday()
    {
        return $this->cosbirthday;
    }

/**
     * @return the $cosaddress
     */
    public function getCosaddress()
    {
        return $this->cosaddress;
    }

/**
     * @return the $cosphone
     */
    public function getCosphone()
    {
        return $this->cosphone;
    }

/**
     * @return the $cosphoto
     */
    public function getCosphoto()
    {
        return $this->cosphoto;
    }

/**
     * @return the $cosposition
     */
    public function getCosposition()
    {
        return $this->cosposition;
    }

/**
     * @return the $cosspeciality
     */
    public function getCosspeciality()
    {
        return $this->cosspeciality;
    }

/**
     * @return the $cosyears
     */
    public function getCosyears()
    {
        return $this->cosyears;
    }

/**
     * @return the $cosidentity
     */
    public function getCosidentity()
    {
        return $this->cosidentity;
    }

/**
     * @return the $cosregdate
     */
    public function getCosregdate()
    {
        return $this->cosregdate;
    }

/**
     * @param field_type $cosid
     */
    public function setCosid($cosid)
    {
        $this->cosid = $cosid;
    }

/**
     * @param field_type $cosnumber
     */
    public function setCosnumber($cosnumber)
    {
        $this->cosnumber = $cosnumber;
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
     * @param field_type $cosname
     */
    public function setCosname($cosname)
    {
        $this->cosname = $cosname;
    }

/**
     * @param field_type $cosbirthday
     */
    public function setCosbirthday($cosbirthday)
    {
        $this->cosbirthday = $cosbirthday;
    }

/**
     * @param field_type $cosaddress
     */
    public function setCosaddress($cosaddress)
    {
        $this->cosaddress = $cosaddress;
    }

/**
     * @param field_type $cosphone
     */
    public function setCosphone($cosphone)
    {
        $this->cosphone = $cosphone;
    }

/**
     * @param field_type $cosphoto
     */
    public function setCosphoto($cosphoto)
    {
        $this->cosphoto = $cosphoto;
    }

/**
     * @param field_type $cosposition
     */
    public function setCosposition($cosposition)
    {
        $this->cosposition = $cosposition;
    }

/**
     * @param field_type $cosspeciality
     */
    public function setCosspeciality($cosspeciality)
    {
        $this->cosspeciality = $cosspeciality;
    }

/**
     * @param field_type $cosyears
     */
    public function setCosyears($cosyears)
    {
        $this->cosyears = $cosyears;
    }

/**
     * @param field_type $cosidentity
     */
    public function setCosidentity($cosidentity)
    {
        $this->cosidentity = $cosidentity;
    }

/**
     * @param string $cosregdate
     */
    public function setCosregdate($cosregdate)
    {
        $this->cosregdate = $cosregdate;
    }


   
   
}