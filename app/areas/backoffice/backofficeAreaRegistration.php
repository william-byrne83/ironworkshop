<?php
class BackofficeArea{
	public static function registerArea(){    
		$areaArray = array(
			"areaName" => "Backoffice",
			"areaUrl" => "backoffice/",
			"areaController" => "adminusers",
			"areaAction" => "index"
		);
		return $areaArray;
	}
	
}