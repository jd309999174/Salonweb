<?php
namespace Cosmetic\Name;

use Zend\InputFilter\InputFilter;

class NameFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'id',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'Int'
                )
            )
        ));
        $this->add(array(
            'name' => 'name',
            'required' => false
        ));
    }
    
}