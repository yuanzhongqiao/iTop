<?php
//
// iTop module definition file
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'itop-bridge-cmdb-services/3.1.2',
	array(
		// Identification
		//
		'label' => 'Bridge for CMDB and Services',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
				'itop-config-mgmt/2.7.1',
				'itop-service-mgmt/2.7.1 || itop-service-mgmt-provider/2.7.1',
		),
		'mandatory' => false,
		'visible' => false,
		'auto_select' => 'SetupInfo::ModuleIsSelected("itop-config-mgmt") && (SetupInfo::ModuleIsSelected("itop-service-mgmt") || SetupInfo::ModuleIsSelected("itop-service-mgmt-provider")) ',

		// Components
		//
		'datamodel' => array(
		),
		'webservice' => array(
			
		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			// Module specific settings go here, if any
		),
	)
);


?>
