<?php

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'SCWiki_Addons' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['SCWiki_Addons'] = __DIR__ . '/i18n';
	wfWarn(
		'Deprecated PHP entry point used for SCWiki_Addons extension. Please use wfLoadExtension ' .
		'instead, see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return true;
} else {
	die( 'This version of the SCWiki_Addons extension requires MediaWiki 1.25+' );
}
