<?php

class Sites {
    private $id;
    private $nom_site;
    private $description_site;
    private $category;
    private $images;
    private $location; // New property for location

    // Constructeur
    public function __construct($id, $nom_site, $description_site, $category, $images, $location) {
        $this->id = $id;
        $this->nom_site = $nom_site;
        $this->description_site = $description_site;
        $this->category = $category;
        $this->images = $images;
        $this->location = $location; // Initialize location
    }

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the value of nom_site
     */
    public function getNomSite() {
        return $this->nom_site;
    }

    /**
     * Set the value of nom_site
     */
    public function setNomSite($nom_site) {
        $this->nom_site = $nom_site;
        return $this;
    }

    /**
     * Get the value of description_site
     */
    public function getDescriptionSite() {
        return $this->description_site;
    }

    /**
     * Set the value of description_site
     */
    public function setDescriptionSite($description_site) {
        $this->description_site = $description_site;
        return $this;
    }

    /**
     * Get the value of category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Set the value of category
     */
    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }

    /**
     * Get the value of images
     */
    public function getImages() {
        return $this->images;
    }

    /**
     * Set the value of images
     */
    public function setImages($images) {
        $this->images = $images;
        return $this;
    }

    /**
     * Get the value of location
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Set the value of location
     */
    public function setLocation($location) {
        $this->location = $location;
        return $this;
    }
}

?>
