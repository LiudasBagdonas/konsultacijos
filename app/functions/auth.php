<?php

/**
 * Check if user is Logged In
 * @return bool
 */
function is_logged_in(): bool
{
        if ($_SESSION) {
            $db_data = file_to_array(DB_FILE);
if(isset($db_data['credentials']))
            foreach ($db_data['credentials'] as $entry) {

                if ($entry['email'] === $_SESSION['email']
                    && $entry['password'] === $_SESSION['password']) {

                    return true;
                }
            }
        }

    return false;
}

/**
 * Function ends the session
 *
 * @param null $redirect
 */
function logout($redirect = null): void
{
    $_SESSION = [];
    session_destroy();
    if ($redirect) {
        header("Location: $redirect");
    }
}