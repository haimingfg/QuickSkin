<?php

require_once('inc.config.php');

$file_contents = "";
if ($_GET['pg'] == '') {
  $file_contents = '_pgs/index.htm';
  $useTemplate   = 'index.html';
  $title         = 'Codeworx Technologies';
  $h1title       = 'QuickSkin (formerly SmartTemplate)';
} elseif ($_GET['pg'] == 'index') {
  $file_contents = '_pgs/index.htm';
  $useTemplate   = 'index.html';
  $title         = 'Codeworx Technologies: Sample Page definition';
  $h1title       = 'Codeworx Technologies: Sample Page definition';
}

include_once(_PATH_HOME . '_lib/class.quickskin.php');

$page = new QuickSkin ( 'default/' . $useTemplate );

$contents = $page->getContents('',$file_contents);
$contents = parseContents($contents); // used to facilitate creation of templates with FrontPage, etc.

//$page->set('cache_lifetime', 1);

$page->assign( 'title',      $title );
$page->assign( 'contents',   $contents );
$page->assign( 'h1title' ,   $h1title );

// do substitute of template image directory
$page->assign('tpl_img',     'tplimgs/');
$page->assign('url_img',     _URL_USRIMG);

// do substitute of template javascript directory
$page->assign('tpl_js',      'tpljs/');
$page->assign('url_js',      _URL_USRJS);

// do substitute of template CSS directory
$page->assign('tpl_css',     'tplcss/');
$page->assign('url_css',     _URL_USRCSS);

$page->output();
// $page->debug();

ob_end_flush();

?>
