<?php
namespace Cosmetic\Page;

class PageEntity
{
    protected $pageid;
    protected $pagetype;
    protected $salnumber;
    protected $pagename;
    protected $pagecolor;
    protected $pagepaddinglr;
    protected $pagepaddingtop;
    protected $pagepaddingbottom;
    protected $pagecondition;
    protected $releasetime;
    protected $modificationtime;
    protected $pageheaddata1;
    protected $pageheaddata2;
    protected $pageheaddata3;
    protected $pageheaddata4;
    protected $pageheaddata5;
    protected $pageexpiration;
    
    /**
     * @return the $pageexpiration
     */
    public function getPageexpiration()
    {
        return $this->pageexpiration;
    }

    /**
     * @param field_type $pageexpiration
     */
    public function setPageexpiration($pageexpiration)
    {
        $this->pageexpiration = $pageexpiration;
    }

    /**
     * @return the $pageheaddata1
     */
    public function getPageheaddata1()
    {
        return $this->pageheaddata1;
    }

    /**
     * @return the $pageheaddata2
     */
    public function getPageheaddata2()
    {
        return $this->pageheaddata2;
    }

    /**
     * @return the $pageheaddata3
     */
    public function getPageheaddata3()
    {
        return $this->pageheaddata3;
    }

    /**
     * @return the $pageheaddata4
     */
    public function getPageheaddata4()
    {
        return $this->pageheaddata4;
    }

    /**
     * @return the $pageheaddata5
     */
    public function getPageheaddata5()
    {
        return $this->pageheaddata5;
    }

    /**
     * @param field_type $pageheaddata1
     */
    public function setPageheaddata1($pageheaddata1)
    {
        $this->pageheaddata1 = $pageheaddata1;
    }

    /**
     * @param field_type $pageheaddata2
     */
    public function setPageheaddata2($pageheaddata2)
    {
        $this->pageheaddata2 = $pageheaddata2;
    }

    /**
     * @param field_type $pageheaddata3
     */
    public function setPageheaddata3($pageheaddata3)
    {
        $this->pageheaddata3 = $pageheaddata3;
    }

    /**
     * @param field_type $pageheaddata4
     */
    public function setPageheaddata4($pageheaddata4)
    {
        $this->pageheaddata4 = $pageheaddata4;
    }

    /**
     * @param field_type $pageheaddata5
     */
    public function setPageheaddata5($pageheaddata5)
    {
        $this->pageheaddata5 = $pageheaddata5;
    }

    /**
     * @return the $pagetype
     */
    public function getPagetype()
    {
        return $this->pagetype;
    }

    /**
     * @param field_type $pagetype
     */
    public function setPagetype($pagetype)
    {
        $this->pagetype = $pagetype;
    }

    /**
     * @return the $pagepaddinglr
     */
    public function getPagepaddinglr()
    {
        return $this->pagepaddinglr;
    }



    /**
     * @param field_type $pagepaddinglr
     */
    public function setPagepaddinglr($pagepaddinglr)
    {
        $this->pagepaddinglr = $pagepaddinglr;
    }


    /**
     * @return the $pagepaddingtop
     */
    public function getPagepaddingtop()
    {
        return $this->pagepaddingtop;
    }

    /**
     * @return the $pagepaddingbottom
     */
    public function getPagepaddingbottom()
    {
        return $this->pagepaddingbottom;
    }

    /**
     * @param field_type $pagepaddingtop
     */
    public function setPagepaddingtop($pagepaddingtop)
    {
        $this->pagepaddingtop = $pagepaddingtop;
    }

    /**
     * @param field_type $pagepaddingbottom
     */
    public function setPagepaddingbottom($pagepaddingbottom)
    {
        $this->pagepaddingbottom = $pagepaddingbottom;
    }

    public function __construct()
    {
        $this->modificationtime = date('Y-m-d H:i:s');
    }
    /**
     * @return the $modificationtime
     */
    public function getModificationtime()
    {
        return $this->modificationtime;
    }

    /**
     * @param string $modificationtime
     */
    public function setModificationtime($modificationtime)
    {
        $this->modificationtime = $modificationtime;
    }

    /**
     * @return the $pageid
     */
    public function getPageid()
    {
        return $this->pageid;
    }

    
    /**
     * @return the $salnumber
     */
    public function getSalnumber()
    {
        return $this->salnumber;
    }

    /**
     * @return the $pagename
     */
    public function getPagename()
    {
        return $this->pagename;
    }

    /**
     * @return the $pagecolor
     */
    public function getPagecolor()
    {
        return $this->pagecolor;
    }

    /**
     * @return the $pagecondition
     */
    public function getPagecondition()
    {
        return $this->pagecondition;
    }

    /**
     * @return the $releasetime
     */
    public function getReleasetime()
    {
        return $this->releasetime;
    }

    /**
     * @param field_type $pageid
     */
    public function setPageid($pageid)
    {
        $this->pageid = $pageid;
    }

    

    /**
     * @param field_type $salnumber
     */
    public function setSalnumber($salnumber)
    {
        $this->salnumber = $salnumber;
    }

    /**
     * @param field_type $pagename
     */
    public function setPagename($pagename)
    {
        $this->pagename = $pagename;
    }

    /**
     * @param field_type $pagecolor
     */
    public function setPagecolor($pagecolor)
    {
        $this->pagecolor = $pagecolor;
    }

    /**
     * @param field_type $pagecondition
     */
    public function setPagecondition($pagecondition)
    {
        $this->pagecondition = $pagecondition;
    }

    /**
     * @param field_type $releasetime
     */
    public function setReleasetime($releasetime)
    {
        $this->releasetime = $releasetime;
    }

    
    
}