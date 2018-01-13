<?php
namespace Cosmetic\Trolley;

class TrolleyEntity
{
    protected $trolleyid;
    protected $salnumber;
    protected $cusid;
    protected $prodid;
    protected $prodtitle;
    protected $productcombinationid;
    protected $productcombinationprice;
    protected $productcombinationpicture;
    protected $productcombinationname;
    protected $productquantity;
    protected $trolleydate;
    /**
     * @return the $trolleyid
     */
    public function getTrolleyid()
    {
        return $this->trolleyid;
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
     * @return the $prodid
     */
    public function getProdid()
    {
        return $this->prodid;
    }

    /**
     * @return the $prodtitle
     */
    public function getProdtitle()
    {
        return $this->prodtitle;
    }

    /**
     * @return the $productcombinationid
     */
    public function getProductcombinationid()
    {
        return $this->productcombinationid;
    }

    /**
     * @return the $productcombinationprice
     */
    public function getProductcombinationprice()
    {
        return $this->productcombinationprice;
    }

    /**
     * @return the $productcombinationpicture
     */
    public function getProductcombinationpicture()
    {
        return $this->productcombinationpicture;
    }

    /**
     * @return the $productcombinationname
     */
    public function getProductcombinationname()
    {
        return $this->productcombinationname;
    }

    /**
     * @return the $productquantity
     */
    public function getProductquantity()
    {
        return $this->productquantity;
    }

    /**
     * @return the $trolleydate
     */
    public function getTrolleydate()
    {
        return $this->trolleydate;
    }

    /**
     * @param field_type $trolleyid
     */
    public function setTrolleyid($trolleyid)
    {
        $this->trolleyid = $trolleyid;
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
     * @param field_type $prodid
     */
    public function setProdid($prodid)
    {
        $this->prodid = $prodid;
    }

    /**
     * @param field_type $prodtitle
     */
    public function setProdtitle($prodtitle)
    {
        $this->prodtitle = $prodtitle;
    }

    /**
     * @param field_type $productcombinationid
     */
    public function setProductcombinationid($productcombinationid)
    {
        $this->productcombinationid = $productcombinationid;
    }

    /**
     * @param field_type $productcombinationprice
     */
    public function setProductcombinationprice($productcombinationprice)
    {
        $this->productcombinationprice = $productcombinationprice;
    }

    /**
     * @param field_type $productcombinationpicture
     */
    public function setProductcombinationpicture($productcombinationpicture)
    {
        $this->productcombinationpicture = $productcombinationpicture;
    }

    /**
     * @param field_type $productcombinationname
     */
    public function setProductcombinationname($productcombinationname)
    {
        $this->productcombinationname = $productcombinationname;
    }

    /**
     * @param field_type $productquantity
     */
    public function setProductquantity($productquantity)
    {
        $this->productquantity = $productquantity;
    }

    /**
     * @param field_type $trolleydate
     */
    public function setTrolleydate($trolleydate)
    {
        $this->trolleydate = $trolleydate;
    }

    
    
}