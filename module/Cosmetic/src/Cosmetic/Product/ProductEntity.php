<?php
namespace Cosmetic\Product;

class ProductEntity
{
    protected $prodid;
    protected $salnumber;
    protected $prodtitle;
    protected $prodprice;
    protected $prodoriginal;
    protected $proddiscount;
    protected $prodpicture1;
    protected $prodpicture2;
    protected $prodpicture3;
    protected $prodpicture4;
    protected $prodpicture5;
    protected $proddescription;
    protected $prodservice;
    protected $proddemandclassifyseries;
    protected $prodbrand;
    protected $prodspecification;
    protected $prodcontent;
    protected $prodfactor;
    protected $prodplace;
    protected $prodapproval;
    protected $prodefficacy;
    protected $prodvalidity;
    protected $prodtreatment;
    protected $prodsales;
    protected $prodregdate;
    
    public function __construct()
    {
        $this->prodregdate = date('Y-m-d H:i:s');
    }
    /**
     * @return the $prodoriginal
     */
    public function getProdoriginal()
    {
        return $this->prodoriginal;
    }

    /**
     * @param field_type $prodoriginal
     */
    public function setProdoriginal($prodoriginal)
    {
        $this->prodoriginal = $prodoriginal;
    }

    /**
     * @return the $prodsales
     */
    public function getProdsales()
    {
        return $this->prodsales;
    }

    /**
     * @return the $prodregdate
     */
    public function getProdregdate()
    {
        return $this->prodregdate;
    }

    /**
     * @param field_type $prodsales
     */
    public function setProdsales($prodsales)
    {
        $this->prodsales = $prodsales;
    }

    /**
     * @param field_type $prodregdate
     */
    public function setProdregdate($prodregdate)
    {
        $this->prodregdate = $prodregdate;
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
     * @return the $prodtitle
     */
    public function getProdtitle()
    {
        return $this->prodtitle;
    }

    /**
     * @return the $prodprice
     */
    public function getProdprice()
    {
        return $this->prodprice;
    }

    /**
     * @return the $proddiscount
     */
    public function getProddiscount()
    {
        return $this->proddiscount;
    }

    /**
     * @return the $prodpicture1
     */
    public function getProdpicture1()
    {
        return $this->prodpicture1;
    }

    /**
     * @return the $prodpicture2
     */
    public function getProdpicture2()
    {
        return $this->prodpicture2;
    }

    /**
     * @return the $prodpicture3
     */
    public function getProdpicture3()
    {
        return $this->prodpicture3;
    }

    /**
     * @return the $prodpicture4
     */
    public function getProdpicture4()
    {
        return $this->prodpicture4;
    }

    /**
     * @return the $prodpicture5
     */
    public function getProdpicture5()
    {
        return $this->prodpicture5;
    }

    /**
     * @return the $proddescription
     */
    public function getProddescription()
    {
        return $this->proddescription;
    }

    /**
     * @return the $prodservice
     */
    public function getProdservice()
    {
        return $this->prodservice;
    }

    /**
     * @return the $proddemandclassifyseries
     */
    public function getProddemandclassifyseries()
    {
        return $this->proddemandclassifyseries;
    }

    /**
     * @return the $prodbrand
     */
    public function getProdbrand()
    {
        return $this->prodbrand;
    }

    /**
     * @return the $prodspecification
     */
    public function getProdspecification()
    {
        return $this->prodspecification;
    }

    /**
     * @return the $prodcontent
     */
    public function getProdcontent()
    {
        return $this->prodcontent;
    }

    /**
     * @return the $prodfactor
     */
    public function getProdfactor()
    {
        return $this->prodfactor;
    }

    /**
     * @return the $prodplace
     */
    public function getProdplace()
    {
        return $this->prodplace;
    }

    /**
     * @return the $prodapproval
     */
    public function getProdapproval()
    {
        return $this->prodapproval;
    }

    /**
     * @return the $prodefficacy
     */
    public function getProdefficacy()
    {
        return $this->prodefficacy;
    }

    /**
     * @return the $prodvalidity
     */
    public function getProdvalidity()
    {
        return $this->prodvalidity;
    }

    /**
     * @return the $prodtreatment
     */
    public function getProdtreatment()
    {
        return $this->prodtreatment;
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
     * @param field_type $prodtitle
     */
    public function setProdtitle($prodtitle)
    {
        $this->prodtitle = $prodtitle;
    }

    /**
     * @param field_type $prodprice
     */
    public function setProdprice($prodprice)
    {
        $this->prodprice = $prodprice;
    }

    /**
     * @param field_type $proddiscount
     */
    public function setProddiscount($proddiscount)
    {
        $this->proddiscount = $proddiscount;
    }

    /**
     * @param field_type $prodpicture1
     */
    public function setProdpicture1($prodpicture1)
    {
        $this->prodpicture1 = $prodpicture1;
    }

    /**
     * @param field_type $prodpicture2
     */
    public function setProdpicture2($prodpicture2)
    {
        $this->prodpicture2 = $prodpicture2;
    }

    /**
     * @param field_type $prodpicture3
     */
    public function setProdpicture3($prodpicture3)
    {
        $this->prodpicture3 = $prodpicture3;
    }

    /**
     * @param field_type $prodpicture4
     */
    public function setProdpicture4($prodpicture4)
    {
        $this->prodpicture4 = $prodpicture4;
    }

    /**
     * @param field_type $prodpicture5
     */
    public function setProdpicture5($prodpicture5)
    {
        $this->prodpicture5 = $prodpicture5;
    }

    /**
     * @param field_type $proddescription
     */
    public function setProddescription($proddescription)
    {
        $this->proddescription = $proddescription;
    }

    /**
     * @param field_type $prodservice
     */
    public function setProdservice($prodservice)
    {
        $this->prodservice = $prodservice;
    }

    /**
     * @param field_type $proddemandclassifyseries
     */
    public function setProddemandclassifyseries($proddemandclassifyseries)
    {
        $this->proddemandclassifyseries = $proddemandclassifyseries;
    }

    /**
     * @param field_type $prodbrand
     */
    public function setProdbrand($prodbrand)
    {
        $this->prodbrand = $prodbrand;
    }

    /**
     * @param field_type $prodspecification
     */
    public function setProdspecification($prodspecification)
    {
        $this->prodspecification = $prodspecification;
    }

    /**
     * @param field_type $prodcontent
     */
    public function setProdcontent($prodcontent)
    {
        $this->prodcontent = $prodcontent;
    }

    /**
     * @param field_type $prodfactor
     */
    public function setProdfactor($prodfactor)
    {
        $this->prodfactor = $prodfactor;
    }

    /**
     * @param field_type $prodplace
     */
    public function setProdplace($prodplace)
    {
        $this->prodplace = $prodplace;
    }

    /**
     * @param field_type $prodapproval
     */
    public function setProdapproval($prodapproval)
    {
        $this->prodapproval = $prodapproval;
    }

    /**
     * @param field_type $prodefficacy
     */
    public function setProdefficacy($prodefficacy)
    {
        $this->prodefficacy = $prodefficacy;
    }

    /**
     * @param field_type $prodvalidity
     */
    public function setProdvalidity($prodvalidity)
    {
        $this->prodvalidity = $prodvalidity;
    }

    /**
     * @param field_type $prodtreatment
     */
    public function setProdtreatment($prodtreatment)
    {
        $this->prodtreatment = $prodtreatment;
    }

}