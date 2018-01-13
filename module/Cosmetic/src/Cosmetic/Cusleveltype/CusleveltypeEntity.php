<?php
namespace Cosmetic\Cusleveltype;

class CusleveltypeEntity
{
    protected $id;
    protected $cusid;
    protected $cuslevel;
    protected $custype;
    protected $cussalonbranch;
    protected $cuspoints;
    


    /**
     * @return the $cuspoints
     */
    public function getCuspoints()
    {
        return $this->cuspoints;
    }

    /**
     * @param field_type $cuspoints
     */
    public function setCuspoints($cuspoints)
    {
        $this->cuspoints = $cuspoints;
    }

    /**
     * @return the $cussalonbranch
     */
    public function getCussalonbranch()
    {
        return $this->cussalonbranch;
    }

    /**
     * @param field_type $cussalonbranch
     */
    public function setCussalonbranch($cussalonbranch)
    {
        $this->cussalonbranch = $cussalonbranch;
    }

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
     * @return the $cuslevel
     */
    public function getCuslevel()
    {
        return $this->cuslevel;
    }

    /**
     * @return the $custype
     */
    public function getCustype()
    {
        return $this->custype;
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
     * @param field_type $cuslevel
     */
    public function setCuslevel($cuslevel)
    {
        $this->cuslevel = $cuslevel;
    }

    /**
     * @param field_type $custype
     */
    public function setCustype($custype)
    {
        $this->custype = $custype;
    }

    public function __construct()
    {
        //$this->created = date('Y-m-d H:i:s');
    }

}