<?php
namespace Cosmetic\Unread;

/**
 * @author Administrator
 *
 */
class UnreadEntity
{
    protected $id;
    protected $sendid;
    protected $receiveid;
    protected $number;
    protected $sendname;
    protected $lastword;
    /**
     * @return the $id
     */
    
    /**
     * @return the $sendname
     */
    public function getSendname()
    {
        return $this->sendname;
    }

    /**
     * @return the $lastword
     */
    public function getLastword()
    {
        return $this->lastword;
    }

    /**
     * @param field_type $sendname
     */
    public function setSendname($sendname)
    {
        $this->sendname = $sendname;
    }

    /**
     * @param field_type $lastword
     */
    public function setLastword($lastword)
    {
        $this->lastword = $lastword;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $sendid
     */
    public function getSendid()
    {
        return $this->sendid;
    }

    /**
     * @return the $receiveid
     */
    public function getReceiveid()
    {
        return $this->receiveid;
    }

    /**
     * @return the $number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param field_type $sendid
     */
    public function setSendid($sendid)
    {
        $this->sendid = $sendid;
    }

    /**
     * @param field_type $receiveid
     */
    public function setReceiveid($receiveid)
    {
        $this->receiveid = $receiveid;
    }

    /**
     * @param field_type $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }


    

}