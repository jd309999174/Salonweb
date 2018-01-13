<?php
namespace Cosmetic\Feedbacks;

class FeedbacksEntity
{
    protected $id;
    protected $treid;
    protected $prodid;
    protected $prodtitle;
    protected $productcombinationid;
    protected $productcombinationname;
    protected $productcombinationpicture;
    protected $salnumber;
    protected $salbranch;
    protected $salname;
    protected $salphoto1;
    protected $cusid;
    protected $cusname;
    protected $cusphoto;
    protected $cosid;
    protected $cosname;
    protected $cosphoto;
    protected $fbsurrounding;
    protected $fbproduct;
    protected $fbcosmetologist;
    protected $fbadvise;
    protected $fbadvise1;
    protected $fbadvise2;
    protected $fbdate;
    protected $gmtfbdate;
    
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
     * @return the $productcombinationname
     */
    public function getProductcombinationname()
    {
        return $this->productcombinationname;
    }

    /**
     * @return the $productcombinationpicture
     */
    public function getProductcombinationpicture()
    {
        return $this->productcombinationpicture;
    }

    /**
     * @return the $salname
     */
    public function getSalname()
    {
        return $this->salname;
    }

    /**
     * @return the $salphoto1
     */
    public function getSalphoto1()
    {
        return $this->salphoto1;
    }

    /**
     * @return the $cusname
     */
    public function getCusname()
    {
        return $this->cusname;
    }

    /**
     * @return the $cusphoto
     */
    public function getCusphoto()
    {
        return $this->cusphoto;
    }

    /**
     * @return the $cosname
     */
    public function getCosname()
    {
        return $this->cosname;
    }

    /**
     * @return the $cosphoto
     */
    public function getCosphoto()
    {
        return $this->cosphoto;
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
     * @param field_type $productcombinationname
     */
    public function setProductcombinationname($productcombinationname)
    {
        $this->productcombinationname = $productcombinationname;
    }

    /**
     * @param field_type $productcombinationpicture
     */
    public function setProductcombinationpicture($productcombinationpicture)
    {
        $this->productcombinationpicture = $productcombinationpicture;
    }

    /**
     * @param field_type $salname
     */
    public function setSalname($salname)
    {
        $this->salname = $salname;
    }

    /**
     * @param field_type $salphoto1
     */
    public function setSalphoto1($salphoto1)
    {
        $this->salphoto1 = $salphoto1;
    }

    /**
     * @param field_type $cusname
     */
    public function setCusname($cusname)
    {
        $this->cusname = $cusname;
    }

    /**
     * @param field_type $cusphoto
     */
    public function setCusphoto($cusphoto)
    {
        $this->cusphoto = $cusphoto;
    }

    /**
     * @param field_type $cosname
     */
    public function setCosname($cosname)
    {
        $this->cosname = $cosname;
    }

    /**
     * @param field_type $cosphoto
     */
    public function setCosphoto($cosphoto)
    {
        $this->cosphoto = $cosphoto;
    }

    /**
     * @return the $salbranch
     */
    public function getSalbranch()
    {
        return $this->salbranch;
    }

    /**
     * @param field_type $salbranch
     */
    public function setSalbranch($salbranch)
    {
        $this->salbranch = $salbranch;
    }

    /**
     * @return the $prodid
     */
    public function getProdid()
    {
        return $this->prodid;
    }

    /**
     * @param field_type $prodid
     */
    public function setProdid($prodid)
    {
        $this->prodid = $prodid;
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
     * @return the $fbadvise1
     */
    public function getFbadvise1()
    {
        return $this->fbadvise1;
    }

    /**
     * @return the $fbadvise2
     */
    public function getFbadvise2()
    {
        return $this->fbadvise2;
    }

    /**
     * @param field_type $fbadvise1
     */
    public function setFbadvise1($fbadvise1)
    {
        $this->fbadvise1 = $fbadvise1;
    }

    /**
     * @param field_type $fbadvise2
     */
    public function setFbadvise2($fbadvise2)
    {
        $this->fbadvise2 = $fbadvise2;
    }

    public function __construct()
    {
        $this->fbdate = date('Y-m-d H:i:s');
        $this->gmtfbdate = date('YmdHis');
    }
    /**
     * @return the $gmtfbdate
     */
    public function getGmtfbdate()
    {
        return $this->gmtfbdate;
    }

    /**
     * @param string $gmtfbdate
     */
    public function setGmtfbdate($gmtfbdate)
    {
        $this->gmtfbdate = $gmtfbdate;
    }

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $treid
     */
    public function getTreid()
    {
        return $this->treid;
    }

    /**
     * @return the $cosid
     */
    public function getCosid()
    {
        return $this->cosid;
    }

    /**
     * @return the $fbsurrounding
     */
    public function getFbsurrounding()
    {
        return $this->fbsurrounding;
    }

    /**
     * @return the $fbproduct
     */
    public function getFbproduct()
    {
        return $this->fbproduct;
    }

    /**
     * @return the $fbcosmetologist
     */
    public function getFbcosmetologist()
    {
        return $this->fbcosmetologist;
    }

    /**
     * @return the $fbadvise
     */
    public function getFbadvise()
    {
        return $this->fbadvise;
    }

    /**
     * @return the $fbdate
     */
    public function getFbdate()
    {
        return $this->fbdate;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param field_type $treid
     */
    public function setTreid($treid)
    {
        $this->treid = $treid;
    }

    /**
     * @param field_type $cosid
     */
    public function setCosid($cosid)
    {
        $this->cosid = $cosid;
    }

    /**
     * @param field_type $fbsurrounding
     */
    public function setFbsurrounding($fbsurrounding)
    {
        $this->fbsurrounding = $fbsurrounding;
    }

    /**
     * @param field_type $fbproduct
     */
    public function setFbproduct($fbproduct)
    {
        $this->fbproduct = $fbproduct;
    }

    /**
     * @param field_type $fbcosmetologist
     */
    public function setFbcosmetologist($fbcosmetologist)
    {
        $this->fbcosmetologist = $fbcosmetologist;
    }

    /**
     * @param field_type $fbadvise
     */
    public function setFbadvise($fbadvise)
    {
        $this->fbadvise = $fbadvise;
    }

    /**
     * @param string $fbdate
     */
    public function setFbdate($fbdate)
    {
        $this->fbdate = $fbdate;
    }

    
    
    
}