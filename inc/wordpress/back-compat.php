<?php
/**
 * Piece Blank Theme - Volta funcionalidades de Compatibilidade
 *
 * Impede que Piece Blank Theme seja executado em versões do WordPress anteriores a 4.7, uma vez que este tema
 * não deve ser compatível com versões anteriores além disso e depende de muitas funções mais recentes e 
 * alterações de marcação introduzidas no 4.7.
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0

  */

/**
 * Evita mudar para Piece Blank Theme em versões antigas do WordPress.
 *
 * Muda para o tema padrão.
 *
 * @since Piece Blank Theme 1.0
 */
function pbt_wp_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'pbt_wp_upgrade_notice' );
}
add_action( 'after_switch_theme', 'pbt_wp_switch_theme' );

/**
 * Adiciona uma mensagem de mudança de tema sem êxito.
 *
 * Imprime uma mensagem de atualização após uma tentativa mal sucedida de mudar para
 * o Piece Blank Theme nas versões do WordPress antes de 4.7.
 *
 * @since Piece Blank Theme 1.0
 *
 * @global string $wp_version Versão do WordPress.
 */
function pbt_wp_upgrade_notice() {
	$message = sprintf( __( 'Piece Blank Theme requer ao menos o WordPress 4.7. A sua versão atual é %s. Por atualize e tente novamente.', 'pbt_wp' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
  * Evita que o editor do tema seja carregado nas versões anteriores ao WordPress 4.7
 *
 * @since Piece Blank Theme 1.0
 *
 * @global string $wp_version Versão do WordPress
 */
function pbt_wp_customize() {
	wp_die( sprintf( __( 'Piece Blank Theme requer ao menos o WordPress 4.7. A sua versão atual é %s. Por atualize e tente novamente.', 'pbt_wp' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'pbt_wp_customize' );

/**
 * Evita que uma prévia do tema seja carregada em versões anteriores ao WordPress 4.7
 *
 * @since Piece Blank Theme 1.0
 *
 * @global string $wp_version Versão do WordPress.
 */
function pbt_wp_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Piece Blank Theme requer ao menos o WordPress 4.7. A sua versão atual é %s. Por atualize e tente novamente..', 'pbt_wp' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'pbt_wp_preview' );
