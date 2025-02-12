<?php
/**
 * Custom Post Types
 *
 * @package BadgeOS
 * @subpackage Admin
 * @author LearningTimes, LLC
 * @license http://www.gnu.org/licenses/agpl.txt GNU AGPL v3.0
 * @link https://credly.com
 */

/**
 * Register all of our BadgeOS CPTs
 *
 * @since  1.0.0
 * @return void
 */
function badgeos_register_post_types() {
	global $badgeos;

	// Register our achievement Types CPT
    $badgeos_settings = ( $exists = get_option( 'badgeos_settings' ) ) ? $exists : array();
    register_post_type( $badgeos_settings['achievement_main_post_type'], array(
        'labels'             => array(
			'name'               => __( 'Achievement Types', 'badgeos' ),
			'singular_name'      => __( 'Achievement Type', 'badgeos' ),
			'add_new'            => __( 'Add New', 'badgeos' ),
			'add_new_item'       => __( 'Add New Achievement Type', 'badgeos' ),
			'edit_item'          => __( 'Edit Achievement Type', 'badgeos' ),
			'new_item'           => __( 'New Achievement Type', 'badgeos' ),
			'all_items'          => __( 'Achievement Types', 'badgeos' ),
			'view_item'          => __( 'View Achievement Type', 'badgeos' ),
			'search_items'       => __( 'Search Achievement Types', 'badgeos' ),
			'not_found'          => __( 'No achievement types found', 'badgeos' ),
			'not_found_in_trash' => __( 'No achievement types found in Trash', 'badgeos' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Achievement Types', 'badgeos' )
		),
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => current_user_can( badgeos_get_manager_capability() ),
		'show_in_menu'       => 'badgeos_badgeos',
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),

	) );

	// Register our Step
    register_post_type( trim( $badgeos_settings['achievement_step_post_type'] ), array(
		'labels'             => array(
			'name'               => __( 'Steps', 'badgeos' ),
			'singular_name'      => __( 'Step', 'badgeos' ),
			'add_new'            => __( 'Add New', 'badgeos' ),
			'add_new_item'       => __( 'Add New Step', 'badgeos' ),
			'edit_item'          => __( 'Edit Step', 'badgeos' ),
			'new_item'           => __( 'New Step', 'badgeos' ),
			'all_items'          => __( 'Steps', 'badgeos' ),
			'view_item'          => __( 'View Step', 'badgeos' ),
			'search_items'       => __( 'Search Steps', 'badgeos' ),
			'not_found'          => __( 'No steps found', 'badgeos' ),
			'not_found_in_trash' => __( 'No steps found in Trash', 'badgeos' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Steps', 'badgeos' )
		),
		'public'             => apply_filters( 'badgeos_public_steps', false ),
		'publicly_queryable' => apply_filters( 'badgeos_public_steps', false ),
		'show_ui'            => current_user_can( badgeos_get_manager_capability() ),
		'show_in_menu'       => apply_filters( 'badgeos_public_steps', false ),
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => apply_filters( 'badgeos_public_steps', false ),
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title' ),

	) );
    badgeos_register_achievement_type( trim( $badgeos_settings['achievement_step_post_type'] ), 'steps' );

	// Register Log Entries CPT
	badgeos_register_log_post_type();

}
add_action( 'init', 'badgeos_register_post_types' );

/**
 * Register our various achievement types for use in the rules engine
 *
 * @param  string $achievement_name_singular The singular name
 * @param  string $achievement_name_plural  The plural name
 * @return void
 */
function badgeos_register_ranks_type( $slug, $achievement_name_singular = '', $achievement_name_plural = '' ) {

	$plural  = $achievement_name_plural;
	if( empty( $plural ) )
		$plural = $achievement_name_singular;

    $GLOBALS['badgeos']->ranks_types[$slug] = array(
        'single_name' => strtolower( $achievement_name_singular ),
        'plural_name' => strtolower( $plural ),
    );
}

/**
 * Register Log Entries CPT
 */
function badgeos_register_log_post_type() {

    // Register Log Entries CPT
    register_post_type( 'badgeos-log-entry', array(
        'labels'             => array(
            'name'               => __( 'Log Entries', 'badgeos' ),
            'singular_name'      => __( 'Log Entry', 'badgeos' ),
            'add_new'            => __( 'Add New', 'badgeos' ),
            'add_new_item'       => __( 'Add New Log Entry', 'badgeos' ),
            'edit_item'          => __( 'Edit Log Entry', 'badgeos' ),
            'new_item'           => __( 'New Log Entry', 'badgeos' ),
            'all_items'          => __( 'Log Entries', 'badgeos' ),
            'view_item'          => __( 'View Log Entries', 'badgeos' ),
            'search_items'       => __( 'Search Log Entries', 'badgeos' ),
            'not_found'          => __( 'No Log Entries found', 'badgeos' ),
            'not_found_in_trash' => __( 'No Log Entries found in Trash', 'badgeos' ),
            'parent_item_colon'  => '',
            'menu_name'          => __( 'Log Entries', 'badgeos' )
        ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => current_user_can( badgeos_get_manager_capability() ),
        'show_in_menu'       => 'badgeos_badgeos',
        'show_in_nav_menus'  => false,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'log' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'comments' ),
    ) );
}

/**
 * Register our various achievement types for use in the rules engine
 *
 * @since  1.0.0
 * @param  string $achievement_name_singular The singular name
 * @param  string $achievement_name_plural  The plural name
 * @return void
 */
function badgeos_register_achievement_type( $achievement_name_singular = '', $achievement_name_plural = '' ) {
	global $badgeos;
	$badgeos->achievement_types[sanitize_title( $achievement_name_singular )] = array(
		'single_name' => strtolower( $achievement_name_singular ),
		'plural_name' => strtolower( $achievement_name_plural ),
	);
}

/**
 * Register each of our achievement Types as CPTs
 *
 * @since  1.0.0
 * @return void
 */
function badgeos_register_achievement_type_cpt() {

    $badgeos_settings = ( $exists = get_option( 'badgeos_settings' ) ) ? $exists : array();
	// Grab all of our achievement type posts
	$achievement_types = get_posts( array(
		'post_type'      =>	$badgeos_settings['achievement_main_post_type'],
		'posts_per_page' =>	-1,
	) );

	// Loop through each achievement type post and register it as a CPT
	foreach ( $achievement_types as $achievement_type ) {

		// Grab our achievement name
		$achievement_name = $achievement_type->post_title;

		// Update our post meta to use the achievement name, if it's empty
		if ( $achievement_name != get_post_meta( $achievement_type->ID, '_badgeos_singular_name', true ) ) update_post_meta( $achievement_type->ID, '_badgeos_singular_name', $achievement_name );
		if ( ! get_post_meta( $achievement_type->ID, '_badgeos_plural_name', true ) ) update_post_meta( $achievement_type->ID, '_badgeos_plural_name', $achievement_name );

		// Setup our singular and plural versions to use the corresponding meta
		$achievement_name_singular = get_post_meta( $achievement_type->ID, '_badgeos_singular_name', true );
		$achievement_name_plural   = get_post_meta( $achievement_type->ID, '_badgeos_plural_name', true );

		// Determine whether this achievement type should be visible in the menu
		$show_in_menu = get_post_meta( $achievement_type->ID, '_badgeos_show_in_menu', true ) ? 'badgeos_badgeos' : false;

        //filter school admin menu badgeOS start
        if(class_exists("BadgeOS_Group_Management") && function_exists('badgeos_get_user_role')){
            $role = badgeos_get_user_role(get_current_user_id());
            if(!empty($role) && ($role =="school_admin" || $role =="author")){
                $show_in_menu=false;
            }
        }

		// Register the post type
		register_post_type( sanitize_title( substr( strtolower( $achievement_name_singular ), 0, 20 ) ), array(
			'labels'             => array(
				'name'               => $achievement_name_plural,
				'singular_name'      => $achievement_name_singular,
				'add_new'            => __( 'Add New', 'badgeos' ),
				'add_new_item'       => sprintf( __( 'Add New %s', 'badgeos' ), $achievement_name_singular ),
				'edit_item'          => sprintf( __( 'Edit %s', 'badgeos' ), $achievement_name_singular ),
				'new_item'           => sprintf( __( 'New %s', 'badgeos' ), $achievement_name_singular ),
				'all_items'          => $achievement_name_plural,
				'view_item'          => sprintf( __( 'View %s', 'badgeos' ), $achievement_name_singular ),
				'search_items'       => sprintf( __( 'Search %s', 'badgeos' ), $achievement_name_plural ),
				'not_found'          => sprintf( __( 'No %s found', 'badgeos' ), strtolower( $achievement_name_plural ) ),
				'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'badgeos' ), strtolower( $achievement_name_plural ) ),
				'parent_item_colon'  => '',
				'menu_name'          => $achievement_name_plural,
			),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => current_user_can( badgeos_get_manager_capability() ),
			'show_in_menu'       => $show_in_menu,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => sanitize_title( strtolower( $achievement_name_singular ) ) ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'page-attributes' )
		) );

		// Register the Achievement type
		badgeos_register_achievement_type( strtolower( $achievement_name_singular ), strtolower( $achievement_name_plural ) );

	}
}
add_action( 'init', 'badgeos_register_achievement_type_cpt', 8 );
