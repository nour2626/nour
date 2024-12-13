<?php
include_once "C:/xampp/htdocs/projetweb2025/config.php";

class ReviewsController
{
    // Add a new review
    public function addReview($contenu, $siteId)
{
    $db = config::getConnexion();
    $sql = "INSERT INTO reviews (contenu, site_id) VALUES (:contenu, :site_id)";

    try {
        $query = $db->prepare($sql);
        $query->execute([
            'contenu' => $contenu,
            'site_id' => $siteId,
        ]);
        return true;
    } catch (PDOException $e) {
        echo "Error adding review: " . $e->getMessage();
        return false;
    }
}


    // Get all reviews
    public function getAllReviews()
    {
        $conn = config::getConnexion();
        $sql = "SELECT r.id, r.contenu, r.site_id, s.nom_site 
                FROM reviews r 
                JOIN sites s ON r.site_id = s.id";

        try {
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching reviews: " . $e->getMessage();
            return [];
        }
    }

    // Get reviews by site ID
    public function getReviewsBySite($siteId)
    {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM reviews WHERE site_id = :site_id";

        try {
            $query = $conn->prepare($sql);
            $query->execute(['site_id' => $siteId]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching reviews for site: " . $e->getMessage();
            return [];
        }
    }

    // Update a review by its ID
    public function updateReview($id, $contenu)
    {
        $conn = config::getConnexion();
        $sql = "UPDATE reviews SET contenu = :contenu WHERE id = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'contenu' => $contenu,
                'id' => $id,
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Error updating review: " . $e->getMessage();
            return false;
        }
    }

    // Delete a review by its ID
    public function deleteReview($id)
    {
        $conn = config::getConnexion();
        $sql = "DELETE FROM reviews WHERE id = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            echo "Error deleting review: " . $e->getMessage();
            return false;
        }
    }
}
?>
