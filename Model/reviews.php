<?php

class Reviews {
    private $id;
    private $contenu;
    private $site_id;

    public function __construct($id, $contenu, $site_id) {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->site_id = $site_id;
    }

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the value of contenu
     */
    public function getContenu() {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @return self
     */
    public function setContenu($contenu) {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * Get the value of site_id
     */
    public function getSiteId() {
        return $this->site_id;
    }

    /**
     * Set the value of site_id
     *
     * @return self
     */
    public function setSiteId($site_id) {
        $this->site_id = $site_id;
        return $this;
    }
}

?>
