<?php
class CTCTRequest{
    public $baseUri = 'https://api.constantcontact.com';

    # Mutual Credentials
    public $username;
    public $apiKey;
    public $authType;

    # Basic Credentials
    public $requestLogin;

    # OAuth Credentials
    public $consumerSecret;
    public $consumer;
    public $accessToken;
    public $signatureMethod;


    /*
     *
     *  @param string $authType - 'basic' or 'oauth' authentication
     *  @param string $apiKey - valid apiKey
     *  @param string $username - constant contact username
     *  @param string $authParam - password for Basic authentication, consumerSecret for OAuth authentication
     */
    public function __construct($authType, $apiKey, $username, $authParam){
        $this->apiKey = $apiKey;
        $this->username = $username;


        if($authType == 'basic'){
            $this->authType = 'basic';
            $this->basic_construct($apiKey, $username, $authParam);
        } elseif($authType == 'oauth') {
            $this->authType = 'oauth';
            $this->oauth_construct($apiKey, $authParam);
        }
    }

    private function oAuth_construct($apiKey, $consumerSecret){
        $this->authType = 'oauth';
        $this->consumer = new OAuthConsumer($apiKey, $consumerSecret);
        $this->signatureMethod = new OAuthSignatureMethod_HMAC_SHA1();
    }

    private function basic_construct($apiKey, $username, $password){
        $this->requestLogin = $apiKey.'%'.$username.':'.$password;
        $this->authType = 'basic';
    }

    public function makeRequest($url, $method, $body='', $contentType="application/atom+xml"){
        if($this->authType == 'oauth'){
            $Datastore = new CTCTDataStore();
            $accessInfo = $Datastore->lookupUser($this->username);
            $accessToken = new OAuthToken((string)$accessInfo['key'], (string)$accessInfo['secret']);
            $this->accessToken = $accessToken;
            $request = OAuthRequest::from_consumer_and_token($this->consumer, $accessToken, $method, $url);
            $request->sign_request($this->signatureMethod, $this->consumer, $accessToken);
            $request->get_normalized_http_method();
            $url = $request;
        }
        $curl = curl_init();

        if ($this->authType == 'basic'){
           curl_setopt($curl, CURLOPT_USERPWD, $this->requestLogin);
           curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        //curl_setopt($curl, CURLOPT_FAILONERROR, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: ".$contentType, "Content-Length: ". strlen($body), "Accept: application/atom+xml"));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        if ($body) {curl_setopt($curl, CURLOPT_POSTFIELDS, $body);}
        try{
            $return['xml'] = curl_exec($curl);
            $return['info'] = curl_getinfo($curl);
            $return['error'] = curl_error($curl);
            curl_close($curl);

            if(!in_array($return['info']['http_code'], array('201', '200', '204'))){
                throw new CTCTException('Constant Contact HTTP Request Exception: '.$return['xml']);
            } else {
                $return = $return;
            }
        } catch(CTCTException $e) {
            $e->generateError();
        }
        return $return;
    }
}