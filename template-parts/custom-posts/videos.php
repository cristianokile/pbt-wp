<?php
function criar_custom_post_videos(){

	$args_videos_post_type = array(
		'labels' => array('name' => 'Videos', 'all_items' => __( 'Todos os Vídeos', 'sorrix' ), 'register_post_type' => __( 'Categorias', 'sorrix' )),
		'menu_icon' => 'dashicons-video-alt3',
		'public' => true,
		'supports' => array('title','editor','excerpt','thumbnail','comments'),
		'register_meta_box_cb' => 'videos_meta_box'  );

	register_post_type( 'videos' , $args_videos_post_type );
}
add_action( 'init' , 'criar_custom_post_videos');

// METABOXES

function videos_meta_box(){
	// Add
	add_meta_box( 'campos_videos', __('URL do Vídeo'), 'campos_videos', 'videos', 'normal', 'high' );
	// Remove
	// remove_meta_box( 'pageparentdiv', 'videos', 'side' );
	// remove_meta_box( 'commentstatusdiv','videos', 'normal' );
	// remove_meta_box( 'postexcerpt', 'videos', 'normal' );
	// remove_meta_box( 'commentsdiv', 'videos', 'normal' );
	// remove_meta_box( 'wpseo_meta', 'videos', 'normal' );
	// remove_meta_box( 'linktargetdiv', 'link', 'normal' );
	// remove_meta_box( 'linkxfndiv', 'link', 'normal' );
	// remove_meta_box( 'linkadvanceddiv', 'link', 'normal' );
	// remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
	// remove_meta_box( 'postcustom', 'post', 'normal' );
	// remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
	// remove_meta_box( 'commentsdiv', 'post', 'normal' );
	// remove_meta_box( 'revisionsdiv', 'post', 'normal' );
	// remove_meta_box( 'authordiv', 'post', 'normal' );
	// remove_meta_box( 'sqpt-meta-tags', 'post', 'normal' );
}

function campos_videos(){
	global $post;
	$video_url = get_post_meta( $post->ID, 'video_url', true );?>
	<br>
	<label for="video_url">Horário: </label><br>
	<input type="text" name="video_url" id="video_url" value="<?php echo $video_url; ?>">
	<br>
	<?php
}

function salvar_campos_video(){
	global $post;
	update_post_meta( $post->ID, 'video_url', $_POST['video_url'] );
}
add_action( 'save_post' , 'salvar_campos_video' );

