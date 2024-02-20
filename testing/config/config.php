<?php

//Default Configuration
$CONFIG = '{"lang":"es","error_reporting":false,"show_hidden":false,"hide_Cols":false,"theme":"dark"}';

/**
 * H3K | Tiny File Manager V2.5.3
 * @author CCP Programmers
 * @email ccpprogrammers@gmail.com
 * @github https://github.com/prasathmani/tinyfilemanager
 * @link https://tinyfilemanager.github.io
 */

//TFM version
define('VERSION', '2.5.3');

//Application Title
define('APP_TITLE', 'TESTING FILE MANAGER');

// --- EDIT BELOW CONFIGURATION CAREFULLY ---

// Auth with login/password
// set true/false to enable/disable it
// Is independent from IP white- and blacklisting
$use_auth = true;

// Login user name and password
// Users: array('Username' => 'Password', 'Username2' => 'Password2', ...)
// Generate secure password hash - https://tinyfilemanager.github.io/docs/pwd.html
$auth_users = array(
    'admin' => '$2y$10$/K.hjNr84lLNDt8fTXjoI.DBp6PpeyoJ.mGwrrLuCZfAwfSAGqhOW', //admin@123
    'user' => '$2y$10$Fg6Dz8oH9fPoZ2jJan5tZuv6Z4Kp7avtQ9bDfrdRntXtPeiMAZyGO' //12345
);

// Readonly users
// e.g. array('users', 'guest', ...)
$readonly_users = [
    'user'
];

// Global readonly, including when auth is not being used
$global_readonly = true;

// user specific directories
// array('Username' => 'Directory path', 'Username2' => 'Directory path', ...)
$directories_users = [];

// Enable highlight.js (https://highlightjs.org/) on view's page
$use_highlightjs = true;

// highlight.js style
// for dark theme use 'ir-black'
$highlightjs_style = 'vs';

// Enable ace.js (https://ace.c9.io/) on view's page
$edit_files = true;

// Default timezone for date() and time()
// Doc - http://php.net/manual/en/timezones.php
$default_timezone = 'Etc/UTC'; // UTC

// Root path for file manager
// use absolute path of directory i.e: '/var/www/folder' or $_SERVER['DOCUMENT_ROOT'].'/folder'
$root_path = $_SERVER['DOCUMENT_ROOT'];

// Root url for links in file manager.Relative to $http_host. Variants: '', 'path/to/subfolder'
// Will not working if $root_path will be outside of server document root
$root_url = '';

// Server hostname. Can set manually if wrong
// $_SERVER['HTTP_HOST'].'/folder'
$http_host = $_SERVER['HTTP_HOST'];

// input encoding for iconv
$iconv_input_encoding = 'UTF-8';

// date() format for file modification date
// Doc - https://www.php.net/manual/en/function.date.php
$datetime_format = 'm/d/Y g:i A';

// Path display mode when viewing file information
// 'full' => show full path
// 'relative' => show path relative to root_path
// 'host' => show path on the host
$path_display_mode = 'full';

// Allowed file extensions for create and rename files
// e.g. 'txt,html,css,js'
$allowed_file_extensions = '';

// Allowed file extensions for upload files
// e.g. 'gif,png,jpg,html,txt'
$allowed_upload_extensions = '';

// Favicon path. This can be either a full url to an .PNG image, or a path based on the document root.
// full path, e.g http://example.com/favicon.png
// local path, e.g images/icons/favicon.png
$favicon_path = '';

// Files and folders to excluded from listing
// e.g. array('myfile.html', 'personal-folder', '*.php', ...)
$exclude_items = [];

// Online office Docs Viewer
// Availabe rules are 'google', 'microsoft' or false
// Google => View documents using Google Docs Viewer
// Microsoft => View documents using Microsoft Web Apps Viewer
// false => disable online doc viewer
$online_viewer = 'google';

// Sticky Nav bar
// true => enable sticky header
// false => disable sticky header
$sticky_navbar = false;

// Maximum file upload size
// Increase the following values in php.ini to work properly
// memory_limit, upload_max_filesize, post_max_size
$max_upload_size_bytes = 5000000000; // size 5,000,000,000 bytes (~5GB)

// chunk size used for upload
// eg. decrease to 1MB if nginx reports problem 413 entity too large
$upload_chunk_size_bytes = 2000000; // chunk size 2,000,000 bytes (~2MB)

// Possible rules are 'OFF', 'AND' or 'OR'
// OFF => Don't check connection IP, defaults to OFF
// AND => Connection must be on the whitelist, and not on the blacklist
// OR => Connection must be on the whitelist, or not on the blacklist
$ip_ruleset = 'OFF';

// Should users be notified of their block?
$ip_silent = true;

// IP-addresses, both ipv4 and ipv6
$ip_whitelist = [
    '127.0.0.1',    // local ipv4
    '::1'           // local ipv6
];

// IP-addresses, both ipv4 and ipv6
$ip_blacklist = [
    '0.0.0.0',      // non-routable meta ipv4
    '::'            // non-routable meta ipv6
];

// External CDN resources that can be used in the HTML (replace for GDPR compliance)
$external = [
    'css-bootstrap' => '<link href="assets/css/bootstrap.min.css" rel="stylesheet">',
    'css-dropzone' => '<link href="assets/css/dropzone.min.css" rel="stylesheet">',
    'css-font-awesome' => '<link rel="stylesheet" href="assets/css/font-awesome.min.css" crossorigin="anonymous">',
    'css-highlightjs' => '<link rel="stylesheet" href="assets/css/' . $highlightjs_style . '.min.css">',
    'js-ace' => '<script src="assets/js/ace.js"></script>',
    'js-bootstrap' => '<script src="assets/js/bootstrap.bundle.min.js"></script>',
    'js-dropzone' => '<script src="assets/js/dropzone.min.js"></script>',
    'js-jquery' => '<script src="assets/js/jquery-3.6.1.min.js"></script>',
    'js-jquery-datatables' => '<script src="assets/js/datatables.min.js"></script>',
    'js-highlightjs' => '<script src="assets/js/highlight.min.js"></script>',
];
