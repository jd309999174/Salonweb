<?php
namespace Cosmetic\Name;

class NameEntity{
    protected $id;
    protected $name;
    protected $file;
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $file
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param field_type $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    
}