<?php
include_once(__DIR__ . "/../config.php"); // Relative path to config.php
include_once(__DIR__ . "/../Model/Sites.php");

class SitesController
{
    // Add a new site
    public function addSite($site)
    {
        $db = config::getConnexion();

        if (!$db) {
            echo "Failed to connect to the database!";
            return;
        }

        $query = $db->prepare(
            'INSERT INTO sites (nom_site, description_site, category, images, location) 
             VALUES (:nom_site, :description_site, :category, :images, :location)'
        );

        try {
            $query->execute([
                'nom_site' => $site->getNomSite(),
                'description_site' => $site->getDescriptionSite(),
                'category' => $site->getCategory(),
                'images' => $site->getImages(),
                'location' => $site->getLocation(),
            ]);
            echo "Site added successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Get a site by its name
    public function getSiteByName($name)
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM sites WHERE nom_site = :name";

        try {
            $query = $db->prepare($sql);
            $query->execute(['name' => $name]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Update a site by its name
    public function updateSite($oldName, $newName, $description, $category, $image, $location)
    {
        $db = config::getConnexion();
        try {
            $sql = "UPDATE sites 
                    SET nom_site = :newName, description_site = :description, category = :category, images = :image, location = :location
                    WHERE nom_site = :oldName";

            $stmt = $db->prepare($sql);
            $stmt->execute([
                'newName' => $newName,
                'description' => $description,
                'category' => $category,
                'image' => $image,
                'location' => $location,
                'oldName' => $oldName,
            ]);

            return $stmt->rowCount() > 0; // Return true if rows were updated
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Get a site by its ID
    public function getSiteById($id)
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM sites WHERE id = :id";

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Update a site by its ID
    public function updateSiteById($id, $newName, $description, $category, $image, $location)
    {
        $conn = config::getConnexion();

        try {
            $sql = "UPDATE sites SET 
                        nom_site = :newName,
                        description_site = :description,
                        category = :category,
                        images = :image,
                        location = :location
                    WHERE id = :id";

            $query = $conn->prepare($sql);
            $query->execute([
                'newName' => $newName,
                'description' => $description,
                'category' => $category,
                'image' => $image,
                'location' => $location,
                'id' => $id,
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Error updating site: " . $e->getMessage();
            return false;
        }
    }

    // Delete a site by its ID
    public function deleteSite($id)
    {
        $sql = "DELETE FROM sites WHERE id = :id";
        $conn = config::getConnexion();

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; // Successful deletion
            } else {
                throw new Exception("No rows were deleted. The ID might not exist.");
            }
        } catch (Exception $e) {
            echo "Error deleting site: " . $e->getMessage();
            return false;
        }
    }

    // Get all sites
    public function getAllSites()
    {
        $sql = "SELECT s.id, s.nom_site, s.description_site, s.images, c.nom_categorie, l.nom AS nom_location
        FROM sites s
        LEFT JOIN categories c ON s.category = c.id
        LEFT JOIN locations l ON s.location = l.id";

$conn = config::getConnexion();

try {
    $stmt = $conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    return [];
}

    }

    // Get sites by category
    public function getSitesByCategory($categoryId)
    {
        $db = config::getConnexion();
        $sql = "SELECT s.*, c.nom_categorie 
                FROM sites s 
                JOIN categories c ON s.category = c.id 
                WHERE s.category = :categoryId";

        try {
            $query = $db->prepare($sql);
            $query->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Search sites by name
    public function searchSitesByName($searchTerm)
    {
        $conn = config::getConnexion();
        $sql = "SELECT id, nom_site, description_site, images, category, location, nom_categorie 
                FROM sites 
                LEFT JOIN categories ON sites.category = categories.id
                WHERE nom_site LIKE :searchTerm";
        try {
            $query = $conn->prepare($sql);
            $query->execute(['searchTerm' => "%$searchTerm%"]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error searching sites: " . $e->getMessage();
            return [];
        }
    }
}
?>
