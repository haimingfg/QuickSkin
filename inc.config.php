<?php
/*~ inc.config.php
.---------------------------------------------------------------------------.
|  Software: QuickSkin                                                      |
|   Version: 5.0                                                            |
|   Contact: andy.prevost@worxteam.com,andy@codeworxtech.com                |
|      Info: http://quickskin.sourceforge.net                               |
|   Support: http://sourceforge.net/projects/quickskin/                     |
| ------------------------------------------------------------------------- |
|    Author: Andy Prevost andy.prevost@worxteam.com (admin)                 |
|    Author: Manuel 'EndelWar' Dalla Lana endelwar@aregar.it (former admin) |
|    Author: Philipp v. Criegern philipp@criegern.com (original founder)    |
| Copyright (c) 2002-2009, Andy Prevost. All Rights Reserved.               |
|    * NOTE: QuickSkin is the SmartTemplate project renamed. SmartTemplate  |
|            information and downloads can still be accessed at the         |
|            smarttemplate.sourceforge.net site                             |
| ------------------------------------------------------------------------- |
|   License: Distributed under the Lesser General Public License (LGPL)     |
|            http://www.gnu.org/copyleft/lesser.html                        |
| This program is distributed in the hope that it will be useful - WITHOUT  |
| ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or     |
| FITNESS FOR A PARTICULAR PURPOSE.                                         |
| ------------------------------------------------------------------------- |
| We offer a number of paid services:                                       |
| - Web Hosting on highly optimized fast and secure servers                 |
| - Technology Consulting                                                   |
| - Oursourcing (highly qualified programmers and graphic designers)        |
'---------------------------------------------------------------------------'
Last modified: January 01 2009 ~*/

$debugmode = false;

/* START * SET UP COMPRESSION **************** */
if ( ini_get( 'zlib.output_compression' )  && ini_get( 'zlib.output_compression_level' ) != 5 ) {
  ini_set( 'zlib.output_compression_level', '5' );
  ob_start();
}
/* END * SET UP COMPRESSION **************** */

/* START * SET UP DEFAULT PATHS & URLs **************** */
$dirTmp = getcwd();
// define the "root" directory of the application
if (!defined('_DIR_SITE')) {
  if ( strlen( substr($dirTmp,strlen($_SERVER['DOCUMENT_ROOT']) + 1) ) > 0 ) {
    define('_DIR_SITE', substr($dirTmp,strlen($_SERVER['DOCUMENT_ROOT']) + 1) . "/");
  } else {
    define('_DIR_SITE', '');
  }
}
// define the "root" URL of the application
if (!defined('_URL_HOME')) {
  if ( strlen( substr($dirTmp,strlen($_SERVER['DOCUMENT_ROOT']) + 1) ) > 0 ) {
    define('_URL_HOME', "http://" . $_SERVER['HTTP_HOST'] . "/" . substr($dirTmp,strlen($_SERVER['DOCUMENT_ROOT']) + 1) . "/");
  } else {
    define('_URL_HOME', "http://" . $_SERVER['HTTP_HOST'] . "/");
  }
}
// define the paths and URLs of the application
if (!defined('_PATH_HOME'))  { define('_PATH_HOME',  $dirTmp . "/"); }
if (!defined('_PATH_SKINS')) { define('_PATH_SKINS', _PATH_HOME . "_skins/"); }
if (!defined('_URL_SKINS'))  { define('_URL_SKINS',  _URL_HOME . "_skins/"); }
if (!defined('_PREF_TPL'))   { define('_PREF_TPL',   "default/"); }
if (!defined('_URL_USRIMG')) { define('_URL_USRIMG', _URL_SKINS . _PREF_TPL . "tplimgs/"); }
if (!defined('_URL_USRCSS')) { define('_URL_USRCSS', _URL_SKINS . _PREF_TPL . "tplcss/"); }
if (!defined('_URL_USRJS'))  { define('_URL_USRJS',  _URL_SKINS . _PREF_TPL . "tpljs/"); }

/* END * SET UP DEFAULT PATHS & URLs **************** */

function parseContents($text) {

  if ( stristr($text,'codesnippetstart') || stristr($text,'<pre name="code" class=') ) {
    $text .= '<link type="text/css" rel="stylesheet" href="{url_js}codesnippet/SyntaxHighlighter.css" /></link>';
    $text .= '<script language="javascript" src="{url_js}codesnippet/shCore.js"></script>';
    $text .= '<script language="javascript" src="{url_js}codesnippet/shBrushPhp.js"></script>';
    $text .= '<script language="javascript" src="{url_js}codesnippet/shBrushXml.js"></script>';
    $text .= '<script language="javascript">';
    $text .= 'dp.SyntaxHighlighter.ClipboardSwf = \'{url_js}codesnippet/clipboard.swf\';';
    $text .= 'dp.SyntaxHighlighter.HighlightAll(\'code\');';
    $text .= '</script>';
  }

  // do substitute of template image directory
  $text = str_replace('{tpl_img}', 'tplimgs/', $text);
  $text = str_replace('{url_img}', _URL_USRIMG, $text);

  // do substitute of template javascript directory
  $text = str_replace('{tpl_js}', 'tpljs/', $text);
  $text = str_replace('{url_js}', _URL_USRJS, $text);

  // do substitute of template CSS directory
  $text = str_replace('{tpl_css}', 'tplcss/', $text);
  $text = str_replace('{url_css}', _URL_USRCSS, $text);


  // return the swapped data
  return $text;
}

?>
