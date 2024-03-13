<?php
//require_once 'classes/user.php';
require_once "../vendor/autoload.php";
use Login\classes\User;
    // Functie: programma login OOP 
    // Auteur: Wigmans

    // Initialisatie
?>

<!DOCTYPE html>

<html lang="en">

<body>

	<h3>PDO Login and Registration</h3>
	<hr/>

	<h3>Welcome op de HOME-pagina!</h3>
	<br />
	<?php

require_once 'classes/user.php';

$user = new User();

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    $user->Logout();
}

if(!$user->IsLoggedin()){
    echo "U bent niet ingelogd. Login in om verder te gaan.<br><br>";
    echo '<a href = "login_form.php">Login</a>';
} else {
    $user->GetUser($user);
    
    echo "<h2>Het spel kan beginnen</h2>";
    echo "Je bent ingelogd met:<br/>";
    $user->ShowUser();
    echo "<br><br>";
    echo '<a href = "?logout=true">Logout</a>';
}

?>

</body>
</html>