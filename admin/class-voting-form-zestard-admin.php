<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://the-gujarati.free.nf
 * @since      1.0.0
 *
 * @package    Voting_Form_Zestard
 * @subpackage Voting_Form_Zestard/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Voting_Form_Zestard
 * @subpackage Voting_Form_Zestard/admin
 * @author     Parth Dodiya <parthdodiya.dodiya@gmail.com>
 */
class Voting_Form_Zestard_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Voting_Form_Zestard_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Voting_Form_Zestard_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/voting-form-zestard-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Voting_Form_Zestard_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Voting_Form_Zestard_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/voting-form-zestard-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function role_exists( $role ) {

		if( ! empty( $role ) ) {

			return $GLOBALS['wp_roles']->is_role( $role );
		
		}

		return false;

	}

	public function add_voter_role() {
		
		if ($this->role_exists( 'voter' ) == '') {
		
			add_role( 'voter', 'Voter', array() );
		
		}
	
	}

	public function create_settings_page() {

		$page_title = 'Users voted';
		$menu_title = 'Users Voted';
		$capability = 'manage_options';
		$slug 		= 'usersvoted';
		$callback = array( $this, 'settings_content_detail' );
		add_users_page($page_title, $menu_title, $capability, $slug, $callback);

	}

	public function settings_content_detail() {
	 	$voters_table = new Voters_List_Table();
	    $voters_table->prepare_items();

	    ?>
	    <div class="wrap">
	        <h1>Users Voted</h1>
	        <?php settings_errors(); ?>
	        <?php $voters_table->display(); ?>
	    </div>
	    <?php
	}

}


// Load necessary WordPress administration files
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

// Extend WP_List_Table to create a custom table for listing users
class Voters_List_Table extends WP_List_Table {
    
    // Constructor function
    public function __construct() {
        parent::__construct( array(
            'singular' => 'voter',   // Singular label for an individual item
            'plural'   => 'voters',  // Plural label for multiple items
            'ajax'     => false      // Disable AJAX features
        ) );
    }

    // Define columns to be displayed in the table
    public function get_columns() {
        return array(
        	'cb'         	=> '<input type="checkbox" />', // Checkbox column
            'user_id'    	=> 'ID',
            'member_id'    	=> 'MID',
            'user_login' 	=> 'Username',
            'user_email' 	=> 'Email',
            'user_voted_P1' => 'P1',
            'user_voted_P2' => 'P2',
            'user_voted_P3' => 'P3',
            'user_voted_P4' => 'P4'
        );
    }

    public function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="voter[]" value="%s" />',
            $item['user_id']
        );
    }

    public function get_sortable_columns() {
        return array(
            'user_id'    => array( 'user_id', true ),    // ID column: sortable
            'member_id'    => array( 'member_id', true ),    // MID column: sortable
        );
    }

    // Prepare user data for display
    public function prepare_items() {
    	$per_page = 10;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = array();

        $this->_column_headers = array( $columns, $hidden, $sortable );

        // Query users by role (e.g., 'voter')
        $voters = get_users( array(
            'role' => 'voter',  // Specify the role to query
            'number'  => $per_page,
            'offset'  => ( $this->get_pagenum() - 1 ) * $per_page // Pagination offset
        ) );

        $data = array();
        foreach ( $voters as $voter ) {
        	// echo "<pre>";
        	// print_r($voter);
        	// echo "</pre>";
        	// exit();
        	$user_meta = get_user_meta( $voter->ID );
        	$user_votes = json_decode($user_meta['user_voted'][0], true);

        	// echo "<pre>";
        	// print_r($user_meta);
        	// echo "</pre>";
        	// exit();
        	
            $data[] = array(
                'user_id'    => $voter->ID,
                'member_id'    => $user_meta['member_id'][0],
                'user_login' => $voter->user_login,
                'user_email' => $voter->user_email,
                'user_voted_P1' => ($user_votes['P1'] == '1') ? '✔' : '✘' ,
                'user_voted_P2' => ($user_votes['P2'] == '1') ? '✔' : '✘' ,
                'user_voted_P3' => ($user_votes['P3'] == '1') ? '✔' : '✘' ,
                'user_voted_P4' => ($user_votes['P4'] == '1') ? '✔' : '✘' 
            );
        }        

        $total_items = count($voters); // Total number of users with 'voter' role
        // $total_items = 2; // Total number of users with 'voter' role

        $this->items = $data;

        $this->set_pagination_args( array(
            'total_items' => count($voters),
            'per_page'    => $per_page,
            'total_pages' => ceil( count($voters) / $per_page )
        ) );
    }

    // Display default content for each column
    public function column_default( $item, $column_name ) {
        return isset( $item[ $column_name ] ) ? $item[ $column_name ] : '';
    }

    public function get_bulk_actions() {
        return array(
            'delete' => 'Delete'
        );
    }

    public function process_bulk_action() {
        if ( 'delete' === $this->current_action() ) {
            $voter_ids = isset( $_REQUEST['voter'] ) ? $_REQUEST['voter'] : array();
            foreach ( $voter_ids as $voter_id ) {
                // Delete user by ID
                wp_delete_user( $voter_id );
            }
        }
    }
}