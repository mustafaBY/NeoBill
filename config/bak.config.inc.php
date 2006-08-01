<?php
/**
 * config.php
 *
 * This file contains a set of basic configuration variables that are needed to
 * run SolidState.  More (most) configuration options are stored in the datbase,
 * and can be set through the "Administration > Settings" page.
 *
 * Database configuration:
 *
 *   $db['host']     - This is the host that your MySQL database server runs on
 *   $db['user']     - Database user with access to the SolidState database
 *   $db['pass']     - Password for the database user
 *   $db['database'] - The name of the database that SolidState will be using.
 *   $db['encoded']	 - 0 for MySQL information unenccoded
 *                     1 for encoded
 * 
 * System Config
 * 
 *   $config['installed'] - Is SS Installed?
 *   $config['cache']     -	Absolute path of smarty cache directory
 *   $config['compiled']  - Absolute path of smarty compiled (template_c) directory
 *   $config['encoded']   - 0 for MySQL information unenccoded
 *                   		1 for encoded
**/

$this_pathinfo  = pathinfo( __FILE__ );
$base_path      = ereg_replace("config/", "", $this_pathinfo['dirname']);

/** 
 * ----------------------------------------------------------------------
 * The following define some global settings for the application
 * ---------------------------------------------------------------------
**/

global $config;

$config['installed'] = 0;
$config['cache'] = '/var/webs/dev.stalag13.net/htdocs/ss/solidworks/smarty/cache';
$config['compiled'] = '/var/webs/dev.stalag13.net/htdocs/ss/solidworks/smarty/templates_c';
$config['encoded']	 = 1;

global $db;

$db['host'] = 'localhost';
$db['user'] = 'bWF4aW1zdHVkaW9zX21heA==';
$db['pass'] = 'MmJwZWxl';
$db['database'] = 'maximstudios_solid';

?>