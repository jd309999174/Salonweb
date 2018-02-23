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
    protected $originalpicturegroup1;
    protected $originalpicturegroup2;
    protected $originalpicturegroup3;
    protected $smallpicturegroup1;
    protected $smallpicturegroup2;
    protected $smallpicturegroup3;
    protected $salcomment1;
    protected $salcomment2;
    protected $salcomment3;
    protected $salcommentdate;
    
    
    

    /**
     * @return the $salcomment1
     */
    public function getSalcomment1()
    {
        return $this->salcomment1;
    }

    /**
     * @return the $salcomment2
     */
    public function getSalcomment2()
    {
        return $this->salcomment2;
    }

    /**
     * @return the $salcomment3
     */
    public function getSalcomment3()
    {
        return $this->salcomment3;
    }

    /**
     * @return the $salcommentdate
     */
    public function getSalcommentdate()
    {
        return $this->salcommentdate;
    }

    /**
     * @param field_type $salcomment1
     */
    public function setSalcomment1($salcomment1)
    {
        $this->salcomment1 = $salcomment1;
    }

    /**
     * @param field_type $salcomment2
     */
    public function setSalcomment2($salcomment2)
    {
        $this->salcomment2 = $salcomment2;
    }

    /**
     * @param field_type $salcomment3
     */
    public function setSalcomment3($salcomment3)
    {
        $this->salcomment3 = $salcomment3;
    }

    /**
     * @param field_type $salcommentdate
     */
    public function setSalcommentdate($salcommentdate)
    {
        $this->salcommentdate = $salcommentdate;
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
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $salbranch
     */
    public function getSalbranch()
    {
        return $this->salbranch;
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
     * @return the $cusid
     */
    public function getCusid()
    {
        return $this->cusid;
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
     * @return the $cosid
     */
    public function getCosid()
    {
        return $this->cosid;
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
     * @return the $fbdate
     */
    public function getFbdate()
    {
        return $this->fbdate;
    }

    /**
     * @return the $gmtfbdate
     */
    public function getGmtfbdate()
    {
        return $this->gmtfbdate;
    }

    /**
     * @return the $originalpicturegroup1
     */
    public function getOriginalpicturegroup1()
    {
        return $this->originalpicturegroup1;
    }

    /**
     * @return the $originalpicturegroup2
     */
    public function getOriginalpicturegroup2()
    {
        return $this->originalpicturegroup2;
    }

    /**
     * @return the $originalpicturegroup3
     */
    public function getOriginalpicturegroup3()
    {
        return $this->originalpicturegroup3;
    }

    /**
     * @return the $smallpicturegroup1
     */
    public function getSmallpicturegroup1()
    {
        return $this->smallpicturegroup1;
    }

    /**
     * @return the $smallpicturegroup2
     */
    public function getSmallpicturegroup2()
    {
        return $this->smallpicturegroup2;
    }

    /**
     * @return the $smallpicturegroup3
     */
    public function getSmallpicturegroup3()
    {
        return $this->smallpicturegroup3;
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
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $salbranch
     */
    public function setSalbranch($salbranch)
    {
        $this->salbranch = $salbranch;
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
     * @param field_type $cusid
     */
    public function setCusid($cusid)
    {
        $this->cusid = $cusid;
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
     * @param field_type $cosid
     */
    public function setCosid($cosid)
    {
        $this->cosid = $cosid;
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

    /**
     * @param string $fbdate
     */
    public function setFbdate($fbdate)
    {
        $this->fbdate = $fbdate;
    }

    /**
     * @param string $gmtfbdate
     */
    public function setGmtfbdate($gmtfbdate)
    {
        $this->gmtfbdate = $gmtfbdate;
    }

    /**
     * @param field_type $originalpicturegroup1
     */
    public function setOriginalpicturegroup1($originalpicturegroup1)
    {
        $this->originalpicturegroup1 = $originalpicturegroup1;
    }

    /**
     * @param field_type $originalpicturegroup2
     */
    public function setOriginalpicturegroup2($originalpicturegroup2)
    {
        $this->originalpicturegroup2 = $originalpicturegroup2;
    }

    /**
     * @param field_type $originalpicturegroup3
     */
    public function setOriginalpicturegroup3($originalpicturegroup3)
    {
        $this->originalpicturegroup3 = $originalpicturegroup3;
    }

    /**
     * @param field_type $smallpicturegroup1
     */
    public function setSmallpicturegroup1($smallpicturegroup1)
    {
        $this->smallpicturegroup1 = $smallpicturegroup1;
    }

    /**
     * @param field_type $smallpicturegroup2
     */
    public function setSmallpicturegroup2($smallpicturegroup2)
    {
        $this->smallpicturegroup2 = $smallpicturegroup2;
    }

    /**
     * @param field_type $smallpicturegroup3
     */
    public function setSmallpicturegroup3($smallpicturegroup3)
    {
        $this->smallpicturegroup3 = $smallpicturegroup3;
    }

    public function __construct()
    {
        $this->fbdate = date('Y-m-d H:i:s');
        $this->gmtfbdate = date('YmdHis');
    }
    
}