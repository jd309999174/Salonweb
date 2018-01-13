<?php
namespace Cosmetic\Chatmodule;

class ChatmoduleEntity
{
    protected $id;
    protected $sendid;
    protected $receiveid;
    protected $chatword;
    protected $chatpicture;
    protected $chatstate;
    protected $chatdate;
    protected $chatdatehistory;

    public function __construct()
    {
        $this->chatdate = date('Y-m-d H:i:s');
        $this->chatdatehistory = date('Ymd');
    }
    /**
     * @return the $id
     */
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
     * @return the $chatword
     */
    public function getChatword()
    {
        return $this->chatword;
    }

    /**
     * @return the $chatpicture
     */
    public function getChatpicture()
    {
        return $this->chatpicture;
    }

    /**
     * @return the $chatstate
     */
    public function getChatstate()
    {
        return $this->chatstate;
    }

    /**
     * @return the $chatdate
     */
    public function getChatdate()
    {
        return $this->chatdate;
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
     * @param field_type $chatword
     */
    public function setChatword($chatword)
    {
        $this->chatword = $chatword;
    }

    /**
     * @param field_type $chatpicture
     */
    public function setChatpicture($chatpicture)
    {
        $this->chatpicture = $chatpicture;
    }

    /**
     * @param field_type $chatstate
     */
    public function setChatstate($chatstate)
    {
        $this->chatstate = $chatstate;
    }

    /**
     * @param string $chatdate
     */
    public function setChatdate($chatdate)
    {
        $this->chatdate = $chatdate;
    }
    /**
     * @return the $chatdatehistory
     */
    public function getChatdatehistory()
    {
        return $this->chatdatehistory;
    }

    /**
     * @param field_type $chatdatehistory
     */
    public function setChatdatehistory($chatdatehistory)
    {
        $this->chatdatehistory = $chatdatehistory;
    }


    
   

    
    
 
}