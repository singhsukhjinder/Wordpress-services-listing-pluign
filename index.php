<?php
	/**
	 * @package Services
	 *
	 *
	 * Plugin Name: Services
	 * Plugin URI: singh.sukhjinder40atgmail.com
	 * Description: Provide custom post type services and shortcodes to show the services in the website.
	 * Version: 1.0
	 * Author: Sukhjinder singh
	 * Author URI: singh.sukhjinder40atgmail.com
	 * License: GPLv2 or later
	 * Text Domain: service
	*/

	//Registring post type and its options
	function services_init() {
		$labels = array(
			'name'                  => _x( 'Services', 'Post type general name', 'service' ),
			'singular_name'         => _x( 'Service', 'Post type singular name', 'service' ),
			'menu_name'             => _x( 'Services', 'Admin Menu text', 'service' ),
			'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'service' ),
			'add_new'               => __( 'Add New', 'service' ),
			'add_new_item'          => __( 'Add New service', 'service' ),
			'new_item'              => __( 'New service', 'service' ),
			'edit_item'             => __( 'Edit service', 'service' ),
			'view_item'             => __( 'View service', 'service' ),
			'all_items'             => __( 'All services', 'service' ),
			'search_items'          => __( 'Search service', 'service' ),
			'parent_item_colon'     => __( 'Parent service:', 'service' ),
			'not_found'             => __( 'No services found.', 'service' ),
			'not_found_in_trash'    => __( 'No services found in Trash.', 'service' ),
		   /* 'featured_image'        => _x( 'Service Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'service' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'service' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'service' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'service' ),*/
			'archives'              => _x( 'Service archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'service' ),
			'insert_into_item'      => _x( 'Insert into service', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'service' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this service', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'service' ),
			'filter_items_list'     => _x( 'Filter services list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'service' ),
			'items_list_navigation' => _x( 'Services list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'service' ),
			'items_list'            => _x( 'Services list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'service' ),
		);     
		$args = array(
			'labels'             => $labels,
			'description'        => 'Service custom post type.',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'service' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'blocks' ),
			'taxonomies'         => array( 'category', 'post_tag' ),
			'show_in_rest'       => true
		);
		  
		register_post_type( 'Service', $args );
	}
	add_action( 'init', 'services_init' );

	//Adding submenu pages links
	function services_submenu_page() {

		//Adding Shortcodes Sub Menu   
		add_submenu_page('edit.php?post_type=service', 'shortcodes', 'Shortcodes', "manage_options", 'shortcodes', 'shortcodes_information', '');

		//Adding Need Help Sub Menu
		add_submenu_page('edit.php?post_type=service', 'Need Help', 'Need Help', "manage_options", 'need_help', 'help_page', '');
		
		//Adding Need Help Sub Menu
		add_submenu_page('edit.php?post_type=service', 'Settings', 'Settings', "manage_options", 'settings', 'plugin_settings', '');
		
	}
	add_action('admin_menu', 'services_submenu_page');


	//Shortcode information page function
	function shortcodes_information(){
		include('shortcode-informatiom.php');
		return;
	}

	//help page function
	function help_page(){
		include('help.php');
	return;
	}

	//Shortcode information page function
	function plugin_settings(){
		include('plugin-settings.php');
		return;
	}

	//Loading pluign scripts and stylesheet
	function services_scripts() {
		wp_register_style( 'services-style', plugin_dir_url(__FILE__). '/assets/css/style.css', array(), '1.0.0', 'all' );
		wp_enqueue_style('services-style');
		wp_register_style( 'services-dynamic-style', plugin_dir_url(__FILE__). '/assets/css/dynamic-css.php', array(), '1.0.0', 'all' );
		wp_enqueue_style('services-dynamic-style');
		//wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
	}
	add_action( 'wp_enqueue_scripts', 'services_scripts' );

	//registering plugin settings
	function register_options(){
		register_setting( 'general', 'services_settings' ); 
	}
	add_action('admin_init', 'register_options');

	//Services shortcode function
	function services_display($atts){
		$atts = shortcode_atts(
			array(
				'category' => '',
				'numberofpost' => '-1',
				'displaytype' => 'grid',
			),$atts, 'services' 
		);
		//echo 'atts'. $atts['displaytype'];
		$args = array(  
			'post_type' => 'service',
			'post_status' => 'publish',
			'posts_per_page' => $atts['numberofpost'], 
			'orderby' => 'title', 
			'order' => 'ASC',
			'cat' => $atts['category'],
		);
		$query1 = new WP_Query( $args );
		$data = $atts['displaytype'] == 'list' ? '<div class="srv-list">' : '<div class="srv-grid">';
		while ( $query1->have_posts() ) {
			$query1->the_post();
			$postid = get_the_id();
			if($atts['displaytype'] == 'grid') {
				$data .=  '<div class="srv-grid-item"> 
					<div class="left">
						<a href="'.get_permalink().'">'.get_the_post_thumbnail($postid, $size = 'medium').'</a>
					</div>
					<div class="right">
						<a href="'.get_permalink().'">
							<h3 class="srv-title">'. get_the_title() . '</h3>
						</a>
						<p class="srv-descrp">'.wp_trim_words(get_the_content(), 10).'</p>
						<div class="srv-redmore-dv">
							<a href="'.get_permalink().'" class="srv-readmore">Read More</a>
						</div>
					</div>
				</div>';
			}
			else{
				$data .=  '<div class="srv-list-item"> 
					<div class="left">
						<a href="'.get_permalink().'">'.get_the_post_thumbnail($postid, $size = 'medium').'</a>
					</div>
					<div class="right">
						<a href="'.get_permalink().'">
							<h3 class="srv-title">'. get_the_title() . '</h3>
						</a>
						<p class="srv-descrp">'.wp_trim_words(get_the_content(), 10).'</p>
						<div class="srv-redmore-dv">
							<a href="'.get_permalink().'" class="srv-readmore">Read More</a>
						</div>
					</div>
				</div>';
			}
		}
		$data .= '</div>';
		return $data;

	}
	add_shortcode('services','services_display');

	//Registering the services archive template.
	class PageTemplater {

		/**
		 * A reference to an instance of this class.
		 */
		private static $instance;

		/**
		 * The array of templates that this plugin tracks.
		 */
		protected $templates;

		/**
		 * Returns an instance of this class. 
		 */
		public static function get_instance() {

			if ( null == self::$instance ) {
				self::$instance = new PageTemplater();
			} 

			return self::$instance;

		} 

		/**
		 * Initializes the plugin by setting filters and administration functions.
		 */
		private function __construct() {

			$this->templates = array();


			// Add a filter to the attributes metabox to inject template into the cache.
			if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {

				// 4.6 and older
				add_filter(
					'page_attributes_dropdown_pages_args',
					array( $this, 'register_project_templates' )
				);

			} else {

				// Add a filter to the wp 4.7 version attributes metabox
				add_filter(
					'theme_page_templates', array( $this, 'add_new_template' )
				);

			}

			// Add a filter to the save post to inject out template into the page cache
			add_filter(
				'wp_insert_post_data', 
				array( $this, 'register_project_templates' ) 
			);


			// Add a filter to the template include to determine if the page has our 
			// template assigned and return it's path
			add_filter(
				'template_include', 
				array( $this, 'view_project_template') 
			);


			// Add your templates to this array.
			$this->templates = array(
				'archive-services.php' => 'Services Template',
			);
				
		} 

		/**
		 * Adds our template to the page dropdown for v4.7+
		 *
		 */
		public function add_new_template( $posts_templates ) {
			$posts_templates = array_merge( $posts_templates, $this->templates );
			return $posts_templates;
		}

		/**
		 * Adds our template to the pages cache in order to trick WordPress
		 * into thinking the template file exists where it doens't really exist.
		 */
		public function register_project_templates( $atts ) {

			// Create the key used for the themes cache
			$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

			// Retrieve the cache list. 
			// If it doesn't exist, or it's empty prepare an array
			$templates = wp_get_theme()->get_page_templates();
			if ( empty( $templates ) ) {
				$templates = array();
			} 

			// New cache, therefore remove the old one
			wp_cache_delete( $cache_key , 'themes');

			// Now add our template to the list of templates by merging our templates
			// with the existing templates array from the cache.
			$templates = array_merge( $templates, $this->templates );

			// Add the modified cache to allow WordPress to pick it up for listing
			// available templates
			wp_cache_add( $cache_key, $templates, 'themes', 1800 );

			return $atts;

		} 

		/**
		 * Checks if the template is assigned to the page
		 */
		public function view_project_template( $template ) {
			
			// Get global post
			global $post;

			// Return template if post is empty
			if ( ! $post ) {
				return $template;
			}

			// Return default template if we don't have a custom one defined
			if ( ! isset( $this->templates[get_post_meta( 
				$post->ID, '_wp_page_template', true 
			)] ) ) {
				return $template;
			} 

			$file = plugin_dir_path( __FILE__ ). get_post_meta( 
				$post->ID, '_wp_page_template', true
			);

			// Just to be safe, we check if the file exist first
			if ( file_exists( $file ) ) {
				return $file;
			} else {
				echo $file;
			}

			// Return template
			return $template;

		}

	} 
	add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );