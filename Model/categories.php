<?php

class categories {
    private $id;
    private $nom_categorie;
    private $description;
    private $image; // New property for the image

    public function __construct($id, $nom_categorie, $description, $image) {
        $this->id = $id;
        $this->nom_categorie = $nom_categorie;
        $this->description = $description;
        $this->image = $image; // Initialize the image property
    }
    
    /**
     * Get the value of id
     */ 
    public function getid() {
        return $this->id;
    }

    /**
     * Get the value of nom_categorie
     */ 
    public function getnom_categorie() {
        return $this->nom_categorie;
    }

    /**
     * Set the value of nom_categorie
     *
     * @return  self
     */ 
    public function setnom_categorie($nom_categorie) {
        $this->nom_categorie = $nom_categorie;
        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getdescription() {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setdescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getimage() {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setimage($image) {
        $this->image = $image;
        return $this;
    }
}

?>
