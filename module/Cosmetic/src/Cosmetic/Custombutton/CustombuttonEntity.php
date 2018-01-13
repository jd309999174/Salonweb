<?php
namespace Cosmetic\Custombutton;

class CustombuttonEntity
{
    protected $buttonid;
    protected $salnumber;
    protected $buttonname;
    protected $buttonlink;
    /**
     * @return the $buttonid
     */
    public function getButtonid()
    {
        return $this->buttonid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $buttonname
     */
    public function getButtonname()
    {
        return $this->buttonname;
    }

    /**
     * @return the $buttonlink
     */
    public function getButtonlink()
    {
        return $this->buttonlink;
    }

    /**
     * @param field_type $buttonid
     */
    public function setButtonid($buttonid)
    {
        $this->buttonid = $buttonid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $buttonname
     */
    public function setButtonname($buttonname)
    {
        $this->buttonname = $buttonname;
    }

    /**
     * @param field_type $buttonlink
     */
    public function setButtonlink($buttonlink)
    {
        $this->buttonlink = $buttonlink;
    }

}