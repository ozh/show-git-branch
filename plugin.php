<?php
/*
Plugin Name: Show Git Branch
Plugin URI: https://github.com/ozh/show-git-branch
Description: Show Git branch in footer
Version: 1.0
Author: Ozh
Author URI: http://ozh.org/
*/

yourls_add_filter( 'html_footer_text', 'ozh_show_git_branch' );

// Add Git branch to footer
function ozh_show_git_branch( $text ) {
	if( $branch = ozh_get_git_branch() ) {
		$text .= ' <span style="color:red;">&ndash; Git branch: <strong>' . $branch . '</strong></span>';
	}
	return $text;
}

// Get Git branch
function ozh_get_git_branch() {
	if( file_exists( YOURLS_ABSPATH . '/.git/HEAD' ) ) {
		$head = trim( file_get_contents( YOURLS_ABSPATH . '/.git/HEAD' ) );
		$head = explode( '/', $head );
		return( array_pop( $head ) );
	} else {
		return '';
	}
}