<?php
namespace Models;

class Career {

    private $careerId;
    private $nameCareer;
    private $active;
    private $description;

    public function __construct()
    {

    }

    

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
    public function setCareerId($careerId): self
    {
        $this->careerId = $careerId;

        return $this;
    }

    /**
     * Get the value of nameCareer
     */
    public function getNameCareer()
    {
        return $this->nameCareer;
    }

    /**
     * Set the value of nameCareer
     */
    public function setNameCareer($nameCareer): self
    {
        $this->nameCareer = $nameCareer;

        return $this;
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
    public function setActive($active): self
    {
        $this->active = $active;

        return $this;
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
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }
}