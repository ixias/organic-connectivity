<?php




$hidden_hash_var='K2JSHD4KFJH7KJDS7';

$LOGGED_IN=FALSE;
// Clear it out in case someone sets it in the URL or something
unset($LOGGED_IN);





function loggedin(){

	global $user_name, $id_hash, $hidden_hash_var, $LOGGED_IN;

	// Have we already run the hash checks? 
	// If so, return the pre-set var
	if(isset($LOGGED_IN)){

        return $LOGGED_IN;

	}
	elseif(isset($_COOKIE['user_name']) && $_COOKIE['id_hash']){

		$hash=md5($_COOKIE['user_name'].$hidden_hash_var);

		if($hash==$_COOKIE['id_hash']){
			$LOGGED_IN=TRUE;
			return $LOGGED_IN;
		}
		else{
			$LOGGED_IN=FALSE;
			return $LOGGED_IN;
		}

	}
	else{

		$LOGGED_IN=FALSE;
		return $LOGGED_IN;

	}
}








function login($userArray,$pass){

	if($pass==$userArray['password']){

		return TRUE;

	}

	return FALSE;

}










function user($userName,$accountDir) {
	if (file_exists($accountDir.'/index.xml')) {
		$userbaseIndex = new DOMDocument();
		if (!$userbaseIndex->load($accountDir.'/index.xml')) {
			echo('<div class="error">Could not open accounts file</div>');
			exit;
		}
		$userbaseIndex = $userbaseIndex->getElementsByTagName('index')->item(0);
		foreach ($userbaseIndex->childNodes as $user_entry) {
			if ($user_entry->nodeType == 1 && $user_entry->nodeName == 'item') {
				if ($userName == $user_entry->getAttribute('user')) {
					if (file_exists($accountDir.'/'.$user_entry->getAttribute('data'))) {
						$user_data = new DOMDocument();
						if (!$user_data->load($accountDir.'/'.$user_entry->getAttribute('data'))) {
							echo('	<p>Could not open account file.</p>');
							exit;
						}
						$user_data = $user_data->getElementsByTagName('user')->item(0);
						$user['username'] = $user_data->getAttribute('username');
						$user['password'] = $user_data->getAttribute('password');
						$user['email'] = $user_data->getAttribute('email');
						$user['admin'] = $user_data->getAttribute('admin');
						$user['publicprofile'] = $user_data->getAttribute('publicprofile');
						$user['realname'] = $user_data->getAttribute('realname');
						$user['location'] = $user_data->getAttribute('location');
						$user['publicemail'] = $user_data->getAttribute('publicemail');
						$user['homepage'] = $user_data->getAttribute('homepage');
						$user['icq'] = $user_data->getAttribute('icq');
						$user['aim'] = $user_data->getAttribute('aim');
						$user['msn'] = $user_data->getAttribute('msn');
						$user['yahoo'] = $user_data->getAttribute('yahoo');
						$user['photo'] = $user_data->getAttribute('photo');
						$user['update'] = $user_data->getAttribute('update');
						#$user['interests'] = $user_data->getElementsByTag('interests')->item(0)->textContent;
						return $user;
					}
				}
			}
		}
	}
}







function user_logout() {
	setcookie('user_name','',(time()+2592000),'/','',0);
	setcookie('id_hash','',(time()+2592000),'/','',0);
}







function user_set_tokens($user_name_in) {
	global $hidden_hash_var, $user_name, $id_hash;
	if (!$user_name_in) {
		$GLOBALS['feedback'].='ERROR - User Name Missing When Setting Tokens';
		return false;
	}
	$user_name = strtolower($user_name_in);
	$id_hash = md5($user_name.$hidden_hash_var);
	#setcookie('user_name',$user_name,(time()+2592000),'/','',0);
	#setcookie('id_hash',$id_hash,(time()+2592000),'/','',0);
	setcookie('user_name',$user_name,null,'/','',0);
	setcookie('id_hash',$id_hash,null,'/','',0);
	return true;
}






?>