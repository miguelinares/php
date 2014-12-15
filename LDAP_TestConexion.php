<?php
	$utilisateur = 'ldap1'; //sn

    //Asigner variables pour accéder au serveur LDAP
    $host = "192.168.142.146";
    $user = "cn=Administrator,dc=Redes";
    $pswd = "miguel";

    $ad = ldap_connect($host)
    or die("Imposible Conectar");

    // version du protocole LDAP
    ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3)
    or die ("Erreur dans l'asignation du Protocole LDAP");

    // credentialles pour accèder au serveur LDAP
    $bd = ldap_bind($ad, $user, $pswd)
    or die ("Imposible valider au serveur LDAP");

    // Je cree le DN
    $dn = "DC=redes";
    //$dn = "OU=Admin,DC=empresa,DC=local";

    // La consultation
    $attrs = array("displayname","mail","cn","telephonenumber","givenname");

    // Le filtre de recherche
    //$filter = "(samaccountname=$utilisateur)";
    $filter = "(sn=$utilisateur)";

    $search = ldap_search($ad, $dn, $filter, $attrs)
    or die ("");

    $entries = ldap_get_entries($ad, $search);

    if ($entries["count"] > 0)
        {
        for ($i=0; $i<$entries["count"]; $i++)
                {
            echo "<p>Nom: ".$entries[$i]["displayname"][0]."<br />";
            echo "Courriel: <a href=mailto:".$entries[$i]["mail"][0].">".$entries[$i]["mail"][0]."</a><br />";
            echo "Utilisateur: ".$entries[$i]["cn"][0]."<br />";
            echo "Telephone: ".$entries[$i]["telephonenumber"][0]."</p>";
            }
    } else {
        echo "<p>Aucune resultat</p>";
    }
    ldap_unbind($ad);


	$username=shell_exec("echo %username%" );
    echo ("username : " . $username  );
	echo "<br>PC: " . gethostbyaddr($_SERVER['REMOTE_ADDR']);


	//**********************************************************************
    echo ("username automatique: " . $getenv('REMOTE_USER'));





	//**********************************************************************
	//echo ("username :" . $_SESSION['LOGON_USER']);
	//echo ("<br>username :" . $_SERVER['PHP_AUTH_USER']);

	//**********************************************************************
	/*
	header('WWW-Authenticate: NTLM');
	echo $_SERVER['AUTH_USER'];



	if ($_SERVER['PHP_AUTH_USER'] == "") {
	            header('WWW-Authenticate: Basic realm="www.yoursite.com Admin"');
	            header('HTTP/1.0 401 Unauthorized');
	            $error =  "Sorry you are not authorized";
	        } else {

	    $useradmin = $_SERVER["PHP_AUTH_USER"];
	                $pass = $_SERVER["PHP_AUTH_PW"];
	    echo $useradmin."-".$pass;
        }
	*/


	exit;
?>
Something is wrong with the XAMPP installation :-(
