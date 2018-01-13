<?php
namespace Cosmetic\Prize;

class PrizeEntity
{
    protected $priid;
    protected $salnumber;
    protected $salname;
    protected $cusnumber;
    protected $cusname;
    protected $prodnumber;
    protected $prodthumbnail;
    protected $prodprice;
    protected $prodtitle;
    protected $priget;
    protected $pridate;
    protected $priexpiration;
  
    /**
     * @return the $priid
     */
    public function getPriid()
    {
        return $this->priid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $salname
     */
    public function getSalname()
    {
        return $this->salname;
    }

    /**
     * @return the $cusnumber
     */
    public function getCusnumber()
    {
        return $this->cusnumber;
    }

    /**
     * @return the $cusname
     */
    public function getCusname()
    {
        return $this->cusname;
    }

    /**
     * @return the $prodnumber
     */
    public function getProdnumber()
    {
        return $this->prodnumber;
    }

    /**
     * @return the $prodthumbnail
     */
    public function getProdthumbnail()
    {
        return $this->prodthumbnail;
    }

    /**
     * @return the $prodprice
     */
    public function getProdprice()
    {
        return $this->prodprice;
    }

    /**
     * @return the $prodtitle
     */
    public function getProdtitle()
    {
        return $this->prodtitle;
    }



    /**
     * @return the $priget
     */
    public function getPriget()
    {
        return $this->priget;
    }

    /**
     * @return the $pridate
     */
    public function getPridate()
    {
        return $this->pridate;
    }

    /**
     * @return the $priexpiration
     */
    public function getPriexpiration()
    {
        return $this->priexpiration;
    }

    /**
     * @param field_type $priid
     */
    public function setPriid($priid)
    {
        $this->priid = $priid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $salname
     */
    public function setSalname($salname)
    {
        $this->salname = $salname;
    }

    /**
     * @param field_type $cusnumber
     */
    public function setCusnumber($cusnumber)
    {
        $this->cusnumber = $cusnumber;
    }

    /**
     * @param field_type $cusname
     */
    public function setCusname($cusname)
    {
        $this->cusname = $cusname;
    }

    /**
     * @param field_type $prodnumber
     */
    public function setProdnumber($prodnumber)
    {
        $this->prodnumber = $prodnumber;
    }

    /**
     * @param field_type $prodthumbnail
     */
    public function setProdthumbnail($prodthumbnail)
    {
        $this->prodthumbnail = $prodthumbnail;
    }

    /**
     * @param field_type $prodprice
     */
    public function setProdprice($prodprice)
    {
        $this->prodprice = $prodprice;
    }

    /**
     * @param field_type $prodtitle
     */
    public function setProdtitle($prodtitle)
    {
        $this->prodtitle = $prodtitle;
    }



    /**
     * @param field_type $priget
     */
    public function setPriget($priget)
    {
        $this->priget = $priget;
    }

    /**
     * @param string $pridate
     */
    public function setPridate($pridate)
    {
        $this->pridate = $pridate;
    }

    /**
     * @param field_type $priexpiration
     */
    public function setPriexpiration($priexpiration)
    {
        $this->priexpiration = $priexpiration;
    }

    
    
    
    
}