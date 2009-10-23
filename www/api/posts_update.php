<?php
// Implements the del.icio.us API request for a user's last update time and date.

// del.icio.us behavior:
// - doesn't set the Content-Type to text/xml (we do).

// Force HTTP authentication first!
require_once('httpauth.inc.php');
require_once '../../src/SemanticScuttle/header.php';

/* Service creation: only useful services are created */
$bookmarkservice =SemanticScuttle_Service_Factory::getServiceInstance('Bookmark');


// Get the posts relevant to the passed-in variables.
$bookmarks =& $bookmarkservice->getBookmarks(0, 1, $userservice->getCurrentUserId());


// Set up the XML file and output all the tags.
header('Content-Type: text/xml');
echo '<?xml version="1.0" standalone="yes" ?'.">\r\n";
foreach($bookmarks['bookmarks'] as $row) {
    echo '<update time="'. gmdate('Y-m-d\TH:i:s\Z', strtotime($row['bDatetime'])) .'" />';
}
?>