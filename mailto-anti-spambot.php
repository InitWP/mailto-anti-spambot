<?php
/**
 * Hide/obfuscate email adresses from Spam Bots using a shortcode
 * Example: [email]info@email.com[/email] or [email mailto="info@email.com"]Send us a message[/email]
 *
 * @param array  $atts    Shortcode attributes.
 * @param string $content The shortcode content. Should be an email address.
 *
 * @return string The obfuscated email address.
 */
function NAMESPACE_hide_email_shortcode( $atts , $content = null ) {

	$a = shortcode_atts( array(
		'mailto' => $content,
        'class' => '',
    ), $atts );

	if ( !is_email( $content ) && !is_email( $a['mailto'] )) {
		return;
	}

	if ($a['class']) {
		$class = 'class="' . $a['class'] . '"';
	} else {
		$class = '';
	}

	return '<a href="mailto:' . antispambot( $a['mailto'] ) . '" ' . $class . '>' . antispambot( $content ) . '</a>';
}
add_shortcode( 'email', 'NAMESPACE_hide_email_shortcode' );
