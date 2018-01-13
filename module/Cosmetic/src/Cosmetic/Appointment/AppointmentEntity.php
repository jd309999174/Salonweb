<?php
namespace Cosmetic\Appointment;

class AppointmentEntity
{
    protected $appointmentid;
    protected $cusid;
    protected $cusname;
    protected $cusphone;
    protected $salnumber;
    protected $salbranch;
    protected $salname;
    protected $cosid;
    protected $cosname;
    protected $appointmentregdate;
    protected $appointmentdate;
    protected $appointmenttime;
    protected $appointmentdatetime;
    protected $timecomparison;
    protected $appointmentstate;
    /**
     * @return the $timecomparison
     */
    public function getTimecomparison()
    {
        return $this->timecomparison;
    }

    /**
     * @param field_type $timecomparison
     */
    public function setTimecomparison($timecomparison)
    {
        $this->timecomparison = $timecomparison;
    }

    /**
     * @return the $appointmentdatetime
     */
    public function getAppointmentdatetime()
    {
        return $this->appointmentdatetime;
    }

    /**
     * @param field_type $appointmentdatetime
     */
    public function setAppointmentdatetime($appointmentdatetime)
    {
        $this->appointmentdatetime = $appointmentdatetime;
    }

    /**
     * @return the $appointmentstate
     */
    public function getAppointmentstate()
    {
        return $this->appointmentstate;
    }

    /**
     * @param field_type $appointmentstate
     */
    public function setAppointmentstate($appointmentstate)
    {
        $this->appointmentstate = $appointmentstate;
    }

    /**
     * @return the $salname
     */
    public function getSalname()
    {
        return $this->salname;
    }

    /**
     * @param field_type $salname
     */
    public function setSalname($salname)
    {
        $this->salname = $salname;
    }

    /**
     * @return the $appointmentdate
     */
    public function getAppointmentdate()
    {
        return $this->appointmentdate;
    }

    /**
     * @param field_type $appointmentdate
     */
    public function setAppointmentdate($appointmentdate)
    {
        $this->appointmentdate = $appointmentdate;
    }

    public function __construct()
    {
        $this->appointmentregdate = date('Y-m-d H:i:s');
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
     * @return the $cosname
     */
    public function getCosname()
    {
        return $this->cosname;
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
     * @param field_type $cosname
     */
    public function setCosname($cosname)
    {
        $this->cosname = $cosname;
    }

    /**
     * @return the $appointmentid
     */
    public function getAppointmentid()
    {
        return $this->appointmentid;
    }

    /**
     * @return the $cusid
     */
    public function getCusid()
    {
        return $this->cusid;
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
     * @return the $cosid
     */
    public function getCosid()
    {
        return $this->cosid;
    }

    /**
     * @return the $appointmentregdate
     */
    public function getAppointmentregdate()
    {
        return $this->appointmentregdate;
    }

    /**
     * @return the $appointmenttime
     */
    public function getAppointmenttime()
    {
        return $this->appointmenttime;
    }

    /**
     * @param field_type $appointmentid
     */
    public function setAppointmentid($appointmentid)
    {
        $this->appointmentid = $appointmentid;
    }

    /**
     * @param field_type $cusid
     */
    public function setCusid($cusid)
    {
        $this->cusid = $cusid;
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
     * @param field_type $cosid
     */
    public function setCosid($cosid)
    {
        $this->cosid = $cosid;
    }

    /**
     * @param string $appointmentregdate
     */
    public function setAppointmentregdate($appointmentregdate)
    {
        $this->appointmentregdate = $appointmentregdate;
    }

    /**
     * @param field_type $appointmenttime
     */
    public function setAppointmenttime($appointmenttime)
    {
        $this->appointmenttime = $appointmenttime;
    }

    
    
}