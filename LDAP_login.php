<?php


		$user = "mlinares";
		$pass = "control50";

		$ds = "dominio";
		$dn = "es el dn";


    //define('DOMINIO', 'midominio.com.sv');
    //define('DN', 'dc=midominio,dc=com,dc=sv');




function mailboxpowerloginrd($user,$pass,$ds,$dn){
     $ldaprdn = trim($user).'@'.$ds;
     $ldappass = trim($pass);
     $puertoldap = 389;
     $ldapconn = ldap_connect($ds,$puertoldap);
       ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3);
       ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0);
       $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
       if ($ldapbind){
         $filter="(|(SAMAccountName=".trim($user)."))";
         $fields = array("SAMAccountName");
         $sr = @ldap_search($ldapconn, $dn, $filter, $fields);
         $info = @ldap_get_entries($ldapconn, $sr);
         $array = $info[0]["samaccountname"][0];
       }else{
             $array=0;
       }
     ldap_close($ldapconn);
     return $array;
}



        header("Content-Type: text/html; charset=utf-8");

        $usuario = mailboxpowerloginrd($$user,pass,$ds,$dn);
        if($usuario == "0" || $usuario == ''){
            $_SERVER = array();
            $_SESSION = array();
            echo "Erreur d'utilisateur ou mot de passe";
        }else{
            session_start();
            $_SESSION["user"] = $usuario;
            $_SESSION["autentica"] = "SIP";
            echo "Conexion OK";
        }

?>








httpd.conf:
----------

<Location  /ldapdir>
	AuthName "whatever_LDAP"
	AuthType Basic
	AuthBasicProvider ldap
	AuthLDAPURL ldap://9.27.163.182:389/o=abc.xyz.com?cn?sub?
	Require valid-user
	AuthLDAPBindDN "cn=Directory Manager"
	AuthLDAPBindPassword d44radar
</Location>

<Directory /var/www/>
	AuthType Basic
	AuthName "Authentication system: please insert username and password"
	AuthBasicProvider ldap
	AuthzLDAPAuthoritative on
	AuthLDAPURL ldap://s1.test.es:389/ou=Users,dc=zentyal?uid?sub
	AuthLDAPBindDN "cn=ebox,dc=zentyal"
	AuthLDAPBindPassword ly3sduWefe/BDu
	require valid-user
</Directory>
