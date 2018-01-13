<?php
namespace Cosmetic\Picture;

class PictureEntity
{
    protected $picid;
    protected $salnumber;
    protected $picturename;
    /**
     * @return the $picid
     */
    public function getPicid()
    {
        return $this->picid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $picturename
     */
    public function getPicturename()
    {
        return $this->picturename;
    }

    /**
     * @param field_type $picid
     */
    public function setPicid($picid)
    {
        $this->picid = $picid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $picturename
     */
    public function setPicturename($picturename)
    {
        $this->picturename = $picturename;
    }

  

    
}