<?php 

function string_syntax_xhtml( $string, $return = false ) {
	$highlight = highlight_string( $string, true );
	$replace   = str_replace(
		array( '<font color="', '</font>' ),
		array( '<span style="color: ', '</span>' ),
		$highlight 
	);
	if( $return ) {
		return $replace;
	}
	echo $replace;
	return true;
}

function file_syntax_xhtml( $path, $return = false ) {
	return string_syntax_xhtml( file_get_contents( $path ), $return );
}
$fichier = $_GET['fichier'];
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"><html><head><title></title></head><body>';
string_syntax_xhtml( file_get_contents( $fichier ) );
echo '</body></html>';

?>