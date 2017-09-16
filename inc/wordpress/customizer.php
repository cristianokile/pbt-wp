<?php
/**
 * Piece Blank Theme: Customizer
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pbt_wp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'pbt_wp_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'pbt_wp_customize_partial_blogdescription',
	) );

	/**
	 * Cores Customizadas
	 */
	$wp_customize->add_setting( 'colorscheme', array(
		'default'           => 'light',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'pbt_wp_sanitize_colorscheme',
	) );

	$wp_customize->add_setting( 'colorscheme_hue', array(
		'default'           => 250,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint', // The hue is stored as a positive integer.
	) );

	$wp_customize->add_control( 'colorscheme', array(
		'type'    => 'radio',
		'label'    => __( 'Color Scheme', 'pbt_wp' ),
		'choices'  => array(
			'light'  => __( 'Light', 'pbt_wp' ),
			'dark'   => __( 'Dark', 'pbt_wp' ),
			'custom' => __( 'Custom', 'pbt_wp' ),
		),
		'section'  => 'colors',
		'priority' => 5,
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colorscheme_hue', array(
		'mode' => 'hue',
		'section'  => 'colors',
		'priority' => 6,
	) ) );

	/**
	 * Theme options.
	 * Opções do Tema
	 */
	$wp_customize->add_section( 'theme_options', array(
		'title'    => __( 'Theme Options', 'pbt_wp' ),
		'priority' => 130, // Before Additional CSS.
	) );

	$wp_customize->add_setting( 'page_layout', array(
		'default'           => 'two-column',
		'sanitize_callback' => 'pbt_wp_sanitize_page_layout',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'page_layout', array(
		'label'       => __( 'Page Layout', 'pbt_wp' ),
		'section'     => 'theme_options',
		'type'        => 'radio',
		'description' => __( 'When the two-column layout is assigned, the page title is in one column and content is in the other.', 'pbt_wp' ),
		'choices'     => array(
			'one-column' => __( 'One Column', 'pbt_wp' ),
			'two-column' => __( 'Two Column', 'pbt_wp' ),
		),
		'active_callback' => 'pbt_wp_is_view_with_layout_option',
	) );

	/**
	 * Filtra o número de seções da Front-Page em Piece Blank Theme
	 *
	 * @since Piece Blank Theme 1.0
	 *
	 * @param int $num_sections número de seções da front page.
	 */
	$num_sections = apply_filters( 'pbt_wp_front_page_sections', 4 );

	// Crie uma configuração e controle para cada uma das seções disponíveis no tema.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* traduções: %d é o número de seções da front page */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'pbt_wp' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'pbt_wp' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'pbt_wp_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'pbt_wp_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'pbt_wp_customize_register' );

/**
 * Desinfecte as opções de layout da página.
 *
 * @param string $input Layout da Página.
 */
function pbt_wp_sanitize_page_layout( $input ) {
	$valid = array(
		'one-column' => __( 'One Column', 'pbt_wp' ),
		'two-column' => __( 'Two Column', 'pbt_wp' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/**
 * Desinfecte os esquemas de cores.
 *
 * @param string $input Esquema de Cor.
 */
function pbt_wp_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light';
}

/**
 * Renderize o título do site para a atualização seletiva parcial.
 *
 * @since Piece Blank Theme 1.0
 * @see pbt_wp_customize_register()
 *
 * @return void
 */
function pbt_wp_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Renderize o slogan do site para a atualização seletiva parcial.
 *
 * @since Piece Blank Theme 1.0
 * @see pbt_wp_customize_register()
 *
 * @return void
 */
function pbt_wp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Retorne se estamos antecipando a página inicial e é uma página estática.
 */
function pbt_wp_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Retorne se estamos em uma visão que suporte um layout de uma ou duas colunas.
 */
function pbt_wp_is_view_with_layout_option() {
	// Esta opção está disponível em todas as páginas. Também está disponível em arquivos quando não há uma barra lateral.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Encaminhe os manipuladores JS para instantaneamente ao vivo - antecipe mudanças.
 */
function pbt_wp_customize_preview_js() {
	wp_enqueue_script( 'pbt_wp-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'pbt_wp_customize_preview_js' );

/**
 * Carregue a lógica dinâmica para a área de controles do personalizador.
 */
function pbt_wp_panels_js() {
	wp_enqueue_script( 'pbt_wp-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'pbt_wp_panels_js' );
