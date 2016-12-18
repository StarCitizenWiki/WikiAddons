<?php
class SCWiki_AddonsHooks {

	public static function onParserFirstCallInit( Parser &$parser )
	{
		$parser->setFunctionHook( 'intval', 'SCWiki_Addons::runIntval');
		$parser->setFunctionHook( 'number_format', 'SCWiki_Addons::number_format_Render' );
		$parser->setFunctionHook( 'strip_tags', 'SCWiki_Addons::runStripTags' );
		$parser->setFunctionHook( 'roman2int', 'SCWiki_Addons::romanToInt' );
		$parser->setFunctionHook( 'mod', 'SCWiki_Addons::runMod' );
		$parser->setFunctionHook( 'int2hex', 'SCWiki_Addons::intToHex' );
		return true;
	}

}
