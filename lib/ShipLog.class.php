<?php

BLShipLog::get_instance();
class BLShipLog {

	/**
	 * Name of the CPT
	 *
	 * @var string
	 **/
	private $mPostType = 'blshiplog';

	/**
	 * Holds instance of this class
	 *
	 * @var BLShipLog
	 **/
	private static $instance = null;

	/**
	 * Default constructor - Singleton
	 **/
	private function __construct() {
		// Register the post type
		add_action( 'init', array( $this, 'registerPostType' ) );

		// Add meta box
		add_action( 'cmb2_init', array( $this, 'cmb2_init' ) );
	}

	/**
	 * Gets the single instance of this class
	 *
	 * @return BLShipLog
	 **/
	public static function get_instance() {
		if( is_null( self::$instance ) ) {
			self::$instance = new BLShipLog();
		}
		return self::$instance;
	}

	/**
	 * Registers a new post type with WordPress
	 **/
	public function registerPostType() {
		global $blship;
		$labels = array(
            'name' => 'Ship Log',
            'singular_name' => 'Ship Log',
            'add_new' => 'New Log Entry ',
            'add_new_item' => 'New Log Entry',
            'edit_item' => 'Edit Log Entry',
            'new_item' => 'New Log Entry',
            'view_item' => 'View Log Entry',
            'search_items' => 'Search Logs',
            'not_found' => 'No Logs found',
            'not_found_in_trash' => 'No Logs found in trash'
        );
        
        $args = array(
            'public' => true,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'labels' => $labels,
            'hierarchical' => false,
            'has_archive' => true,
            'query_var' => 'shiplog',
            'rewrite' => array( 'slug' => 'ship-log', 'with_front' => false ),
            'menu_icon' => SHIPS_LOG_PLUGIN_URL . 'images/ship-icons/aosicon112.png',
            'register_meta_box_cb' => array( &$blship, 'registerLogMetabox' )
            
        );
        
        register_post_type( $this->mPostType, $args );

	}

	/**
	 * Creates the metabox for the ship log via cmb2
	 **/
	public function cmb2_init() {
		$cmb = new_cmb2_box( array(
			'id'			=> 'ship-log',
			'title'			=> __( 'Log Details', 'blshiplog' ),
			'object_types'	=> array( $this->mPostType ),
			'context'		=> 'normal',
			'priority'		=> 'high',
			'show_names'	=> true,
		) );

		// Ship

		// Trip Purpose

		$cmb->add_field( array(
			'name'			=> __( 'Skipper', 'blshiplog' ),
			'id'			=> 'Skipper',
			'type'			=> 'text',
		) );

		// Crew

		// Guests

		// Departure Time

		// Estimate arrival time

		// Actual arrival time

		$cmb->add_field( array(
			'name'			=> __( 'Route', 'blshiplog' ),
			'id'			=> 'Route',
			'type'			=> 'textarea',
		) );

		$cmb->add_field( array(
			'name'			=> __( 'Distance Traveled', 'blshiplog' ),
			'id'			=> 'DistanceTraveled',
			'type'			=> 'text',
		) );

		$cmb->add_field( array(
			'name'			=> __ ( 'Weather Forecast', 'blshiplog' ),
			'id'			=> 'WeatherForecast',
			'type'			=> 'text',
		) );

		$cmb->add_field( array(
			'name'			=> __( 'Weather Observed', 'blshiplog' ),
			'id'			=> 'WeatherObserved',
			'type'			=> 'text',
		) );

		$cmb->add_field( array(
			'name'			=> __( 'Food Consumed', 'blshiplog' ),
			'id'			=> 'FoodConsumed',
			'type'			=> 'text',
		) );

		// People met

		$cmb->add_field( array(
			'name'			=> __( 'Average Motor RPMs', 'blshiplog' ),
			'id'			=> 'AverageMotorRpms',
			'type'			=> 'text',
		) );

		$cmb->add_field( array(
			'name'			=> __( 'Fuel Intake', 'blshiplog' ),
			'id'			=> 'FuelIntake',
			'type'			=> 'text',
		) );

		$cmb->add_field( array(
			'name'			=> __( 'Fuel Used', 'blshiplog' ),
			'id'			=> 'FuelUsed',
			'type'			=> 'text',
		) );

		$cmb->add_field( array(
			'name'			=> __( 'Water Intake', 'blshiplog' ),
			'id'			=> 'WaterIntake',
			'type'			=> 'text',
		) );

		$cmb->add_field( array(
			'name'			=> __( 'Water Used', 'blshiplog' ),
			'id'			=> 'WaterUsed',
			'type'			=> 'text'
		) );
	}
} // end class