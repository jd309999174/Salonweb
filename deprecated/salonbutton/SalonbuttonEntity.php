<?php
namespace Cosmetic\Salonbutton;

class SalonbuttonEntity
{
    protected $sbid;
    protected $salnumber;
    protected $salonbutton;
    /**
     * @return the $sbid
     */
    public function getSbid()
    {
        return $this->sbid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $salonbutton
     */
    public function getSalonbutton()
    {
        return $this->salonbutton;
    }

    /**
     * @param field_type $sbid
     */
    public function setSbid($sbid)
    {
        $this->sbid = $sbid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $salonbutton
     */
    public function setSalonbutton($salonbutton)
    {
        $this->salonbutton = $salonbutton;
    }

 

    
    
    
}