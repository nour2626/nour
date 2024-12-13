<?php
include_once 'C:/xampp/htdocs/projetweb2025/config.php';

class BookmarkController
{
    // Add a bookmark
    public function addBookmark($userId, $siteId)
{
    $conn = config::getConnexion();

    // Check if the bookmark already exists
    $checkSql = "SELECT COUNT(*) FROM bookmarks WHERE user_id = :user_id AND site_id = :site_id";
    $insertSql = "INSERT INTO bookmarks (user_id, site_id) VALUES (:user_id, :site_id)";

    try {
        // Check if the bookmark already exists
        $checkQuery = $conn->prepare($checkSql);
        $checkQuery->execute([
            'user_id' => $userId,
            'site_id' => $siteId
        ]);

        if ($checkQuery->fetchColumn() > 0) {
            // If the bookmark exists, return false or handle as needed
            return false;
        }

        // Add the bookmark if it doesn't exist
        $insertQuery = $conn->prepare($insertSql);
        $insertQuery->execute([
            'user_id' => $userId,
            'site_id' => $siteId
        ]);

        return true;
    } catch (PDOException $e) {
        echo "Error adding bookmark: " . $e->getMessage();
        return false;
    }
}


    // Remove a bookmark
    public function removeBookmark($siteId)
    {
        $conn = config::getConnexion();
        $sql = "DELETE FROM bookmarks WHERE site_id = :site_id";
        
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'site_id' => $siteId
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Error removing bookmark: " . $e->getMessage();
            return false;
        }
    }

    // Fetch all bookmarked sites
    public function getBookmarkedSites()
    {
        $conn = config::getConnexion();
        $sql = "SELECT s.id, s.nom_site, s.description_site, s.images, c.nom_categorie 
                FROM bookmarks b
                INNER JOIN sites s ON b.site_id = s.id
                LEFT JOIN categories c ON s.category = c.id";
        
        try {
            $query = $conn->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching bookmarks: " . $e->getMessage();
            return [];
        }
    }

    public function isBookmarked($userId, $siteId)
{
    $db = config::getConnexion();
    $sql = "SELECT COUNT(*) FROM bookmarks WHERE user_id = :user_id AND site_id = :site_id";

    try {
        $query = $db->prepare($sql);
        $query->execute([
            'user_id' => $userId,
            'site_id' => $siteId,
        ]);
        return $query->fetchColumn() > 0; // Returns true if the site is bookmarked
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}

    public function getBookmarksByUser($userId)
{
    $conn = config::getConnexion();

    try {
        $sql = "SELECT b.site_id, s.nom_site, s.description_site, s.images, c.nom_categorie
                FROM bookmarks b
                INNER JOIN sites s ON b.site_id = s.id
                LEFT JOIN categories c ON s.category = c.id
                WHERE b.user_id = :userId";

        $query = $conn->prepare($sql);
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

}
?>
