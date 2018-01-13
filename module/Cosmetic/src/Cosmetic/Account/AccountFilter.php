<?php
namespace Cosmetic\Account;

use Zend\InputFilter\InputFilter;

class AccountFilter extends InputFilter
{

    public function __construct()
    {
       
        $this->add(array(
            'name' => 'salaccount',
            'required' => true,
        ));
        $this->add(array(
            'name' => 'salpassword',
            'required' => true,
        ));
    }
}