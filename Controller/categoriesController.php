<?php
require __DIR__ . "/../config.php";

class categoriesController
{
    // Select all categories
    public function categoriesList()
    {
        $sql = "SELECT * FROM categories";
        $conn = config::getConnexion();

        try {
            $liste = $conn->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Select one category by ID
    function getcategoriesById($id)
    {
        $sql = "SELECT * from categories where id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();

            $category = $query->fetch(PDO::FETCH_ASSOC);
            return $category;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Add new category
    public function addcategorie($categorie)
    {
        $sql = "INSERT INTO categories (nom_categorie, description, image)
                VALUES (:nom_categorie, :description, :image)";
        $conn = config::getConnexion();
    
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'nom_categorie' => $categorie->getnom_categorie(),
                'description' => $categorie->getdescription(),
                'image' => $categorie->getimage()
            ]);
            echo "Category inserted successfully";
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Update a category by ID
    function updatecategories($categorie, $id)
    {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE categories SET 
                nom_categorie = :nom_categorie,
                description = :description,
                image = :image
            WHERE id = :id'
        );
        try {
            $query->execute([
                'id' => $id,
                'nom_categorie' => $categorie->getnom_categorie(),
                'description' => $categorie->getdescription(),
                'image' => $categorie->getimage()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Delete a category by ID
    public function deletecategories($id)
    {
        $sql = "DELETE FROM categories WHERE id=:id";
        $conn = config::getConnexion();
        $req = $conn->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Method to get category by name
    public function getcategoriesByName($name)
    {
        $conn = config::getConnexion();
        $query = "SELECT * FROM categories WHERE nom_categorie = :name";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return $category;
    }
}
?>
