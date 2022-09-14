<?php
require_once '../config/configoauth.php';
require_once '../config/configbd.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;

  // Verify if there's an account in usuarios
  $stmt = mysqli_prepare($mysqli, "SELECT * FROM usuarios WHERE LOWER(correo) = LOWER(?)");
  mysqli_stmt_bind_param($stmt, "s", $email);

  /* execute query */
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  if (mysqli_num_rows($result) == 0) {
    header("Location: https://comitesdelucha.com");
    die();
  } else {
    session_start();
    $_SESSION['luser'] = $email;
    $_SESSION['start'] = time(); // Taking now logged in time.
    // Ending a session in 6 hours from the starting time.
    $_SESSION['expire'] = $_SESSION['start'] + (6* 60 * 60);
    header('Location: ' . $location_admon);
  }
} else {
  header("Location: https://comitesdelucha.com");
  die();
}
?>