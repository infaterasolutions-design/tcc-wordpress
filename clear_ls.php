<?php
require_once('../../../wp-load.php');
if ( class_exists( 'LiteSpeed\Purge' ) ) {
    LiteSpeed\Purge::purge_all();
    echo "<h1>LiteSpeed Cache Purged successfully!</h1>";
    echo "<p>Your new fonts should now load on all mobile devices.</p>";
} else {
    echo "<h1>LiteSpeed Cache not found.</h1>";
}
