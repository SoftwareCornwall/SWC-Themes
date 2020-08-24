<?php
/**
  ReduxFramework SkatDesign Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('SD_Redux_Framework_config')) {

    class SD_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
			
			add_action('redux/page/sd_data/enqueue', array( $this, 'sd_redux_styles' ) ) ;
			

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }
        /**
          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.
         * */
        function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
            
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/custom-styles' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }    
        }
		
		public function sd_redux_styles() {
			wp_register_style( 'sd-redux-styles', get_template_directory_uri() . '/admin/sd-admin-options/sd-redux-styles.css', array( 'redux-css' ), '', 'all' );
			wp_enqueue_style( 'sd-redux-styles' );
		}
		
        /**
          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'sd-framework'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'sd-framework'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );
            return $sections;
        }

        /**
          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;
            return $args;
        }

        /**
          Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {
            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // SD assets location
			$sd_assets_url  = ReduxFramework::$_url . '../sd-assets/';

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'sd-framework'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'sd-framework'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'sd-framework'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'sd-framework') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'sd-framework'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

			//Default RSS URL
			$sd_default_feed = get_bloginfo('rss2_url');
			
			//Customize course fields names
			$sd_all_data = get_option('sd_data');

            // ACTUAL DECLARATION OF SECTIONS	
			$this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => __('General', 'sd-framework'),
                'fields'    => array(
                    
					array(
							'id'		=> 'sd_favicon_upload',
							'url'		=> false,
							'type'		=> 'media', 
							'title'		=> __( 'Custom Favicon', 'sd-framework' ),
							'subtitle'	=> __( 'Upload your custom site favicon.', 'sd-framework' ),
							'default'	=> array( 'url'	=> get_template_directory_uri() .'/framework/images/favicon.ico' )
							
					),
					array(
                            'id'       => 'sd_sidebar_location',
                            'type'     => 'image_select',
                            'title'    => __( 'Sidebar Location', 'sd-framework' ),
                            'subtitle' => __( 'Select the location of the sidebar.', 'sd-framework' ),
                            'options'  => array(
                                '1' => array(
                                    'alt' => 'Right',
                                    'img' => $sd_assets_url . 'img/2cr.png'
                                ),
                                '2' => array(
                                    'alt' => 'Left',
                                    'img' => $sd_assets_url . 'img/2cl.png'
                                ),
                            ),
                            'default'  => '1'
                        ),
					array(
                            'id'       => 'sd_pagination_type',
                            'type'     => 'image_select',
                            'title'    => __( 'Pagination Type', 'sd-framework' ),
                            'subtitle' => __( 'Select the type of pagination.', 'sd-framework' ),
							'desc' => __( 'Pagination appears on blog, course, event pages and also on their archive pages.', 'sd-framework' ),
                            'options'  => array(
                                '1' => array(
                                    'alt' => 'Default WordPress Pagination',
                                    'img' => $sd_assets_url . 'img/sd-pagination-default.png'
                                ),
                                '2' => array(
                                    'alt' => 'Page Numbers',
                                    'img' => $sd_assets_url . 'img/sd-pagination-numbers.png'
                                ),
                            ),
                            'default'  => '2'
                        ),
					array(
                            'id'       => 'sd_blog_next',
                            'type'     => 'text',
                            'title'    => __( 'Next Posts', 'sd-framework' ),
                            'subtitle' => __( 'Next posts button text.', 'sd-framework' ),
                            'default'  => 'Next Posts',
							'required'  => array('sd_pagination_type', "=", 1)
                        ),
					array(
                            'id'       => 'sd_blog_prev',
                            'type'     => 'text',
                            'title'    => __( 'Previous Posts', 'sd-framework' ),
                            'subtitle' => __( 'Previous posts button text.', 'sd-framework' ),
                            'default'  => 'Previous Posts',
							'required'  => array('sd_pagination_type', "=", 1)
                        )
					,
				)
			);
           
			$this->sections[] = array(
                'title'     => __('Header', 'sd-framework'),
                'desc'      => '',
                'icon'      => 'el-icon-minus',
                'fields'    => array(
				
					array(
                        'id'            => 'sd_header_height',
                        'type'          => 'dimensions',
                        'title'         => __('Header Height', 'sd-framework'),
                        'subtitle'      => __('Adjust the height of the header.', 'sd-framework'),
                        'desc'          => __('Default: 135px', 'sd-framework'),
						'units'    		=> array('px'),
						'compiler' 		=> array('#sd-header'),
						'width'			=> false,
                    ),
					array(
                    	    'id'        => 'sd_sticky_header',
                        	'type'      => 'switch',
	                        'title'     => __('Sticky Header', 'sd-framework'),
    	                    'subtitle'  => __('Enable or disable the stycky header. Menu and logo will be sticky when user scrolls down.', 'sd-framework'),
							'on'        => __('Enabled', 'sd-framework'),
	                        'off'       => __('Disabled', 'sd-framework'),
							'default'      => false
        	            ),
					array(
                    	    'id'        => 'sd_top_bar',
                        	'type'      => 'switch',
	                        'title'     => __('Top Bar', 'sd-framework'),
    	                    'subtitle'  => __('Enable or disable the top header bar.', 'sd-framework'),
							'on'        => __('Enabled', 'sd-framework'),
	                        'off'       => __('Disabled', 'sd-framework'),
							'default'      => true
        	            ),
					array(
                    	    'id'        => 'sd_top_bar_left',
                        	'type'      => 'switch',
	                        'title'     => __('Top Bar Left Fields', 'sd-framework'),
    	                    'subtitle'  => __('Enable or disable the top bar left fields.', 'sd-framework'),
							'on'        => __('Enabled', 'sd-framework'),
	                        'off'       => __('Disabled', 'sd-framework'),
							'required'  => array('sd_top_bar', "=", 1),
							'default'      => true
        	            ),
						array(
						    'id'       => 'sd_top_bar_first_field_icon',
						    'type'     => 'select',
						    'select2'  => array( 'containerCssClass' => 'fa' ),
						    'title'    => __('Top Bar First Field Icon', 'sd-framework'),
						    'subtitle' => __('Select an icon for the top bar first field.', 'sd-framework'),
							'desc' => __('Select none to hide the icon.', 'sd-framework'),
						    'class'    => ' font-icons fa',
							'default'    => 'fa fa-phone',
						    'options'  => sd_font_awesome_icons(),
							'required'  => array('sd_top_bar_left', "=", 1)
						),	
                    	array(
                        	'id'        => 'sd_top_bar_first_field',
	                        'type'      => 'text',
    	                    'title'     => __('Top Bar First Field', 'sd-framework'),
        	                'subtitle'  => __('Insert a short content for the top bar first field.', 'sd-framework'),
							'desc'      => __(' Leave blank if you don\'t want to display it.', 'sd-framework'),
                	        'default'   => 'Call us: 1-800-123-4567',
							'required'  => array('sd_top_bar_left', "=", 1)
	                    ),
						array(
						    'id'       => 'sd_top_bar_second_field_icon',
						    'type'     => 'select',
						    'select2'  => array( 'containerCssClass' => 'fa' ),
						    'title'    => __('Top Bar Second Field Icon', 'sd-framework'),
						    'subtitle' => __('Select an icon for the top bar second field.', 'sd-framework'),
							'desc' => __('Select none to hide the icon.', 'sd-framework'),
						    'class'    => ' font-icons fa',
							'default'    => 'fa fa-envelope-o',
						    'options'  => sd_font_awesome_icons(),
							'required'  => array('sd_top_bar_left', "=", 1)
						),	
						array(
        	                'id'        => 'sd_top_bar_second_field',
            	            'type'      => 'text',
                	        'title'     => __('Top Bar Second Field', 'sd-framework'),
                    	    'subtitle'  => __('Insert a short content for the top bar second field.', 'sd-framework'),
							'desc'      => __(' Leave blank if you don\'t want to display it.', 'sd-framework'),
	                        'default'   => 'john@doe.com',
							'required'  => array('sd_top_bar_left', "=", 1)
        	            ),
						array(
                	        'id'        => 'sd_top_news',
                    	    'type'      => 'text',
                        	'title'     => __('Top Header Short News', 'sd-framework'),
	                        'subtitle'  => __('Insert a short desc of your news.', 'sd-framework'),
							'desc'      => __(' Leave blank if you don\'t want to display it.', 'sd-framework'),
        	                'default'   => 'Admission open for 2014 batch',
							'required'  => array('sd_top_bar_left', "=", 1)
                	    ),
						array(
                	        'id'        => 'sd_top_news_word',
                    	    'type'      => 'text',
                        	'title'     => __('Rename the "News" word', 'sd-framework'),
	                        'subtitle'  => __('Insert a custom word instead of "News".', 'sd-framework'),
        	                'default'   => 'News',
							'required'  => array('sd_top_bar_left', "=", 1)
                	    )
				),
            );
			
			$this->sections[] = array(
                'icon'      => 'el-icon-podcast',
                'title'     => __('Social Icons', 'sd-framework'),
                'subsection' => true,
                'fields'    => array(
				
					array(
                    	    'id'        => 'sd_social_icons',
                        	'type'      => 'switch',
	                        'title'     => __('Header Social Icons', 'sd-framework'),
    	                    'subtitle'  => __('Enable or disable the header social icons.', 'sd-framework'),
							'default'        => 1,
							'on'        => __('Enabled', 'sd-framework'),
	                        'off'       => __('Disabled', 'sd-framework')
        	        ),
					array(
						    'id'       => 'sd_social_icons_data',
						    'type'     => 'sortable',
						    'title'    => __('Header Social Icons', 'sd-framework'),
						    'subtitle' => __('Define and reorder the social icons however you want.', 'sd-framework'),
						    'desc'     => __('Leave any field blank if you don\'t want to display it .', 'sd-framework'),
							'label'		=> true,
							'options' => array(
								'facebook' => 'https://facebook.com/skatdesign',
								'twitter' => 'http://twitter.com/skatdesign',
								'linkedin' => 'https://www.linkedin.com/in/skatdesign',
								'google-plus' => 'http://google.com/+skatdesign',
								'youtube-play' => 'http://youtube.com/zabestof',
								'vimeo-square' => '',
								'pinterest' => 'http://www.pinterest.com/skatdesign/',
								'instagram' => '',
								'flickr' => '',
								'rss' => $sd_default_feed
							),
							'default' => array(
								'facebook' => 'https://facebook.com/skatdesign',
								'twitter' => 'http://twitter.com/skatdesign',
								'linkedin' => 'https://www.linkedin.com/in/skatdesign',
								'google-plus' => 'http://google.com/+skatdesign',
								'youtube-play' => 'http://youtube.com/zabestof',
								'vimeo-square' => '',
								'pinterest' => 'http://www.pinterest.com/skatdesign/',
								'instagram' => '',
								'flickr' => '',
								'rss' => $sd_default_feed
							),
							'required'  => array('sd_social_icons', "=", 1)
					)
				)
            );
			
			$this->sections[] = array(
                'icon'      => 'el-icon-star-alt',
                'title'     => __('Logo', 'sd-framework'),
                'subsection' => true,
                'fields'    => array(
				
					array(
                        'id'        => 'sd_logo_upload',
                        'type'      => 'media',
                        'url'       => false,
                        'title'     => __('Custom Logo', 'sd-framework'),
                        'desc'      => __('Upload your custom logo image.', 'sd-framework'),
                        'subtitle'  => '',
						'default'  	=> array(
      						  'url'	=> get_template_directory_uri() . '/framework/images/my-university-logo.png'
						)
                    ),
					array(
                        'id'            => 'sd_logo_margin_top',
                        'type'          => 'spacing',
                        'title'         => __('Logo Top Margin', 'sd-framework'),
                        'subtitle'      => __('Adjust the top margin of the logo.', 'sd-framework'),
                        'desc'          => __('Default: 22px', 'sd-framework'),
						'compiler'		=> array('.sd-logo'),
						'top'			=> true,
						'right'			=> false,
						'bottom'		=> false,
						'left'			=> false,
						'mode'			=> 'margin',
						'units'    		=> array('px')
                    ),
				)
			);
			
			
			$this->sections[] = array(
                'title'     => __('Blog', 'sd-framework'),
                'desc'      => '',
                'icon'      => 'el-icon-pencil',
                'fields'    => array(
				
					array(
                        'id'       => 'sd_blog_layout',
                        'type'     => 'select',
                        'title'    => __( 'Blog Layout', 'sd-framework' ),
                        'subtitle' => __( 'Select the layout for the blog pages.', 'sd-framework' ),
						'desc' => __( 'This includes blog page, single posts, archive pages, category pages, tags and search results pages.', 'sd-framework' ),
                        'options'  => array(
                        	'1' => 'With Sidebar',
                            '2' => 'Full Width'
                         ),
                        'default'  => '1'
                    ),
					array(
                        'id'        => 'sd_blog_featured_img',
                        'type'      => 'switch',
                        'title'     => __('Featured Image', 'sd-framework'),
                        'subtitle'  => __('Enable or disable the featured image for blog posts.', 'sd-framework'),
                        'default'   => true,
						'on'        => __('Enabled', 'sd-framework'),
                        'off'       => __('Disabled', 'sd-framework')
                    ),
					array(
                        'id'        => 'sd_blog_post_meta_enable',
                        'type'      => 'switch',
                        'title'     => __('Blog Post Meta', 'sd-framework'),
                        'subtitle'  => __('Enable or disable the blog post meta.', 'sd-framework'),
                        'default'   => true,
						'on'        => __('Enabled', 'sd-framework'),
                        'off'       => __('Disabled', 'sd-framework')
                    ),
					array(
                            'id'       => 'sd_blog_post_meta',
                            'type'     => 'checkbox',
                            'title'    => __( 'Blog Post Meta Options', 'sd-framework' ),
                            'subtitle' => __( 'Select what info do you want to display for the blog meta.', 'sd-framework' ),
							'desc' => __( 'This info appears right under the post title.', 'sd-framework' ),
                            'options'  => array(
                                '1' => 'Post date',
                                '2' => 'Post author',
                                '3' => 'Categories',
								'4' => 'Tags',
								'5' => 'Number of comments'
                            ),
                            'default'  => array(
                                '1' => '1',
                                '2' => '1',
                                '3' => '1',
								'4' => '1',
								'5' => '1'
                            ),
							'required'  => array('sd_blog_post_meta_enable', "=", 1)
                        ),
					array(
                        'id'        => 'sd_blog_comments',
                        'type'      => 'switch',
                        'title'     => __('Blog Comments', 'sd-framework'),
                        'subtitle'  => __('Enable or disable the comments on the blog posts.', 'sd-framework'),
						'desc'  => __('While enabled this option can be overrided by the option in the WordPress editor.', 'sd-framework'),
                        'default'   => true,
						'on'        => __('Enabled', 'sd-framework'),
                        'off'       => __('Disabled', 'sd-framework')
                    ),
					array(
                        	'id'        => 'sd_blog_single_prev_next',
	                        'type'      => 'switch',
    	                    'title'     => __('Next/Previous Post Links', 'sd-framework'),
        	                'subtitle'  => __('Enable or disable the next/previous links at the bottom of the single post.', 'sd-framework'),
            	            'default'   => true,
							'on'        => __('Enabled', 'sd-framework'),
                    	    'off'       => __('Disabled', 'sd-framework')
                    	),
					array(
                            'id'       => 'sd_blog_single_next',
                            'type'     => 'text',
                            'title'    => __( 'Next Post', 'sd-framework' ),
                            'subtitle' => __( 'Next post button text.', 'sd-framework' ),
                            'default'  => 'Next Post',
							'required'  => array('sd_blog_single_prev_next', "=", 1)
                        ),
					array(
                            'id'       => 'sd_blog_single_prev',
                            'type'     => 'text',
                            'title'    => __( 'Previous Post', 'sd-framework' ),
                            'subtitle' => __( 'Previous post button text.', 'sd-framework' ),
                            'default'  => 'Previous Post',
							'required'  => array('sd_blog_single_prev_next', "=", 1)
                        ),
				),
            );
			
			$this->sections[] = array(
                'title'     => __('Footer', 'sd-framework'),
                'desc'      => '',
                'icon'      => 'el-icon-download-alt',
                'fields'    => array(
				
					array(
                        'id'        => 'sd_widgetized_footer',
                        'type'      => 'switch',
                        'title'     => __('Widgetized Footer', 'sd-framework'),
                        'subtitle'  => __('Enable or disable the footer widgets section.', 'sd-framework'),
                        'default'   => true,
						'on'        => __('Enabled', 'sd-framework'),
                        'off'       => __('Disabled', 'sd-framework')
                    ),
					array(
                        'id'        => 'sd_copyright',
                        'type'      => 'switch',
                        'title'     => __('Copyright Box', 'sd-framework'),
                        'subtitle'  => __('Enable or disable the footer copyright section.', 'sd-framework'),
                        'default'   => true,
						'on'        => __('Enabled', 'sd-framework'),
                        'off'       => __('Disabled', 'sd-framework')
                    ),
					array(
                        'id'        => 'sd_copyright_text',
                        'type'      => 'editor',
                        'title'     => __('Custom Copyright Text', 'sd-framework'),
                        'subtitle'  => __('Insert your custom copyright text.', 'sd-framework'),
						'args'   	=> array(
							'media_buttons' => false
					    ),
						'required'  => array('sd_copyright', "=", 1)
                    ),
				)
			);
			
			$this->sections[] = array(
                'icon'      => 'el-icon-envelope',
                'title'     => __('Newsletter', 'sd-framework'),
                'subsection' => true,
                'fields'    => array(
				
					array(
                        'id'        => 'sd_newsletter_display',
                        'type'      => 'button_set',
                        'title'     => __('Display Newsletter Box', 'sd_framework'),
                        'subtitle'  => __('Slelect how to display the footer newsletter box', 'sd-framework'),
                        
                        'options'   => array(
                            '1' => __('Disabled', 'sd-framework'),
                            '2' => __('Homepage', 'sd-framework'),
                            '3' => __('Sitewide', 'sd-framework')
                        ), 
                        'default'   => '3'
                    ),
					array(
                	        'id'        => 'sd_newsletter_word',
                    	    'type'      => 'text',
                        	'title'     => __('Rename the "Newsletter" word', 'sd-framework'),
	                        'subtitle'  => __('Insert a custom word instead of "Newsletter".', 'sd-framework'),
        	                'default'   => 'Newsletter',
							'required'  => array('sd_newsletter_display', "=", array('2', '3'))
                	),
					array(
                	        'id'        => 'sd_subscribe_word',
                    	    'type'      => 'text',
                        	'title'     => __('Rename the "Subscribe" word', 'sd-framework'),
	                        'subtitle'  => __('Insert a custom word instead of "Subscribe".', 'sd-framework'),
        	                'default'   => 'Subscribe',
							'required'  => array('sd_newsletter_display', "=", array('2', '3'))
                	),
					array(
                        'id'        => 'sd_newsletter_code',
                        'type'      => 'ace_editor',
                        'title'     => __('Newsletter Form Code', 'sd-framework'),
                        'subtitle'  => __('Insert the code of your newsletter form.', 'sd-framework'),
                        'desc'      => __('(MailChimp code naked)', 'sd-framework'),
						'mode'     => 'html',
                        'theme'    => 'chrome',
						'options'  => array( 'minLines'=> 30 ),
						'default'  => '<!-- Begin MailChimp Signup Form -->

<div id="mc_embed_signup">
	<form action="//skat.us7.list-manage.com/subscribe/post?u=5ef55abee027ce066bca8313c&amp;id=46cd16464a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
		<div class="mc-field-group">
			<label for="mce-EMAIL">Email Address </label>
			<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
		</div>
		<div id="mce-responses" class="clear">
			<div class="response" id="mce-error-response" style="display:none"></div>
			<div class="response" id="mce-success-response" style="display:none"></div>
		</div>
		<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
		<div style="position: absolute; left: -5000px;">
			<input type="text" name="b_5ef55abee027ce066bca8313c_46cd16464a" tabindex="-1" value="">
		</div>
		<div class="clear">
			<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
		</div>
	</form>
</div>
<!--End mc_embed_signup-->',
						'required'  => array('sd_newsletter_display', "=", array('2', '3'))
                    ),
				)
            );
			
			$this->sections[] = array(
                'icon'      => 'el-icon-twitter',
                'title'     => __('Twitter Box', 'sd-framework'),
                'subsection' => true,
                'fields'    => array(
					
					array(
                        'id'        => 'sd_twitter_box',
                        'type'      => 'switch',
                        'title'     => __('Twitter Box', 'sd-framework'),
                        'subtitle'  => __('Enable or disable the footer Twitter box.', 'sd-framework'),
                        'default'   => false,
						'on'        => __('Enabled', 'sd-framework'),
                        'off'       => __('Disabled', 'sd-framework')
                    ),
					array(
                            'id'     => 'sd_twitter_app_info',
                            'type'   => 'info',
                            'notice' => true,
							'icon'   => 'el-icon-info-sign',
                            'style'  => 'info',
                            'title'  => '<a href="http://dev.twitter.com/apps" target="_blank">' . __( 'Learn more about creating a Twitter APP', 'sd-framweork' ) . '</a>',
							'required'  => array('sd_twitter_box', "=", 1)
                        ),
					array(
                            'id'       => 'sd_twitter_username',
                            'type'     => 'text',
                            'title'    => __( 'Twitter Username', 'sd-framework' ),
                            'subtitle' => __( 'Insert your Twitter username.', 'sd-framework' ),
							'required'  => array('sd_twitter_box', "=", 1)
                        ),
					array(
                            'id'       => 'sd_consumer_key',
                            'type'     => 'text',
                            'title'    => __( 'Consumer Key', 'sd-framework' ),
                            'subtitle' => __( 'Insert your Twitter app. consumer key.', 'sd-framework' ),
							'required'  => array('sd_twitter_box', "=", 1)
                        ),
					array(
                            'id'       => 'sd_consumer_secret',
                            'type'     => 'text',
                            'title'    => __( 'Consumer Secret', 'sd-framework' ),
                            'subtitle' => __( 'Insert your Twitter app. consumer secret.', 'sd-framework' ),
							'required'  => array('sd_twitter_box', "=", 1)
                        ),
					array(
                            'id'       => 'sd_access_token',
                            'type'     => 'text',
                            'title'    => __( 'Access Token', 'sd-framework' ),
                            'subtitle' => __( 'Insert your Twitter app. access token.', 'sd-framework' ),
							'required'  => array('sd_twitter_box', "=", 1)
                        ),
					array(
                            'id'       => 'sd_access_token_secret',
                            'type'     => 'text',
                            'title'    => __( 'Access Token Secret', 'sd-framework' ),
                            'subtitle' => __( 'Insert your Twitter app. access token secret.', 'sd-framework' ),
							'required'  => array('sd_twitter_box', "=", 1)
                        ),
				)
            );
			
			$this->sections[] = array(
                'title'     => __('Typography', 'sd-framework'),
                'desc'      => '',
                'icon'      => 'el-icon-font',
                'fields'    => array(
				
					array(
                            'id'       		=> 'sd_body_typography',
                            'type'     		=> 'typography',
                            'title'    		=> __( 'Body', 'sd-framework' ),
                            'subtitle' 		=> __( 'Specify the body font properties.', 'sd-framework' ),
                            'google'   		=> true,
							'font-backup'	=> true,
							'font-style' 	=> false,
							'font-weight'	=> false,
							'text-align'	=> false,
							'text-align'	=> false,
							'compiler'		=> array('body')
                        ),
					array(
                            'id'       		=> 'sd_headings',
                            'type'     		=> 'typography',
                            'title'    		=> __( 'Headings', 'sd-framework' ),
                            'subtitle' 		=> __( 'Specify the headings font properties.', 'sd-framework' ),
							'desc' 		=> __( '(h1, h2, h3, h4, h5, h6 headings)', 'sd-framework' ),
                            'google'   		=> true,
							'font-backup'	=> true,
							'font-style' 	=> false,
							'text-align'	=> false,
							'font-size'   	=> false,
							'line-height' 	=> false,
							'font-weight'	=> true,
							'compiler'		=> array('h1', 'h2', 'h3', 'h4', 'h5', 'h6')
                        ),
					array(
                            'id'       		=> 'sd_menu_typography',
                            'type'     		=> 'typography',
                            'title'    		=> __( 'Menu', 'sd-framework' ),
                            'subtitle' 		=> __( 'Specify the menu font properties.', 'sd-framework' ),
                            'google'   		=> true,
							'font-backup'	=> true,
							'font-style' 	=> false,
							'text-align'	=> false,
							'line-height' 	=> false,
							'font-weight'	=> false,
							'color'			=> false,
							'compiler'		=> array('.sf-menu a')
                        ),
					array(
                            'id'       		=> 'sd_page_title_typography',
                            'type'     		=> 'typography',
                            'title'    		=> __( 'Page Titles', 'sd-framework' ),
                            'subtitle' 		=> __( 'Specify the page titles font properties.', 'sd-framework' ),
                            'google'   		=> true,
							'font-backup'	=> true,
							'font-style' 	=> false,
							'text-align'	=> false,
							'font-weight'	=> true,
							'compiler'		=> array('.sd-page-top h2')
                        ),
				)
			);
			
			$this->sections[] = array(
                'title'     => __('Styling', 'sd-framework'),
                'desc'      => '',
                'icon'      => 'el-icon-brush',
                'fields'    => array(
				
					array(
						'id'					=> 'sd_theme_overall',
						'type'					=> 'color',
						'title'					=> __( 'Theme\'s Main Color', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the main color of the theme.', 'sd-framework' ),
						'desc'					=> __( 'Default is #0191c6', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array(
														'color' => 'a:hover, .sd-colored, .sd-latest-blog-short .more-link, .sd-list-style li:before, .sd-events-shortcode .sd-event-date, .sd-events-page .sd-event-date, .sd-learn-more, .sd-subscribe-text, .sd-icon-tabs .sd-tab-titles .ui-tabs-selected a, .sd-icon-tabs .sd-tab-titles .ui-tabs-active a, .sd-tab-titles .ui-tabs-selected a, .sd-tab-titles .ui-tabs-active a, .sd-entry-meta i, .sd-current-page, .wpcf7-submit, .sd-professor-discipline, .wpb_accordion_section .ui-accordion-header-active a, .ui-accordion-header-active span:before, .sd-testimonials h4, .sd-responsive-menu-close i, #sd-submit-comments:hover, .sd-entry-meta a:hover, body .wpb_toggle_title_active:before',
														'border-color' => '.sd-icon-tabs .sd-tab-titles .ui-tabs-selected a,.sd-icon-tabs .sd-tab-titles .ui-tabs-active a, .sd-icon-tabs .sd-tab-titles .ui-tabs-selected a .sd-icon-span, .sd-icon-tabs .sd-tab-titles .ui-tabs-active a .sd-icon-span, .more-link, .sd-learn-more, .sd-footer-sidebar-widget .wpcf7-submit, .sd-current-page, .sd-inactive, .sd-next-page, .sd-previous-page, .sd-last-page, .sd-first-page, .sd-nav-previous a, .sd-nav-next a, .wpcf7-submit, .sd-read-more, blockquote, .sd-prev-post a, .sd-next-post a, #sd-submit-comments, .wpb_toggle',
														'background-color' => '.sd-entry-gallery .flexslider:hover .flex-next, .sd-entry-gallery .flexslider:hover .flex-prev, .sidr ul li:hover > a, .sidr ul li:hover > span, .sidr ul li.active > a, .sidr ul li.active > span, .sidr ul li.sidr-class-active > a, .sidr ul li.sidr-class-active > span'
						)
					),
					array(
						'id'					=> 'sd_link_color',
						'type'					=> 'color',
						'title'					=> __( 'Theme\'s Links Color', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the main color of the links.', 'sd-framework' ),
						'desc'					=> __( 'Default is #2f3c40', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array(
														'color' => 'a'
						)
					),					
					array(
                            'id'   => 'sd_header_styling_info',
                            'type' => 'info',
                            'desc' => __( 'Header Styling', 'sd-framework' )
                     ),
					array(
						'id'					=> 'sd_header_bg',
						'type'					=> 'color',
						'title'					=> __( 'Header Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the header background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #ffffff', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '#sd-header' )
					),
					array(
						'id'					=> 'sd_top_bar_bg',
						'type'					=> 'color',
						'title'					=> __( 'Top Bar Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the header top bar background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #ffffff', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '.sd-header-top')
					),
					array(
						'id'					=> 'sd_top_bar_border',
						'type'					=> 'color',
						'title'					=> __( 'Top Bar Border', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the header top bar border color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #e4e4e4', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array(
													'border-color' => '.sd-header-top, .sd-header-left-options li, .sd-header-social a, .sd-header-social'
						)
					),
					array(
						'id'					=> 'sd_top_bar_text',
						'type'					=> 'color',
						'title'					=> __( 'Top Bar Text', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the header top bar text color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #666565', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array('.sd-header-left-options li, .sd-header-left-options li, .sd-header-social a' )
					),
					array(
						'id'					=> 'sd_top_bar_news_text_bg',
						'type'					=> 'color',
						'title'					=> __( 'Top Bar "News" Word Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the header top bar "News" word background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #f96868', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array(
													'background-color' => '.sd-news-span'
						)
					),
					array(
						'id'					=> 'sd_top_bar_news_content_bg',
						'type'					=> 'color',
						'title'					=> __( 'Top Bar News Content Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the header top bar news content background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #e9e9e9', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array(
													'background-color' => '.sd-news-content-span'
						)
					),
					array(
                            'id'   => 'sd_menu_styling_info',
                            'type' => 'info',
                            'desc' => __( 'Menu Styling', 'sd-framework' )
                     ),
					array(
                        'id'            => 'sd_menu_margin_top',
                        'type'          => 'spacing',
                        'title'         => __('Menu Top Margin', 'sd-framework'),
                        'subtitle'      => __('Adjust the top margin of the menu.', 'sd-framework'),
                        'desc'          => __('Default is 28px', 'sd-framework'),
						'top'           => true,     
                        'right'         => false,    
                        'bottom'        => false,     
                        'left'          => false,    
                        'units'         => array( 'px' ),     
                        'display_units' => true,  
						'mode'    		=> 'margin',
						'compiler'		=> array( '.sd-menu-wrapper' )
                    ),
					array(
                            'id'       			=> 'sd_menu_link',
                            'type'     			=> 'color',
                            'title'    			=> __( 'Menu Links', 'sd-framework' ),
                            'subtitle' 			=> __( 'Select the menu color.', 'sd-framework' ),
                            'desc'     			=> __( 'Default is #62524c', 'sd-framework' ),
							'transparent' 		=> false,
							'compiler'		=> array( '.sf-menu a' )
                        ),
					array(
                            'id'       			=> 'sd_menu_link_hover',
                            'type'     			=> 'color',
                            'title'    			=> __( 'Menu Links Hover', 'sd-framework' ),
                            'subtitle' 			=> __( 'Select the hovering menu links color.', 'sd-framework' ),
                            'desc'     			=> __( 'Default is #fff', 'sd-framework' ),
							'transparent' 		=> false,
							'compiler'		=> array( '.sf-menu li a:hover, .current-menu-item a, .sf-menu li.sfHover a' )
                        ),
					array(
						'id'					=> 'sd_menu_bg',
						'type'					=> 'color',
						'title'					=> __( 'Menu Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the menu background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #2a2e30', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '.current-menu-item a, .sf-menu li a:hover, .sf-menu li.sfHover > a, #sd-main-menu .current-menu-item > a' )
					),
					array(
						'id'					=> 'sd_menu_dropdown_link',
						'type'					=> 'color',
						'title'					=> __( 'Dropdown Menu Links', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the dropdown menu link color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #e3edf1', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sf-menu li li a, .sd-megamenu li a' )
					),
					array(
						'id'					=> 'sd_menu_dropdown_bg',
						'type'					=> 'color',
						'title'					=> __( 'Dropdown Menu Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the dropdown menu background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #2a2e30', 'sd-framework' ),
						'default'				=> '',
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '.sf-menu li ul, sf-menu li li ul, .sf-menu li li ul, .sd-megamenu li a' )
					),
					array(
						'id'					=> 'sd_menu_dropdown_hover_bg',
						'type'					=> 'color',
						'title'					=> __( 'Dropdown Menu Hover Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the dropdown menu hover background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #0191c6', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '.sf-menu li li a:hover, .sf-menu li li.sfHover > a, .sf-menu li li.sfHover li a:hover, #sd-main-menu .sd-megamenu .sfHover a:hover')
					), 
					array(
                            'id'   => 'sd_newsletter_styling_info',
                            'type' => 'info',
                            'desc' => __( 'Newsletter Box Styling', 'sd-framework' )
                     ),
					 array(
						'id'					=> 'sd_newsletter_bg',
						'type'					=> 'color',
						'title'					=> __( 'Newsletter Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the newsletter box background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #f6f8f8', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '.sd-newsletter-wrapper' )
					),
					array(
						'id'					=> 'sd_newsletter_small_text',
						'type'					=> 'color',
						'title'					=> __( 'Newsletter Small Text', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the newsletter small text color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #0191c6', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-subscribe-text' )
					),
					array(
						'id'					=> 'sd_newsletter_large_text',
						'type'					=> 'color',
						'title'					=> __( 'Newsletter Large Text', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the newsletter large text color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #13232c', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-newsletter-text' ),
						'mode' 				    => 'color'
					),
					array(
						'id'					=> 'sd_newsletter_button',
						'type'					=> 'color',
						'title'					=> __( 'Newsletter Button', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the newsletter button color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #0191c6', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '.sd-newsletter-wrapper input[type="submit"]' )
					),
					array(
						'id'					=> 'sd_newsletter_button_border',
						'type'					=> 'color',
						'title'					=> __( 'Newsletter Button Border', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the newsletter button border color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #02688d', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'border-color' => '.sd-newsletter-wrapper input[type="submit"]' )
					),
					array(
						'id'					=> 'sd_newsletter_button_text',
						'type'					=> 'color',
						'title'					=> __( 'Newsletter Button Text', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the newsletter button text color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #ffffff', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-newsletter-wrapper input[type="submit"]' )
					),
					array(
                            'id'   => 'sd_twitter_box_styling_info',
                            'type' => 'info',
                            'desc' => __( 'Twitter Box Styling', 'sd-framework' )
                     ),
					 array(
						'id'					=> 'sd_twitter_box_bg',
						'type'					=> 'color',
						'title'					=> __( 'Twitter Box Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the Twitter box background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #59d5fe', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '.sd-twitter-feed' )
					),
					array(
						'id'					=> 'sd_twitter_box_icon',
						'type'					=> 'color',
						'title'					=> __( 'Twitter Box Icon', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the Twitter box icon color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #ffffff', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-twitter-feed i' )
					),
					array(
						'id'					=> 'sd_twitter_box_text',
						'type'					=> 'color',
						'title'					=> __( 'Twitter Box Text', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the Twitter box text color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #ffffff', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-latest-tweets-slider' )
					),
					array(
						'id'					=> 'sd_twitter_box_link',
						'type'					=> 'link_color',
						'title'					=> __( 'Twitter Box Links', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the Twitter box link colors.', 'sd-framework' ),
						'desc'					=> __( 'Default is #2c1d13 and #2c1d13', 'sd-framework' ),
						'regular'   			=> true,
                        'hover'					=> true,
                        'active' 				=> false,
                        'visited'  				=> false,
						'compiler' 				=> array( '.sd-latest-tweets-slider a' )
					),
					array(
                            'id'   => 'sd_footer_styling_info',
                            'type' => 'info',
                            'desc' => __( 'Footer Styling', 'sd-framework' )
                     ),
					 array(
						'id'					=> 'sd_footer_bg',
						'type'					=> 'color',
						'title'					=> __( 'Footer Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the footer background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #13232c', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '#sd-footer' )
					),
					array(
						'id'					=> 'sd_footer_titles',
						'type'					=> 'color',
						'title'					=> __( 'Footer Widget Titles', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the footer widget titles color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #dcdcdc', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-footer-title' )
					),
					array(
						'id'					=> 'sd_footer_text',
						'type'					=> 'color',
						'title'					=> __( 'Footer Text', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the footer text color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #3b5868', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-footer-widgets' )
					),
					array(
						'id'					=> 'sd_footer_link',
						'type'					=> 'link_color',
						'title'					=> __( 'Footer Links', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the footer link colors.', 'sd-framework' ),
						'desc'					=> __( 'Default is #3b5868 and #ffffff', 'sd-framework' ),
						'regular'   			=> true,
                        'hover'					=> true,
                        'active' 				=> false,
                        'visited'  				=> false,
						'compiler' 				=> array( '.sd-footer-widgets a, .blogroll li:before, #sd-footer .widget_nav_menu li:before' )
					),
					array(
						'id'					=> 'sd_footer_form_fields_bg',
						'type'					=> 'color',
						'title'					=> __( 'Footer Form Fields Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the footer form fields background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #1e323d', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '.sd-footer-sidebar-widget .wpcf7-text, .sd-footer-sidebar-widget .wpcf7-textarea, .sd-footer-sidebar-widget .wpcf7-captchar' )
					),
					array(
						'id'					=> 'sd_footer_form_fields_text',
						'type'					=> 'color',
						'title'					=> __( 'Footer Form Fields Text', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the footer form fields text color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #ffffff', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-footer-sidebar-widget .wpcf7-text, .sd-footer-sidebar-widget .wpcf7-textarea, .sd-footer-sidebar-widget .wpcf7-captchar' )
					),
					array(
						'id'					=> 'sd_footer_form_fields_placeholder',
						'type'					=> 'color',
						'title'					=> __( 'Footer Form Fields Placeholders', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the footer form fields placeholders color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #55656d', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-footer-sidebar-widget input::-moz-placeholder, .sd-footer-sidebar-widget textarea::-moz-placeholder' )
					),
					array(
						'id'					=> 'sd_footer_form_button_border',
						'type'					=> 'color',
						'title'					=> __( 'Footer Form Button Border', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the footer form button color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #0191c6', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'border-color' => '.sd-footer-sidebar-widget .wpcf7-submit' )
					),
					array(
						'id'					=> 'sd_footer_form_button_text',
						'type'					=> 'color',
						'title'					=> __( 'Footer Form Button Text', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the footer form button text color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #ffffff', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-footer-sidebar-widget .wpcf7-submit' )
					),
					array(
						'id'					=> 'sd_footer_copyright_bg',
						'type'					=> 'color',
						'title'					=> __( 'Copyright Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the copyright background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #06161f', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '.sd-copyright' )
					),
					array(
						'id'					=> 'sd_footer_copyright_text',
						'type'					=> 'color',
						'title'					=> __( 'Copyright Text', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the copyright text color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #213641', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( '.sd-copyright' )
					),
					array(
						'id'					=> 'sd_footer_copyright_link',
						'type'					=> 'link_color',
						'title'					=> __( 'Copyright Links', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the copyright link colors.', 'sd-framework' ),
						'desc'					=> __( 'Default is #2f3c40 and #ffffff', 'sd-framework' ),
						'regular'   			=> true,
                        'hover'					=> true,
                        'active' 				=> false,
                        'visited'  				=> false,
						'compiler' 				=> array( '.sd-copyright a' )
					),
					array(
                            'id'   => 'sd_page_top_styling_info',
                            'type' => 'info',
                            'desc' => __( 'Page Top Titles Styling', 'sd-framework' )
                     ),
					 array(
                            'id'       		  => 'sd_page_top_padding',
                            'type' 		      => 'spacing',
							'title'   		  => __( 'Page Title Padding', 'sd-framework' ),
                            'subtitle' 		  => __( 'Insert your custom page title paddings.', 'sd-framework' ),
                            'desc'   		  => __( 'Defaults are: Top = 80px and Bottom = 70px', 'sd-framework' ),
                            'top'             => true,     
                            'right'           => false,    
                            'bottom'          => true,     
                            'left'            => false,    
                            'units'           => array( 'px' ),
                            'units_extended'  => false,  
                            'display_units'   => true,  
                            'default'  		  => '',
							'mode'     		  => 'padding',
							'compiler' 		  => array( '.sd-page-top' )
                        ),
					array(
						'id'					=> 'sd_page_top_bg',
						'type'					=> 'color',
						'title'					=> __( 'Page Top Background', 'sd-framework' ), 
						'subtitle'				=> __( 'Select the page top titles background color.', 'sd-framework' ),
						'desc'					=> __( 'Default is #dbdbdb', 'sd-framework' ),
						'transparent'			=> false,
						'compiler' 				=> array( 'background-color' => '.sd-page-top' )
					),
					array(
                            'id'   => 'sd_custom_css_styling_info',
                            'type' => 'info',
                            'desc' => __( 'Custom CSS Styling', 'sd-framework' )
                     ),
					array(
                            'id'       => 'sd_custom_css',
                            'type'     => 'ace_editor',
                            'title'    => __( 'Custom Styling', 'sd-framework' ),
                            'subtitle' => __( 'Insert your custom CSS code here.', 'sd-framework' ),
                            'mode'     => 'css',
                            'theme'    => 'chrome',
							'options'  => array( 'minLines'=> 50 ),
                        ),	
				)
			);
            

            $this->sections[] = array(
                'title'     => __('404 Page', 'sd-framework'),
                'desc'      => '',
                'icon'      => 'el-icon-error',
                'fields'    => array(
				
					array(
                        'id'       => 'sd_404_layout',
                        'type'     => 'select',
                        'title'    => __( '404 Page Layout', 'sd-framework' ),
                        'subtitle' => __( 'Select the layout for the 404 error page.', 'sd-framework' ),
                        'options'  => array(
                        	'1' => 'With Sidebar',
                            '2' => 'Full Width'
                         ),
                        'default'  => '1'
                    ),
					array(
                        'id'       => 'sd_404_title',
                        'type'     => 'text',
                        'title'    => __( '404 Page Title', 'sd-framework' ),
                        'subtitle' => __( 'Inert a custom 404 error page title.', 'sd-framework' ),
                        'default'  => 'Ooops, 404 Not Found!'
                        ),
					array(
                        'id'        => 'sd_404_content',
                        'type'      => 'editor',
                        'title'     => __('404 Page Content', 'sd-framework'),
                        'subtitle'  => __('Insert your custom content for the 404 error page.', 'sd-framework')
                    ),	
				),
            );
			
			$this->sections[] = array(
                'title'     => __('Admin Page', 'sd-framework'),
                'desc'      => '',
                'icon'      => 'el-icon-lock',
                'fields'    => array(
					
					array(
                        'id'        => 'sd_admin_logo_upload',
                        'type'      => 'media',
                        'url'       => false,
                        'title'     => __('Custom Admin Logo', 'sd-framework'),
                        'compiler'  => 'true',
                        'desc'      => __('Upload your custom admin logo image.', 'sd-framework'),
						'default'  	=> array(
      						  'url'	=> get_template_directory_uri() . '/framework/images/my-university-logo.png'
						)
					),
					array(
                        'id'       => 'sd_admin_logo_height',
                        'type'     => 'dimensions',
                        'title'    => __( 'Logo Height', 'sd-framework' ),
                        'subtitle' => __( 'Insert the height of your logo.', 'sd-framework' ),
						'width'	   => false,
						'units'    => array('px'),
                    ),
					array(
                        'id'        => 'sd_admin_url',
                        'type'      => 'text',
                        'title'     => __('Admin logo URL', 'sd-framework'),
                        'subtitle'  => __('Insert your custom admin logo URL.', 'sd-framework'),
						'desc'      => __('Always start with http://', 'sd-framework')
                    ),	
				),
            );
     
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'sd-framework'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'sd-framework')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'sd-framework'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'sd-framework')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'sd-framework');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'sd_data',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => '<span class="dashicons dashicons-admin-generic" style="color: #fff; font-size: 21px; line-height: 30px; margin-right: 10px;"></span>' . __('Theme Options', 'sd-framework'),     // Name that appears at the top of your panel
                'display_version'   => '',  // Version that appears at the top of your panel
                'menu_type'         => 'submenu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'sd-framework'),
                'page_title'        => __('Theme Options', 'sd-framework'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyDcvn0X3xtwZHuohdAJs0pOCno6PUMl6B0', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => false,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => false,                    // Enable basic customizer support
				'update_notice' 	=> false,
                
                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/skatdesign',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/skatdesign',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
			
			$this->args['share_icons'][] = array(
                'url'   => 'http://youtube.com/zabestof',
                'title' => 'Subscribe on Youtube',
                'icon'  => 'el-icon-youtube'
            );

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new SD_Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

// add font awesome to redux
if (!function_exists('sd_redux_font_awesome')) {
	function sd_redux_font_awesome() {
    		// Uncomment this to remove elusive icon from the panel completely
		    //wp_deregister_style( 'redux-elusive-icon' );
		    //wp_deregister_style( 'redux-elusive-icon-ie7' );
 
    		wp_register_style(
	        	'sd-redux-font-awesome',
		        get_template_directory_uri() . '/framework/css/font-awesome.css',
        		array(),
			    time(),
        		'all'
		    ); 
		    wp_enqueue_style( 'sd-redux-font-awesome' );
		}
}
		
		add_action( 'redux/page/sd_data/enqueue', 'sd_redux_font_awesome' );

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
