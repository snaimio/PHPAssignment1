<?php
/**
 * logout.php
 * Ends the user's session and redirects to the login page.
 */

declare(strict_types=1);

session_start();
// ↑ I must start the session before I can destroy it.

$_SESSION = [];
// ↑ Clear all session variables (the fastest way is to assign an
//   empty array to the whole $_SESSION superglobal).

session_destroy();
// ↑ Remove the session file on the server side.

header('Location: login_form.php');
die();
// ↑ Send the user to the login page and stop execution.