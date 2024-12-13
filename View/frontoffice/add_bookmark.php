<?php
include_once 'C:/xampp/htdocs/projetweb2025/Controller/bookmarkController.php';

// Simulate user ID (replace with your user session logic)
$currentUserId = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $siteId = intval($data['site_id']);

    $bookmarkController = new BookmarkController();

    // Check if the site is already bookmarked
    $existingBookmark = $bookmarkController->isBookmarked($currentUserId, $siteId);

    if ($existingBookmark) {
        echo json_encode(['success' => false, 'message' => 'This site is already bookmarked.']);
    } else {
        // Add the bookmark
        if ($bookmarkController->addBookmark($currentUserId, $siteId)) {
            echo json_encode(['success' => true, 'message' => 'Bookmark added successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add bookmark.']);
        }
    }
}
?>
