<?php
Yii::import("application.models.CC.CTCTAccessToken");
class CTCTDataStore {
    function __construct(){
    }
    function addUser($user){
        /*$_SESSION['users'][$user['username']] = $user;*/
	$accessToken = CTCTAccessToken::model()->findByPk($user['username']);
	if($accessToken === NULL)
		$accessToken = new CTCTAccessToken();	
		
	foreach($user as $k => $v)
		$accessToken->$k = $v;
	$result = $accessToken->save();
	return $result;
    }

    function lookupUser($username){
        /*try{
            if(isset($_SESSION['users'])){
                foreach ($_SESSION['users'] as $user){
                    if($user['username'] == $username){$returnUser = $user;}
                }
            }
            if(empty($returnUser)) {
                $returnUser = false;
                throw new Exception('Username '.$username.' not found in datastore');
            }
        }catch(Exception $e){
            echo 'OAuth Exception: '.$e->getMessage();
        }
        return $returnUser;*/
	try{
		$model =	CTCTAccessToken::model()->findByPk($username);
		if($model === NULL){
			$model = false;
			throw new Exception("Username: $username not found");
		}
	}catch(Exception $e){
		echo "OAuth Exception: " . $e->getMessage();
	}
	return $model;
    }

    function lookup_consumer($consumer_key) {
     // optional: implement me
    }

    function lookup_token($consumer, $token_type, $token) {
    // optional: implement me
    }

    function lookup_nonce($consumer, $token, $nonce, $timestamp) {
    // optional: implement me
    }

    function new_request_token($consumer, $callback = null) {
    // optional: return a new token attached to this consumer
    }

    function new_access_token($token, $consumer, $verifier = null) {
    // return a new access token attached to this consumer
    // for the user associated with this token if the request token
    // is authorized
    // should also invalidate the request token
    }

}