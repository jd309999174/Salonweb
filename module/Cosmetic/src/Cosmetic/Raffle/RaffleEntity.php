<?php
namespace Cosmetic\Raffle;

class RaffleEntity
{
    protected $raf_id;
    protected $cus_number;
    protected $raf_prize;
    protected $raf_date;
    
    public function __construct()
    {
        $this->raf_date = date('Y-m-d H:i:s');
    }
    /**
     * @return the $raf_id
     */
    public function getRaf_id()
    {
        return $this->raf_id;
    }

    /**
     * @return the $cus_number
     */
    public function getCus_number()
    {
        return $this->cus_number;
    }

    /**
     * @return the $raf_prize
     */
    public function getRaf_prize()
    {
        return $this->raf_prize;
    }

    /**
     * @return the $raf_date
     */
    public function getRaf_date()
    {
        return $this->raf_date;
    }

    /**
     * @param field_type $raf_id
     */
    public function setRaf_id($raf_id)
    {
        $this->raf_id = $raf_id;
    }

    /**
     * @param field_type $cus_number
     */
    public function setCus_number($cus_number)
    {
        $this->cus_number = $cus_number;
    }

    /**
     * @param field_type $raf_prize
     */
    public function setRaf_prize($raf_prize)
    {
        $this->raf_prize = $raf_prize;
    }

    /**
     * @param string $raf_date
     */
    public function setRaf_date($raf_date)
    {
        $this->raf_date = $raf_date;
    }

    
}