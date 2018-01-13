<?php
namespace Cosmetic\Notificationinfo;

class NotificationinfoEntity
{
    protected $id;
    protected $salnumber;
    protected $nolink;
    protected $notitle;
    protected $nocontent;
    protected $nodate;
    protected $notime;
    protected $comparenodate;

    public function __construct()
    {
        $this->nodate = date('Y-m-d');
        $this->notime = date('H:i:s');
        $this->comparenodate = date('Ymd');
    }
    
    /**
     * @return the $comparenodate
     */
    public function getComparenodate()
    {
        return $this->comparenodate;
    }

    /**
     * @param string $comparenodate
     */
    public function setComparenodate($comparenodate)
    {
        $this->comparenodate = $comparenodate;
    }

    /**
     * @return the $notime
     */
    public function getNotime()
    {
        return $this->notime;
    }

    /**
     * @param string $notime
     */
    public function setNotime($notime)
    {
        $this->notime = $notime;
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
     * @return the $nolink
     */
    public function getNolink()
    {
        return $this->nolink;
    }

    /**
     * @return the $notitle
     */
    public function getNotitle()
    {
        return $this->notitle;
    }

    /**
     * @return the $nocontent
     */
    public function getNocontent()
    {
        return $this->nocontent;
    }

    /**
     * @return the $nodate
     */
    public function getNodate()
    {
        return $this->nodate;
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
     * @param field_type $nolink
     */
    public function setNolink($nolink)
    {
        $this->nolink = $nolink;
    }

    /**
     * @param field_type $notitle
     */
    public function setNotitle($notitle)
    {
        $this->notitle = $notitle;
    }

    /**
     * @param field_type $nocontent
     */
    public function setNocontent($nocontent)
    {
        $this->nocontent = $nocontent;
    }

    /**
     * @param string $nodate
     */
    public function setNodate($nodate)
    {
        $this->nodate = $nodate;
    }

    
    

    

}