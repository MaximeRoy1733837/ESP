<?php
$i = 0;
$cfg['blowfish_secret'] = 'h]C+{nqW$omNoTIkCwC$%z-LTcy%p6_j';
$wampConf = @parse_ini_file('../../wampmanager.conf');
$mariaFirst = ($wampConf['SupportMySQL'] == 'on' && $wampConf['SupportMariaDB'] == 'on' && $wampConf['mariaPortUsed'] == $wampConf['mysqlDefaultPort']) ? true : false;
if($wampConf['SupportMySQL'] == 'on') {
	$i++;
	if($mariaFirst) $i++;
	$cfg['Servers'][$i]['verbose'] = 'MySQL';
	$cfg['Servers'][$i]['host'] = '127.0.0.1';
	$cfg['Servers'][$i]['port'] = $wampConf['mysqlPortUsed'];
	$cfg['Servers'][$i]['extension'] = 'mysqli';
	$cfg['Servers'][$i]['auth_type'] = 'cookie';
	$cfg['Servers'][$i]['user'] = 'root';
	/* ********************************************************************* */
	// Écrire votre mot de passe ici
	$cfg['Servers'][$i]['password'] = 'Mecanium20';
	/* ********************************************************************* */
	$cfg['Servers'][$i]['AllowNoPassword'] = false;
}

?>
