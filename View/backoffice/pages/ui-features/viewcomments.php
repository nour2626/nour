<?php
// Include necessary files
include_once 'C:/xampp/htdocs/projetweb2025/config.php';
include_once 'C:/xampp/htdocs/projetweb2025/Model/reviews.php';
include_once 'C:/xampp/htdocs/projetweb2025/Controller/reviewsController.php';
include_once 'C:/xampp/htdocs/projetweb2025/Model/sites.php';
include_once 'C:/xampp/htdocs/projetweb2025/Controller/sitesController.php';

// Initialize controllers
$reviewsController = new ReviewsController();
$sitesController = new SitesController();

// Get the site ID from the query string
$siteId = isset($_GET['site_id']) ? intval($_GET['site_id']) : 0;

// Fetch the site information
$site = $sitesController->getSiteById($siteId);

// Fetch comments for the site
$comments = $reviewsController->getReviewsBySite($siteId);

// Handle comment deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment_id'])) {
    $deleteCommentId = intval($_POST['delete_comment_id']);
    if ($reviewsController->deleteReview($deleteCommentId)) {
        echo "<script>alert('Comment deleted successfully!');</script>";
        header("Location: viewcomments.php?site_id=$siteId");
        exit();
    } else {
        echo "<script>alert('Failed to delete the comment!');</script>";
    }
}

// Handle comment update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_comment_id'])) {
    $updateCommentId = intval($_POST['update_comment_id']);
    $updatedContent = $_POST['updated_content'];

    if (!empty($updatedContent)) {
        if ($reviewsController->updateReview($updateCommentId, $updatedContent)) {
            echo "<script>alert('Comment updated successfully!');</script>";
            header("Location: viewcomments.php?site_id=$siteId");
            exit();
        } else {
            echo "<script>alert('Failed to update the comment!');</script>";
        }
    } else {
        echo "<script>alert('Comment content cannot be empty!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments for <?php echo htmlspecialchars($site['nom_site']); ?></title>
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

        .comment-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            padding: 15px;
            background-color: #fff;
        }

        .comment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .comment-card h5 {
            font-size: 1.5rem;
            color: #4a4a4a;
        }

        .comment-card p {
            font-size: 1rem;
            color: #6c757d;
        }

        .btn-action {
            text-transform: uppercase;
            font-size: 0.9rem;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 50px;
        }

        .btn-action:hover {
            opacity: 0.9;
        }

        .btn-update {
            background-color: #ffc107;
            color: white;
        }

        .btn-delete {
            background-color: #ff4d4d;
            color: white;
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

        .no-comments {
            font-size: 1.5rem;
            font-weight: bold;
            color: #6c757d;
            text-align: center;
        }

        .hidden {
            display: none;
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

    <div class="container mt-5">
        <h1 class="text-center mb-4 page-title">Comments for <?php echo htmlspecialchars($site['nom_site']); ?></h1>

        <div class="row">
            <?php if (!empty($comments)) : ?>
                <?php foreach ($comments as $comment) : ?>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="comment-card">
                            <h5>Comment</h5>
                            <p><?php echo htmlspecialchars($comment['contenu']); ?></p>

                            <div class="d-flex justify-content-between">
                                <!-- Update Button -->
                                <button class="btn btn-action btn-update edit-button">Update</button>

                                <!-- Delete Button -->
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="delete_comment_id" value="<?php echo $comment['id']; ?>">
                                    <button type="submit" class="btn btn-action btn-delete" onclick="return confirm('Are you sure you want to delete this comment?');">Delete</button>
                                </form>
                            </div>

                            <!-- Update Form -->
                            <form method="POST" class="mt-3 hidden update-form">
                                <input type="hidden" name="update_comment_id" value="<?php echo $comment['id']; ?>">
                                <textarea name="updated_content" class="form-control" rows="2"><?php echo htmlspecialchars($comment['contenu']); ?></textarea>
                                <button type="submit" class="btn btn-sm btn-success mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12">
                    <p class="no-comments">No comments yet for this site.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="sitesList.php" class="btn btn-back">Back to Sites</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editButtons = document.querySelectorAll('.edit-button');
            const updateForms = document.querySelectorAll('.update-form');

            editButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    updateForms[index].classList.toggle('hidden');
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
