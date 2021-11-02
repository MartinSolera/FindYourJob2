<?php
namespace Models;

class Career {

    private $careerId;
    private $active; //true or false
    private $description;

    /**
     * Get the value of careerId
     */
    public function getCareerId()
    {
        return $this->careerId;
    }

    /**
     * Set the value of careerId
     */
    public function setCareerId($careerId)
    {
        $this->careerId = $careerId;
    }

    /**
     * Get the value of active
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}