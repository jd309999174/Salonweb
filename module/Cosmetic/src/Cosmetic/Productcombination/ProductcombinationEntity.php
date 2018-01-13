<?php
namespace Cosmetic\Productcombination;

class ProductcombinationEntity
{
     protected $productcombinationid;
     protected $prodid;
     protected $salnumber;
     protected $productcombinationprice;
     protected $productcombinationpicture;
     protected $productcombinationname;
    /**
     * @return the $productcombinationid
     */
    public function getProductcombinationid()
    {
        return $this->productcombinationid;
    }

    /**
     * @return the $prodid
     */
    public function getProdid()
    {
        return $this->prodid;
    }

    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
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
     * @param field_type $productcombinationid
     */
    public function setProductcombinationid($productcombinationid)
    {
        $this->productcombinationid = $productcombinationid;
    }

    /**
     * @param field_type $prodid
     */
    public function setProdid($prodid)
    {
        $this->prodid = $prodid;
    }

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
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

    
     
}