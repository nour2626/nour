<?php
header('Content-Type: application/json');
include_once 'C:/xampp/htdocs/projetweb2025/Controller/sitesController.php';

try {
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Decode the JSON input
        $data = json_decode(file_get_contents('php://input'), true);

        // Check if 'site_id' exists and is not empty
        if (isset($data['site_id']) && !empty($data['site_id'])) {
            $siteId = intval($data['site_id']); // Sanitize the site_id
            $sitesController = new SitesController();

            // Attempt to remove the bookmark
            if ($sitesController->removeBookmark($siteId)) {
                echo json_encode(['success' => true, 'message' => 'Bookmark removed successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to remove bookmark.']);
            }
        } else {
            // Handle missing or invalid site_id
            throw new Exception('Invalid or missing site_id.');
        }
    } else {
        throw new Exception('Invalid request method.');
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
