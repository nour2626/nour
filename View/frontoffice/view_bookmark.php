<?php
// Include the database configuration and models
include_once 'C:/xampp/htdocs/projetweb2025/Model/sites.php';
include_once 'C:/xampp/htdocs/projetweb2025/Controller/sitesController.php';
include_once 'C:/xampp/htdocs/projetweb2025/Controller/bookmarkController.php';

$bookmarkController = new BookmarkController();
$sitesController = new SitesController();

// Fetch all bookmarks
$bookmarkedSites = $bookmarkController->getBookmarkedSites();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bookmarked Sites</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Open Sans', sans-serif;
        }

        .navbar {
            background-color: white;
            padding: 15px 30px;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar-brand img {
            height: 30px;
            margin-right: 10px;
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .page-title {
            font-size: 2.5rem;
            color: #333;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            text-align: center;
        }

        .card-title {
            font-size: 1.5rem;
            color: #4a4a4a;
        }

        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }

        .no-bookmarks {
            font-size: 1.5rem;
            font-weight: bold;
            color: #6c757d;
        }

        .btn-back {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            font-size: 0.9rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 50px;
        }

        .btn-back:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a class="navbar-brand" href="index.php">
            <img src="img/logo.png" alt="Logo">
            echos de la Tunisie
        </a>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="text-center mb-4 page-title">Your Bookmarked Sites</h1>

        <div class="row">
            <?php if (!empty($bookmarkedSites)) : ?>
                <?php foreach ($bookmarkedSites as $site) : ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                            <img src="/projetweb2025/uploads/<?php echo htmlspecialchars($site['images']); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo htmlspecialchars($site['nom_site']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($site['nom_site']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($site['description_site']); ?></p>
                                <p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($site['nom_categorie']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12 text-center">
                    <p class="no-bookmarks">You haven't bookmarked any sites yet.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="index.php#tm-section-5" class="btn btn-back">Back to Sites</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
