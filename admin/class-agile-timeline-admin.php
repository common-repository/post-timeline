<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Agile_TIMELINE
 * @subpackage Agile_TIMELINE/admin
 * @author     AgileLogix <zubair@agilelogix.com>
 */
class Agile_TIMELINE_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;


			if ( !session_id() ) {
			    session_start();
			}

		//add_action('admin_notices', array(&$this,'my_admin_notice'));		
		//add_action('save_post', array(&$this,'validate_text_input'));
		//add_filter('ot_validate_setting', array(&$this,'validate_text_input'), 10, 3);

		add_filter('manage_edit-agile-timeline_columns',array(&$this,'timeline_columns'));
		add_action( 'manage_agile-timeline_posts_custom_column' , array(&$this,'timeline_column_details'), 10, 2 );

		
	}



	function validate_text_input($post_id) {
		global $errors;

		if($_POST['agile-timeline-post-date'] == '') {

			set_transient( 'agile-timeline-err', 'Please add Post Date for the Timeline', 30 );

			return false;
		}

	    return true;
	}


	function my_admin_notice() {

		if ( $error = get_transient( "agile-timeline-err" ) ) { ?>
		    <div class="error">
		        <p><?php echo $error; ?></p>
		    </div><?php

		    delete_transient("agile-timeline-err");
		}
		
	}

	/**
	 * Register Timeline custom post type
	 *
	 * @since    0.0.1
	 */
	public function register_agile_timeline() {


	    $labels = array(
	      'name'               => _x( 'Post Timelines', 'post type general name', 'agile-timeline' ),
	      'singular_name'      => _x( 'Post Timeline', 'post type singular name', 'agile-timeline' ),
	      'menu_name'          => _x( 'Post Timelines', 'admin menu', 'agile-timeline' ),
	      'name_admin_bar'     => _x( 'Post Timeline', 'add new on admin bar', 'agile-timeline' ),
	      'add_new'            => _x( 'Add New', 'timeline', 'agile-timeline' ),
	      'add_new_item'       => __( 'Add New Timeline', 'agile-timeline' ),
	      'new_item'           => __( 'New Timeline', 'agile-timeline' ),
	      'edit_item'          => __( 'Edit Timeline', 'agile-timeline' ),
	      'view_item'          => __( 'View Timeline', 'agile-timeline' ),
	      'all_items'          => __( 'All Timelines', 'agile-timeline' ),
	      'search_items'       => __( 'Search Timelines', 'agile-timeline' ),
	      'parent_item_colon'  => __( 'Parent Timelines:', 'agile-timeline' ),
	      'not_found'          => __( 'No timelines found.', 'agile-timeline' ),
	      'not_found_in_trash' => __( 'No timelines found in Trash.', 'agile-timeline' ),
	      "parent"  => __( 'Parent Timeline', 'agile-timeline' ),
	    );

	    $args = array(
	      'labels'            => $labels,
	      'public'            => true,
	      'publicly_queryable'=> true,
	      'show_ui'           => true,
	      'show_in_menu'      => true,
	      'query_var'         => true,
	      'rewrite'           => array( 'slug' => 'agile-timeline' ),
	      'capability_type'   => 'post',
	      'has_archive'       => true,
	      'hierarchical'      => true,
	      'menu_position'     => 5,
	      'menu_icon'         => 'dashicons-portfolio',
	      'supports'          => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes'),
	    );

	  	register_post_type( 'agile-timeline', $args );

	}

	/**
	 * Initialize the timeline settings meta box.
	 *
	 * @since    0.0.1
	 */
	function add_agile_timeline_meta_box() {

		$settings = get_option( 'agile_timeline_global_settings' );


	    $timeline_meta_box = array(
	      'id'        => 'agile_timeline_timeline_metabox',
	      'title'     => __( 'Timeline Details', 'agile-timeline' ),
	      'desc'      => '',
	      'pages'     => array( 'agile-timeline' ),
	      'context'   => 'normal',
	      'priority'  => 'high',
	      'fields'    => array(
	        array(

	        	'id'          => 'agile-timeline-post-date',
			    'label'       => __( 'Date Picker', 'agile-timeline' ),
			    'desc'        => __( 'Select the Date/Month/Year of Timeline', 'agile-timeline' ),
			    'type'        => 'date-picker',
			    'value'		  => '0'
	        ),
			array(
		        'id'          => 'agile-timeline-date-format',
		        'label'       => __( 'Date Format', 'agile-timeline' ),
		        'desc'        => __( 'Select the Date format to appear, if event day or month is unkown select year.', 'agile-timeline' ),
		        'type'        => 'select',
	          	'choices'     => array(
			        array(
			            'label'     => __( 'Full Date', 'agile-timeline' ),
			            'value'     => '0'
			        ),
		            array(
		              'label'     => __( 'Month Only', 'agile-timeline' ),
		              'value'     => '1'
		            ),
		            array(
		              'label'     => __( 'Year Only', 'agile-timeline' ),
		              'value'     => '2'
		            )
		        )
	        ),
	        array(
		        'id'          => 'agile-timeline-img-txt-pos',
		        'label'       => __( 'Position', 'agile-timeline' ),
		        'desc'        => __( 'Select the Position of Text and Image.', 'agile-timeline' ),
		        'type'        => 'select',
	          	'choices'     => array(
			        array(
			            'label'     => __( 'Image Top', 'agile-timeline' ),
			            'value'     => '0'
			        ),
		            array(
		              'label'     => __( 'Text Top', 'agile-timeline' ),
		              'value'     => '1'
		            )
		        )
	        ),
	        array(
		        'id'          => 'agile-timeline-image-overlay',
		        'label'       => __( 'Sub Heading or Caption', 'agile-timeline' ),
		        'desc'        => __( 'Sub Heading for Parent Post & Caption for Child Posts', 'agile-timeline' ),
		        'type'        => 'text',
	        ),
	       	array(
		        'id'          => 'agile-timeline-post-color',
		        'label'       => __( 'Post Color', 'agile-timeline' ),
		        'desc'        => __( 'Use When Creating Child Post.', 'agile-timeline' ),
		        'type'        => 'select',
	          	'choices'     => array(
			        array(
			            'label'     => __( 'Color 1', 'agile-timeline' ),
			            'value'     => '0'
			        ),
		            array(
			            'label'     => __( 'Color 2', 'agile-timeline' ),
			            'value'     => '1'
			        ),
			        array(
			            'label'     => __( 'Color 3', 'agile-timeline' ),
			            'value'     => '2'
			        ),
			        array(
			            'label'     => __( 'Color 4', 'agile-timeline' ),
			            'value'     => '3'
			        ),
			        array(
			            'label'     => __( 'Color 5', 'agile-timeline' ),
			            'value'     => '4'
			        ),
			        array(
			            'label'     => __( 'Color 6', 'agile-timeline' ),
			            'value'     => '5'
			        ),
			        array(
			            'label'     => __( 'Color 7', 'agile-timeline' ),
			            'value'     => '6'
			        )
		        )
	        ),
	      )
	    );

	    ot_register_meta_box( $timeline_meta_box );

	}

	function timeline_columns($gallery_columns) {
		

		return array(
				"cb"  			=>  '<input type="checkbox" />',
				"title"  		=>  _x('Timeline Title', 'agile-timeline'),
				"images"  		=>  __('Timeline Image'),
				"event_date"  	=>  __('Event Date'),
				"date"  		=>  _x('Published', 'agile-timeline'),
				"content"  		=>  _x('Timeline Content', 'agile-timeline')
			);
	}



	function timeline_column_details( $_column_name, $_post_id ) {
		

		switch ( $_column_name ) {
			
			case "event_date":

				
				$timeline_date = get_post_meta( $_post_id, 'agile-timeline-post-date', true );
				

				if($timeline_date ) {

					$timeline_date = date_format(date_create($timeline_date)," M - d - Y");
				}

				echo $timeline_date;
				
				break;

			case "images":

				$post_image_id = get_post_thumbnail_id(get_the_ID());
				
				if ($post_image_id) {
					
					$thumbnail = wp_get_attachment_image_src( $post_image_id, array(150,150), false);
					if ($thumbnail) (string)$thumbnail = $thumbnail[0];
					echo '<img src="'.$thumbnail.'" alt="" />';
				}
			  	break;

			case "content":
				echo  $content = get_the_excerpt();
				break;
		  }
	}

	/**
	 * Filter the required "title" field for list-item option types.
	 *
	 * @since    0.0.1
	 */
  	function filter_agile_list_item_title_label( $label, $id ) {

	    if ( $id == 'agile-timeline-timeline-yarns' ) {
	      $label = __( 'Yarn name', 'agile-timeline' );
	    }

	    if ( $id == 'agile-timeline-timeline-tools' ) {
	      $label = __( 'Size', 'agile-timeline' );
	    }

	    if ( $id == 'agile-timeline-timeline-notions' ) {
	      $label = __( 'Notion', 'agile-timeline' );
	    }

	    return $label;

  	}

	//TODO Next two functions are terribad

	/**
	 * Filter the OptionTree header logo link
	 *
	 * @since    0.0.1
	 */
  	function filter_header_logo_link() {

		$screen = get_current_screen();
		if( $screen->id == 'page_agile_timeline-settings' ) {
			return '';
		} else {
			return '<a href="http://wordpress.org/extend/post-timeline/" target="_blank">Post Timeline</a>';
		}

  	}

	/**
	 * Filter the OptionTree header version text
	 *
	 * @since    0.0.1
	 */
	function filter_header_version_text() {

		$screen = get_current_screen();
		if( $screen->id == 'page_agile_timeline-settings' ) {
			return '<a href="http://wordpress.org/plugins/post-timeline" target="_blank">' . $this->plugin_name . ' - v' . $this->version . '</a>';
		} else {
			return 'WOW Timeline 1.0.0';
		}

	}


	/**
	 * OptionTree options framework for generating plugin settings page & metaboxes.
	 *
	 * Only needs to load if no other theme/plugin already loaded it.
	 *
	 * @since 0.0.1
	 */
	function include_optiontree() {

		if ( ! class_exists( 'OT_Loader' ) ) {
    	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/option-tree/ot-loader.php';

			/* TODO - probably shouldn't be doing this here */
			add_filter( 'ot_show_pages', '__return_false' );
			add_filter( 'ot_use_theme_options', '__return_false' );
		}

	}

	/**
	 * Registers a new global timeline settings page.
	 *
	 * @since    0.0.1
	 */
	public function register_agile_timeline_settings_page() {

		// Only execute in admin & if OT is installed
	  	if ( is_admin() && function_exists( 'ot_register_settings' ) ) {


		    // Register the page
	    	ot_register_settings(
	        array(
	      		array(
	            'id'              => 'agile_timeline_global_settings',
	            'pages'           => array(
	              array(
		              'id'              => 'agile-timeline-settings',
		              'parent_slug'     => 'edit.php?post_type=agile-timeline',
		              'page_title'      => __( 'Agile Timeline - Global Settings', 'agile-timeline' ),
		              'menu_title'      => __( 'Settings', 'agile-timeline' ),
		              'capability'      => 'edit_theme_options',
		              'menu_slug'       => 'agile-timeline-settings',
		              'icon_url'        => null,
		              'position'        => null,
		              'updated_message' => __( 'Settings updated', 'agile-timeline' ),
		              'reset_message'   => __( 'Settings reset', 'agile-timeline' ),
		              'button_text'     => __( 'Save changes', 'agile-timeline' ),
		              'show_buttons'    => true,
		              'screen_icon'     => 'options-general',
		              'contextual_help' => null,
		              'sections'        => array(
		                array(
		                  'id'          => 'agile-timeline-general',
		                  'title'       => __( 'General', 'agile-timeline' ),
		                )
		              ),
	                'settings'        => array(
		            		array(
		            			'id'          => 'agile-timeline-link-color',
							    'label'       => __( 'Title Color', 'agile-timeline' ),
							    'desc'        =>  __( 'Set Title Color of Timeline.', 'agile-timeline' ),
							    'std'         => '' ,
							    'type'        => 'colorpicker',
							    'section'     => 'agile-timeline-general',
		            		),
		            		array(
		            			'id'          => 'agile-timeline-bg-color',
							    'label'       => __( 'Title Backgrounc Color', 'agile-timeline' ),
							    'desc'        =>  __( 'Set Background Color of Title.', 'agile-timeline' ),
							    'std'         => '' ,
							    'type'        => 'colorpicker',
							    'section'     => 'agile-timeline-general',
		            		),
							array(
								'id'        => 'agile-timeline-custom-css',
								'label'     => __( 'Custom CSS', 'agile-timeline' ),
								'desc'      => __( 'Add your css for the timeline colors', 'agile-timeline' ),
								'type'      => 'css',
								'section'   => 'agile-timeline-general',
							)
	                )
	              )
	            )
	          )
	        
	        ));

		}

	}

}
