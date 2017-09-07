<?php
use \Bitrix\Main\Application;
use \Bitrix\Main\Entity\Base;

Class Reservation extends CModule
{
    var $MODULE_ID = "reservation";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $errors;

    function __construct() {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_NAME = "Reservation";
        $this->MODULE_DESCRIPTION = "Модуль для бронирования мест в различных сеансах.";
    }

    function DoInstall() {
        $this->InstallDB();
        $this->InstallFiles();
        RegisterModule($this->MODULE_ID);
        return true;
    }
    
    function DoUninstall() {
        $this->UnInstallDB();
        $this->UnInstallFiles();
        UnRegisterModule($this->MODULE_ID);
        return true;
    }
    
    function InstallDB() {
        global $DB;
        $this->errors = false;
        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/local/modules/" . $this->MODULE_ID. "/install/db/install.sql");
        if (!$this->errors) {
            return true;
        } else
            return $this->errors;
    }
    
    function UnInstallDB()
    {
        global $DB;
        $this->errors = false;
        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/local/modules/" . $this->MODULE_ID. "/install/db/uninstall.sql");
        if (!$this->errors) {
            return true;
        } else
            return $this->errors;
    }
    
    function InstallFiles($arParams = array())
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/" . $this->MODULE_ID. "/install/components", $_SERVER["DOCUMENT_ROOT"]."/local/components", true, true);
        return true;
    }

    function UnInstallFiles()
    {
        return true;
    }
}
?>