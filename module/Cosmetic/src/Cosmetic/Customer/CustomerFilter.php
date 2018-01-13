<?php
namespace Cosmetic\Customer;

use Zend\InputFilter\InputFilter;

class CustomerFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'cusphone',
            'required' => true,
        ));
        $this->add(array(
            'name' => 'cuspassword',
            'required' => true,
        ));  
      
    }
}