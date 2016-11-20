<?php
/*
type_auth:
1. password
2. rsa without password
3. rsa with password
*/

$project_dir = "";

$repository_url_ssh = "";
$repository_name = "";

$root_user = "root";
$rsa_file_path="";
$root_or_rsa_password = "";

$ip_server= "";
$port_ssh_server = "22";

$type_auth =1;

$server_seperator="/";

set_include_path(__DIR__.'phpseclib-1.0.5/phpseclib/');

include('phpseclib-1.0.5/phpseclib/Net/SSH2.php');

$ssh = new Net_SSH2($ip_server,$port_ssh_server);
if($type_auth>1){
	include('phpseclib-1.0.5/phpseclib/Crypt/RSA.php');
	$key = new Crypt_RSA();
	if($type_auth>2){
		$key->setPassword($root_or_rsa_password);
	}
	$key->loadKey(file_get_contents($rsa_file_path));
}else{
	$key=$root_or_rsa_password;
}
if (!$ssh->login($root_user, $key)) {
	exit('Login Failed');
}
if(is_dir($project_dir.$server_seperator.$repository_name)){
	$res = $ssh->exec('cd '.$project_dir.$server_seperator.$repository_name.' && git pull');
}else{
	$res = $ssh->exec('cd '.$project_dir.' && git clone '.$repository_url_ssh);
}
echo $res;
?>