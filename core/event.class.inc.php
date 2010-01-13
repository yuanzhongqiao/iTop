<?php

/**
 * An application internal event
 *
 * @package     iTopORM
 * @author      Romain Quetiez <romainquetiez@yahoo.fr>
 * @author      Denis Flaven <denisflave@free.fr>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.itop.com
 * @since       1.0
 * @version     1.1.1.1 $
 */
class Event extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "core/cmdb",
			"name" => "Log Event",
			"description" => "An application internal event",
			"key_type" => "autoincrement",
			"key_label" => "",
			"name_attcode" => "",
			"state_attcode" => "",
			"reconc_keys" => array(),
			"db_table" => "priv_event",
			"db_key_field" => "id",
			"db_finalclass_field" => "realclass",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		//MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeString("message", array("label"=>"message", "description"=>"short description of the event", "allowed_values"=>null, "sql"=>"message", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("date", array("label"=>"date", "description"=>"date and time at which the changes have been recorded", "allowed_values"=>null, "sql"=>"date", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("userinfo", array("label"=>"user info", "description"=>"identification of the user that was doing the action that triggered this event", "allowed_values"=>null, "sql"=>"userinfo", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));

		//MetaModel::Init_InheritFilters();
		MetaModel::Init_AddFilterFromAttribute("message");
		MetaModel::Init_AddFilterFromAttribute("date");

		// Display lists
		MetaModel::Init_SetZListItems('details', array('message', 'date', 'userinfo')); // Attributes to be displayed for the complete details
		MetaModel::Init_SetZListItems('list', array('date', 'finalclass', 'message')); // Attributes to be displayed for a list
		// Search criteria
//		MetaModel::Init_SetZListItems('standard_search', array('name')); // Criteria of the std search form
//		MetaModel::Init_SetZListItems('advanced_search', array('name')); // Criteria of the advanced search form
	}
}

class EventNotification extends Event
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "core/cmdb",
			"name" => "Notification event",
			"description" => "Trace of a notification that has been sent",
			"key_type" => "autoincrement",
			"key_label" => "",
			"name_attcode" => "",
			"state_attcode" => "",
			"reconc_keys" => array(),
			"db_table" => "priv_event_notification",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("trigger_id", array("targetclass"=>"Trigger", "jointype"=> "", "label"=>"Trigger", "description"=>"user account", "allowed_values"=>null, "sql"=>"trigger_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("action_id", array("targetclass"=>"Action", "jointype"=> "", "label"=>"user", "description"=>"user account", "allowed_values"=>null, "sql"=>"action_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("object_id", array("label"=>"Object id", "description"=>"object id (class defined by the trigger ?)", "allowed_values"=>null, "sql"=>"object_id", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));

		MetaModel::Init_InheritFilters();
		MetaModel::Init_AddFilterFromAttribute("trigger_id");
		MetaModel::Init_AddFilterFromAttribute("action_id");

		// Display lists
		MetaModel::Init_SetZListItems('details', array('date', 'userinfo', 'trigger_id', 'action_id', 'object_id')); // Attributes to be displayed for the complete details
		MetaModel::Init_SetZListItems('list', array('date', 'userinfo')); // Attributes to be displayed for a list
		// Search criteria
//		MetaModel::Init_SetZListItems('standard_search', array('name')); // Criteria of the std search form
//		MetaModel::Init_SetZListItems('advanced_search', array('name')); // Criteria of the advanced search form
	}

}

class EventNotificationEmail extends EventNotification
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "core/cmdb",
			"name" => "Email emission event",
			"description" => "Trace of an email that has been sent",
			"key_type" => "autoincrement",
			"key_label" => "",
			"name_attcode" => "",
			"state_attcode" => "",
			"reconc_keys" => array(),
			"db_table" => "priv_event_email",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeText("to", array("label"=>"TO", "description"=>"TO", "allowed_values"=>null, "sql"=>"to", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("cc", array("label"=>"CC", "description"=>"CC", "allowed_values"=>null, "sql"=>"cc", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("bcc", array("label"=>"BCC", "description"=>"BCC", "allowed_values"=>null, "sql"=>"bcc", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("subject", array("label"=>"Subject", "description"=>"Subject", "allowed_values"=>null, "sql"=>"subject", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("body", array("label"=>"Body", "description"=>"Body", "allowed_values"=>null, "sql"=>"body", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));

		MetaModel::Init_InheritFilters();

		// Display lists
		MetaModel::Init_SetZListItems('details', array('date', 'userinfo', 'trigger_id', 'action_id', 'object_id', 'to', 'cc', 'bcc', 'subject', 'body')); // Attributes to be displayed for the complete details
		MetaModel::Init_SetZListItems('list', array('date', 'userinfo', 'subject')); // Attributes to be displayed for a list
		// Search criteria
//		MetaModel::Init_SetZListItems('standard_search', array('name')); // Criteria of the std search form
//		MetaModel::Init_SetZListItems('advanced_search', array('name')); // Criteria of the advanced search form
	}

}

class EventIssue extends Event
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "core/cmdb",
			"name" => "Issue event",
			"description" => "Trace of an issue (warning, error, etc.)",
			"key_type" => "autoincrement",
			"key_label" => "",
			"name_attcode" => "",
			"state_attcode" => "",
			"reconc_keys" => array(),
			"db_table" => "priv_event_issue",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeString("issue", array("label"=>"Issue", "description"=>"What happened", "allowed_values"=>null, "sql"=>"issue", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("impact", array("label"=>"Impact", "description"=>"What are the consequences", "allowed_values"=>null, "sql"=>"impact", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("page", array("label"=>"Page", "description"=>"HTTP entry point", "allowed_values"=>null, "sql"=>"page", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("arguments_post", array("label"=>"Posted arguments", "description"=>"HTTP POST arguments", "allowed_values"=>null, "sql"=>"arguments_post", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("arguments_get", array("label"=>"URL arguments", "description"=>"HTTP GET arguments", "allowed_values"=>null, "sql"=>"arguments_get", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("callstack", array("label"=>"Callstack", "description"=>"Call stack", "allowed_values"=>null, "sql"=>"callstack", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeBlob("data", array("label"=>"Data", "description"=>"More information", "allowed_values"=>null, "sql"=>"data", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_InheritFilters();
		MetaModel::Init_AddFilterFromAttribute("issue");
		MetaModel::Init_AddFilterFromAttribute("impact");

		// Display lists
		MetaModel::Init_SetZListItems('details', array('date', 'userinfo', 'issue', 'impact', 'page', 'arguments_post', 'arguments_get', 'callstack', 'data')); // Attributes to be displayed for the complete details
		MetaModel::Init_SetZListItems('list', array('date', 'userinfo', 'issue', 'impact')); // Attributes to be displayed for a list
		// Search criteria
//		MetaModel::Init_SetZListItems('standard_search', array('name')); // Criteria of the std search form
//		MetaModel::Init_SetZListItems('advanced_search', array('name')); // Criteria of the advanced search form
	}
}


class EventWebService extends Event
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "core/cmdb",
			"name" => "Web service event",
			"description" => "Trace of an web service call",
			"key_type" => "autoincrement",
			"key_label" => "",
			"name_attcode" => "",
			"state_attcode" => "",
			"reconc_keys" => array(),
			"db_table" => "priv_event_webservice",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeString("verb", array("label"=>"Verb", "description"=>"Name of the operation", "allowed_values"=>null, "sql"=>"verb", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		//MetaModel::Init_AddAttribute(new AttributeStructure("arguments", array("label"=>"Arguments", "description"=>"Operation arguments", "allowed_values"=>null, "sql"=>"data", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeBoolean("result", array("label"=>"Result", "description"=>"Overall success/failure", "allowed_values"=>null, "sql"=>"result", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("log_info", array("label"=>"Info log", "description"=>"Result info log", "allowed_values"=>null, "sql"=>"log_info", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("log_warning", array("label"=>"Warning log", "description"=>"Result warning log", "allowed_values"=>null, "sql"=>"log_warning", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("log_error", array("label"=>"Error log", "description"=>"Result error log", "allowed_values"=>null, "sql"=>"log_error", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("data", array("label"=>"Data", "description"=>"Result data", "allowed_values"=>null, "sql"=>"data", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));

		MetaModel::Init_InheritFilters();

		// Display lists
		MetaModel::Init_SetZListItems('details', array('date', 'userinfo', 'verb', 'result', 'log_info', 'log_warning', 'log_error', 'data')); // Attributes to be displayed for the complete details
		MetaModel::Init_SetZListItems('list', array('date', 'userinfo', 'verb', 'result')); // Attributes to be displayed for a list
		// Search criteria
//		MetaModel::Init_SetZListItems('standard_search', array('name')); // Criteria of the std search form
//		MetaModel::Init_SetZListItems('advanced_search', array('name')); // Criteria of the advanced search form
	}
}

?>
