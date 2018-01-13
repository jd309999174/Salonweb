<?php
namespace Cosmetic\Demandclassifyseries;

class DemandclassifyseriesEntity
{
    protected $dcsid;
    protected $salnumber;
    protected $dcscolumn;
    protected $dcsname;
    protected $dcsbackground;
    
    /**
     * @return the $dcsbackground
     */
    public function getDcsbackground()
    {
        return $this->dcsbackground;
    }

    /**
     * @param field_type $dcsbackground
     */
    public function setDcsbackground($dcsbackground)
    {
        $this->dcsbackground = $dcsbackground;
    }

    /**
     * @return the $dcsname
     */
    public function getDcsname()
    {
        return $this->dcsname;
    }

    /**
     * @param field_type $dcsname
     */
    public function setDcsname($dcsname)
    {
        $this->dcsname = $dcsname;
    }

    /**
     * @return the $dcsid
     */
    public function getDcsid()
    {
        return $this->dcsid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

   

    /**
     * @return the $dcscolumn
     */
    public function getDcscolumn()
    {
        return $this->dcscolumn;
    }

    /**
     * @param field_type $dcscolumn
     */
    public function setDcscolumn($dcscolumn)
    {
        $this->dcscolumn = $dcscolumn;
    }

    /**
     * @param field_type $dcsid
     */
    public function setDcsid($dcsid)
    {
        $this->dcsid = $dcsid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }




    
  
    
}