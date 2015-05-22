<?php

class WebUser extends CWebUser {
    // array set in config/main.php
    public $availableLanguages;

    public function getLanguage() {
        if ($this->getState('lang') == null) {
            $lang = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
            $this->setLanguage($lang);
        }
        return $this->getState('lang');
    }

    public function setLanguage($lang) {
        $this->setState('lang', $lang);
    }

    public function applyPreferedLanguage() {
        Yii::app()->language = $this->getLanguage();
    }
}
