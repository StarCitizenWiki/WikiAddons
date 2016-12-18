<?php
class SCWiki_Addons {

	public static function BeforePageDisplay( OutputPage &$out, Skin &$skin )
	{
		$out->addModules('ext.scwiki_addons');
		$out->addModules('ext.scwiki_addons_mobile');
		$proto = 'http:';
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
			$proto = 'https:';
		}
		$script = '<script type="application/ld+json">{"@context": "http://schema.org","@type": "WebSite","url": "'.$proto.'//'.$_SERVER['HTTP_HOST'].'/","potentialAction": {"@type": "SearchAction","target":"'.$proto.'//'.$_SERVER['HTTP_HOST'].'/index.php?search={search_term_string}","query-input": "required name=search_term_string"}}</script>';
    	$out->addHeadItem("googlesearchmarkup script", $script);
		return true;
	}

	public static function runIntval( $parser, $inStr = '' ) {
		preg_replace('/[^a-zA-Z\s]+/', '', $inStr);
		return (int)$inStr;
	}

	public static function runStripTags( $parser, $inStr = '' ) {
		return strip_tags($inStr);
	}

	public static function runMod( $parser, $inStr = 0, $key = 0 ) {
		return (int)($inStr%$key);
	}

	public function romanToInt($parser, $numeralString)
	{
		$result = 0;
		$romans = array(
		    'M' => 1000,
		    'CM' => 900,
		    'D' => 500,
		    'CD' => 400,
		    'C' => 100,
		    'XC' => 90,
		    'L' => 50,
		    'XL' => 40,
		    'X' => 10,
		    'IX' => 9,
		    'V' => 5,
		    'IV' => 4,
		    'I' => 1,
		);
		foreach ($romans as $key => $value) {
    		while (strpos($numeralString, $key) === 0) {
        		$result += $value;
        		$numeralString = substr($numeralString, strlen($key));
    		}
		}
		return $result;
	}

	public function intToHex($parser, $int)
	{
		return dechex($int);
	}

	public static function number_format_Render( &$parser ) {
		// {{#number_format:number|decimals|dec_point|thousands_sep}}
		// Get the parameters that were passed to this function
		$params = func_get_args();
		array_shift( $params );
		$paramcount = count( $params );
		if ( isset( $params[0] ) && $params[0] == '' ) {
			return '';
		}
		switch ( $paramcount ) {
			case 5:
				// Since 'space' cannot be passed through parser functions, users are advised to use
				// the underscore instead. Converting back to space here.
				if ( $params[4] == '_' ) {
					$params[4] = ' ';
				}
				$params[0] = str_replace( $params[4], '.', $params[0] );
			case 4:
				if ( $params[3] == '_' ) {
					$params[3] = ' ';
				} //Converting back to space
			case 3:
				if ( $params[2] == '_' ) {
					$params[2] = ' ';
				} //Converting back to space
			case 2:
				if ( $params[1] == '_' ) {
					$params[1] = strrpos( $params[0], '.' ) ? strlen( $params[0] ) - strrpos( $params[0], '.' ) - 1 : 0;
				} //Number of decimal points same as input
			case 1:
				break;
			case 0:
				return ""; //Empty output for empty input
				break;
			default:
				return '<span class="error">' . wfMessage( 'numberformat_wrongnargs' )->escaped() . '</span>';
		}
		$params[0] = preg_replace( "/[^\\.\\-0-9e]*/", "", $params[0] ); //Set to plain number
		if ( !is_numeric( $params[0] ) ) {
			// return '<span class="error">' . wfMessage( 'numberformat_firstargument' )->escaped() . '</span>';
			return;
		}
		$output = number_format(
			$params[0],
			isset( $params[1] ) ? $params[1] : null,
			isset( $params[2] ) ? $params[2] : ',',
			isset( $params[3] ) ? $params[3] : '.'
		);
		if( isset( $params[3] ) ) {
			switch ( $params[3] ) {
				case 't':
					$output = str_replace( 't', '&thinsp;', $output );
					break;
				case 'n':
					$output = str_replace( 'n', '&nbsp;', $output );
					break;
			}
		}
		return $output;
	}
}
