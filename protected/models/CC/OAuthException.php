<?php
class OAuthException extends Exception{
    public function __construct($message, $code = 0, Exception $previous = null){
        parent::__construct($message, $code, $previous);
        $this->logError($message);
    }

    private function logError($errorText, $file="error.log"){
        $message = "Constant Contact OAuth Exception -- ".date("F j, Y, g:ia")."\n".$errorText."\n";
        $message .= "From: ".$this->getFile()." line ".$this->getLine();
        error_log($message."\n\n", 3, $file);
    }
}