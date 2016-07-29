<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.nyros.com
 * @since      1.0.0
 *
 * @package    Twitter_User_Timeline
 * @subpackage Twitter_User_Timeline/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Twitter_User_Timeline
 * @subpackage Twitter_User_Timeline/includes
 * @author     Veera Prasad <veeraprasad_nyros@yahoo.com>
 */
class Twitter_User_Timeline {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Twitter_User_Timeline_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'twitter-user-timeline';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Twitter_User_Timeline_Loader. Orchestrates the hooks of the plugin.
	 * - Twitter_User_Timeline_i18n. Defines internationalization functionality.
	 * - Twitter_User_Timeline_Admin. Defines all hooks for the admin area.
	 * - Twitter_User_Timeline_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-twitter-user-timeline-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-twitter-user-timeline-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-twitter-user-timeline-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-twitter-user-timeline-public.php';

		$this->loader = new Twitter_User_Timeline_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Twitter_User_Timeline_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Twitter_User_Timeline_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Twitter_User_Timeline_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Twitter_User_Timeline_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Twitter_User_Timeline_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}


 //adding more feature inside the shortcode_atts
	 add_shortcode('twitts', 'twitter_shortcode_func');
	 add_shortcode('twitters', 'twitter_shortcode_func');
	 function twitter_shortcode_func($attrs,$content=null,$tag){
		//print_r($tag."<br>");

		$attrs = shortcode_atts(array(
				"username"=>"veeraprasad1989",
				"content" => !empty($content)? $content : ((!isset($attrs['username']) || empty($attrs['username']))? "Follow Me on Twitter" : "Follow ".$attrs['username']." on Twitter"),
				"show_tweets"=> false,
				"tweet_reset_time"=>10,
				"num_tweets"=>2

			),$attrs);

		extract($attrs);
		
		if($show_tweets){
			$tweets=fetch_tweets($username,$num_tweets,$tweet_reset_time);
		}
		return $tweets.'<a href="https://twitter.com/'.$username.'" >'.$content.'</a>';
	 }
	//screen_names  veeraprasad1989, venkatesh_9918
	
	require_once plugin_dir_path( __FILE__ ).'TwitterAPIExchange.php';
	
	function fetch_tweets($username,$num_tweets,$tweet_reset_time){

		// global $id;
		// $recent_tweets = get_post_meta($id,'cvp_recent_tweets');

		// reset_data($recent_tweets,$tweet_reset_time);

		//if no cache, fetch new tweets and cache.
		
		$settings = array(
	 		'oauth_access_token' => "3183767978-d0lD318Tm49C83MMmwJiokSXA7TtNxGOnuk53t2",
    		'oauth_access_token_secret' => "uz0E9jQL7ToybBSpxiPcKDXt0ntmmUTgfX347VcJm8QVJ",
    		'consumer_key' => "Z8zxvvRWMCxCMMr9XOybclge6",
    		'consumer_secret' => "P8M6MLXEis4juVB8YQJQhKsHkYWwAGhEtoObYS3jkAPMVMq4OP");

	 	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

	 	$requestMethod ='GET';

	 	$getfield = '?screen_name='.$username.'&count=20';

	 	$twitter = new TwitterAPIExchange($settings);

	 	$tweets = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc = TRUE);
	 	

	 	//echo $tweets[0]['text']."<br>";
	 	//echo $tweets[1]['text']."<br>";
	 	//echo count($tweets)."<br>";

	 	//echo '<pre>';
	 	//	print_r($tweets);
	 	//echo '</pre>';
	 	$data = array();
	 	$twits_count = count($tweets);
	 	if($twits_count > $num_tweets){
	 		$twits_count = $num_tweets;
	 	}
	 	for($i=0; $i < $twits_count; $i++){
	 		//echo $i."<br>";
	 	 	//echo $tweets[$i]['text']."<br>";
	 	 	$recent_tweets = '';
	 	 	if($num_tweets !== 0){
	 	 		//$data[$i] =  $tweets[$i]['text'];
	 	 		
	 	 		$recent_tweets .= "<div><p><img src='".$tweets[$i]['user']['profile_image_url']."'>";
	 	 		$recent_tweets .= "<span class='tw_head'>".$tweets[$i]['user']['name']."</span>&nbsp;&nbsp;";
	 	 		$recent_tweets .= "<span class='tw_scr'>@".$tweets[$i]['user']['screen_name']."</span></p></div>";
	 	 		$recent_tweets .= "<div class='tw_body'><span class='tw_msg'>".$tweets[$i]['text']."</span>";
	 	 		$recent_tweets .= " twitted at <span class='tw_time'>".$tweets[$i]['user']['created_at']."</span></div>";
	 	 	
	 	 		$data[] = $recent_tweets;
	 	 	}
	 	}

	 	//print_r($data);
	 	$recent_tweets = array();
	 	$recent_tweets[] = (int)date('i', time());
	 	$recent_tweets[] = '<div class="cvp_tweets">'.implode('</div><div class="cvp_tweets">',$data).'</div>';
	 	
	 	//global $id
	 	//$recent_tweets = get_post_meta($id,'cvp_recent_tweets');
	 	//delete_post_meta($id, 'cvp_recent_tweets');
	 	//print_r($recent_tweets);
	 	cache($recent_tweets);
	
	 	return $recent_tweets[1];
	 	
	 }

	function cache($recent_tweets){
		//[0] = current minute
		//[1] = tweet html fragment
		global $id;
		//add_post_meta($id, 'cvp_recent_tweets',$recent_tweets);
	}

	add_action('admin_menu', 'mt_add_pages');
	function mt_add_pages() {
	    // Add a new submenu under Settings:
	    add_options_page(__('TwitterShortcode','menu-test'), __('TwitterShortcode','menu-test'), 'manage_options', 'TwitterShortcode_slug', 'mt_settings_page');
	}

	// mt_settings_page() displays the page content for the Test Settings submenu
	function mt_settings_page() {

	    //must check that the user has the required capability 
	    if (!current_user_can('manage_options'))
	    {
	      wp_die( __('You do not have sufficient permissions to access this page.') );
	    }

	    // variables for the field and option names 
	    $opt_name = 'mt_favorite_name';
	    $hidden_field_name = 'mt_submit_hidden';
	    $data_field_name = 'mt_favorite_name';

	    // Read in existing option value from database
	    $opt_val = get_option( $opt_name );

	    // See if the user has posted us some information
	    // If they did, this hidden field will be set to 'Y'
	    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	        // Read their posted value
	        $opt_val = $_POST[ $data_field_name ];

	        // Save the posted value in the database
	        update_option( $opt_name, $opt_val );

	        // Put a "settings saved" message on the screen

	?>
	<div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
	<?php

	    }

	    // Now display the settings editing screen

	    echo '<div class="wrap">';

	    // header

	    echo "<h2>" . __( 'Shortcode Generator', 'menu-test' ) . "</h2>";

	    // settings form
	    
	    ?>

	<form name="form1" method="post" action="">
	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

	<p><?php _e("Twitter Screen Name", 'menu-test' ); ?> 
	<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
	</p><hr />

	<p class="submit">
	<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
	</p>

	</form>
	</div>
	Use the Following shortcode:<br> <br>
	<label>[twitts username='<?php echo $opt_val; ?>' show_tweets='true'][/twitts]</label>
	<br><br>
	<div>
		To display the twitter time line of your required user. Enter the screen name of twitter. Click on the Save Changes button. It generates the shortcode. Simple copy the code. And place the  bottom of the pages.<br><br>
		Example: screen names veeraprasad1989, venkatesh9918, etc.<br>
		If you are not set the any screen name. Plugin takes the default screen name is veeraprasad1989. <br><br>
		The default shortcode may be  [twitts show_tweets='true'][/twitts] or [twitts username='' show_tweets='true'][/twitts] .
	</div>
	<?php
		if ( defined( 'JETPACK_CLIENT__HTTPS' ) ) { 
	     
	    // grab the value 
	    $value = constant( 'JETPACK_CLIENT__HTTPS' ); 
	                 
	    if ( !empty( $value ) ) { 
	        // go forth and prosper...
	        echo $value; 
	    } 
	    else{
	    	echo 'empty';
	    }
		} 

		   
	}
