<?php
namespace Cosmetic\Treatment;

class TreatmentEntity
{
    protected $treid;
    protected $orderid;
    protected $cusid;
    protected $cusname;
    protected $salnumber;
    protected $prodid;
    protected $prodsalnumber;
    protected $prodtitle;
    protected $productcombinationid;
    protected $productcombinationname;
    protected $productcombinationpicture;
    protected $treregdate;
    protected $treprice;
    protected $trestate;
    protected $treremark;
    protected $productquantity;
    protected $couponidused;
    protected $gmtclose;
    protected $paymethod;
    protected $payid;
    protected $expresscompany;
    protected $expressid;
    protected $expressstate;
   
    
   
    /**
     * @return the $expresscompany
     */
    public function getExpresscompany()
    {
        return $this->expresscompany;
    }

    /**
     * @return the $expressid
     */
    public function getExpressid()
    {
        return $this->expressid;
    }

    /**
     * @return the $expressstate
     */
    public function getExpressstate()
    {
        return $this->expressstate;
    }

    /**
     * @param field_type $expresscompany
     */
    public function setExpresscompany($expresscompany)
    {
        $this->expresscompany = $expresscompany;
    }

    /**
     * @param field_type $expressid
     */
    public function setExpressid($expressid)
    {
        $this->expressid = $expressid;
    }

    /**
     * @param field_type $expressstate
     */
    public function setExpressstate($expressstate)
    {
        $this->expressstate = $expressstate;
    }

    /**
     * @return the $paymethod
     */
    public function getPaymethod()
    {
        return $this->paymethod;
    }

    /**
     * @return the $payid
     */
    public function getPayid()
    {
        return $this->payid;
    }

    /**
     * @param field_type $paymethod
     */
    public function setPaymethod($paymethod)
    {
        $this->paymethod = $paymethod;
    }

    /**
     * @param field_type $payid
     */
    public function setPayid($payid)
    {
        $this->payid = $payid;
    }

    /**
     * @return the $prodsalnumber
     */
    public function getProdsalnumber()
    {
        return $this->prodsalnumber;
    }

    /**
     * @param field_type $prodsalnumber
     */
    public function setProdsalnumber($prodsalnumber)
    {
        $this->prodsalnumber = $prodsalnumber;
    }

    /**
     * @return the $gmtclose
     */
    public function getGmtclose()
    {
        return $this->gmtclose;
    }

    /**
     * @param field_type $gmtclose
     */
    public function setGmtclose($gmtclose)
    {
        $this->gmtclose = $gmtclose;
    }

    /**
     * @return the $cusname
     */
    public function getCusname()
    {
        return $this->cusname;
    }

    /**
     * @param field_type $cusname
     */
    public function setCusname($cusname)
    {
        $this->cusname = $cusname;
    }

    /**
     * @return the $prodtitle
     */
    public function getProdtitle()
    {
        return $this->prodtitle;
    }

    /**
     * @return the $productcombinationpicture
     */
    public function getProductcombinationpicture()
    {
        return $this->productcombinationpicture;
    }

    /**
     * @param field_type $prodtitle
     */
    public function setProdtitle($prodtitle)
    {
        $this->prodtitle = $prodtitle;
    }

    /**
     * @param field_type $productcombinationpicture
     */
    public function setProductcombinationpicture($productcombinationpicture)
    {
        $this->productcombinationpicture = $productcombinationpicture;
    }

    /**
     * @return the $orderid
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * @param field_type $orderid
     */
    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;
    }

    /**
     * @return the $productcombinationname
     */
    public function getProductcombinationname()
    {
        return $this->productcombinationname;
    }

    /**
     * @param field_type $productcombinationname
     */
    public function setProductcombinationname($productcombinationname)
    {
        $this->productcombinationname = $productcombinationname;
    }

    /**
     * @return the $treid
     */
    public function getTreid()
    {
        return $this->treid;
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
     * @return the $prodid
     */
    public function getProdid()
    {
        return $this->prodid;
    }

    /**
     * @return the $productcombinationid
     */
    public function getProductcombinationid()
    {
        return $this->productcombinationid;
    }

    /**
     * @return the $treregdate
     */
    public function getTreregdate()
    {
        return $this->treregdate;
    }

    /**
     * @return the $treprice
     */
    public function getTreprice()
    {
        return $this->treprice;
    }

    /**
     * @return the $trestate
     */
    public function getTrestate()
    {
        return $this->trestate;
    }

    /**
     * @return the $treremark
     */
    public function getTreremark()
    {
        return $this->treremark;
    }

    /**
     * @return the $productquantity
     */
    public function getProductquantity()
    {
        return $this->productquantity;
    }

    /**
     * @return the $couponidused
     */
    public function getCouponidused()
    {
        return $this->couponidused;
    }

    /**
     * @param field_type $treid
     */
    public function setTreid($treid)
    {
        $this->treid = $treid;
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
     * @param field_type $prodid
     */
    public function setProdid($prodid)
    {
        $this->prodid = $prodid;
    }

    /**
     * @param field_type $productcombinationid
     */
    public function setProductcombinationid($productcombinationid)
    {
        $this->productcombinationid = $productcombinationid;
    }

    /**
     * @param string $treregdate
     */
    public function setTreregdate($treregdate)
    {
        $this->treregdate = $treregdate;
    }

    /**
     * @param field_type $treprice
     */
    public function setTreprice($treprice)
    {
        $this->treprice = $treprice;
    }

    /**
     * @param field_type $trestate
     */
    public function setTrestate($trestate)
    {
        $this->trestate = $trestate;
    }

    /**
     * @param field_type $treremark
     */
    public function setTreremark($treremark)
    {
        $this->treremark = $treremark;
    }

    /**
     * @param field_type $productquantity
     */
    public function setProductquantity($productquantity)
    {
        $this->productquantity = $productquantity;
    }

    /**
     * @param field_type $couponidused
     */
    public function setCouponidused($couponidused)
    {
        $this->couponidused = $couponidused;
    }

    public function __construct()
    {
        $this->treregdate = date('YmdHis');
        $this->gmtclose = date('YmdHis');
    }
    
    
    
}