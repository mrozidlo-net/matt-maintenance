<?php

  if ( ! class_exists( 'Mrozidlo_framework_config' ) ) {

    class Mrozidlo_framework_config {

      public $args = array();
      public $sections = array();
      public $theme;
      public $ReduxFramework;

      public function __construct() {

        if ( ! class_exists( 'ReduxFramework' ) ) {
          return;
        }

        // This is needed. Bah WordPress bugs.  ;)
        if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
            $this->initSettings();
        } else {
          add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
        }

      }

      public function initSettings() {

        $this->setArguments();

        $this->setHelpTabs();

        $this->setSections();

        if ( ! isset( $this->args['opt_name'] ) ) {
          return;
        }

        $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
      }

      public function setSections() {

        // Example section

        $this->sections[] = array(
          'title'   => 'Home',
          'icon'    => 'el-icon-home',
          'heading' => 'Home section',
          'desc'    => '<br />Home section settings<br />',
          'fields'  => array(
            array(
              'id'    => 'logo',
              'type'  => 'text',
              'title' => 'Logo url'
            ),
            array(
              'id'    => 'title',
              'type'  => 'text',
              'title' => 'Home title'
            ),
            array(
              'id'    => 'message',
              'type'  => 'textarea',
              'title' => 'Home message'
            ),
            array(
              'id'    => 'contact',
              'type'  => 'textarea',
              'title' => 'Contact section'
            ),
          )
        );

        // SETTINGS

        $this->sections[] = array(
          'title'     => 'Settings',
          'icon'      => 'el-icon-cogs',
          'heading'   => 'Theme settings',
          'desc'      => '<br />Theme settings<br />',
          'fields'    => array(
            array(
              'id'    => 'meta_description',
              'type'  => 'textarea',
              'title' => 'Meta description'
            ),
            array(
              'id'    => 'meta_author',
              'type'  => 'text',
              'title' => 'Meta author'
            ),
            array(
              'id'    => 'meta_keywords',
              'type'  => 'textarea',
              'title' => 'Meta keywords'
            ),
            array(
              'id'    => 'og_type',
              'type'  => 'text',
              'title' => 'og type'
            ),
            array(
              'id'    => 'og_url',
              'type'  => 'text',
              'title' => 'og url'
            ),
            array(
              'id'    => 'og_image',
              'type'  => 'text',
              'title' => 'og image'
            ),
            array(
              'id'    => 'og_fb_app_id',
              'type'  => 'text',
              'title' => 'og fb app id'
            ),
          )
        );

      }

      public function setHelpTabs() {

        // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
        $this->args['help_tabs'][] = array(
          'id'      => 'redux-help-tab-1',
          'title'   => __( 'Pomoc', 'redux-framework-demo' ),
          'content' => __( '<p>Edytowałeś pliki i coś zepsułeś/aś? Nie martw się napisz do mnie email a pomogę Ci z tym.<br>dev.mroz@gmail.com</p>', 'redux-framework-demo' )
        );

        $this->args['help_tabs'][] = array(
          'id'      => 'redux-help-tab-2',
          'title'   => __( 'Własność', 'redux-framework-demo' ),
          'content' => __( '<p>Ten szablon należy wyłącznie do mrozidlo.net</p>', 'redux-framework-demo' )
        );
      }

      public function setArguments() {

        $theme = wp_get_theme();

        $this->args = array(
          'opt_name'           => 'mattwp',
          'display_name'       => $theme->get( 'mattwp' ),
          'display_version'    => $theme->get( 'Version' ),
          'menu_type'          => 'menu',
          'allow_sub_menu'     => true,
          'menu_title'         => __( 'MattWP', 'mattwp-theme' ),
          'page_title'         => __( 'MattWP settings', 'mattwp-theme' ),
          'google_api_key'     => '',

          'async_typography'   => false,
          'admin_bar'          => true,
          'global_variable'    => '',
          'dev_mode'           => false,
          'customizer'         => true,
          'page_priority'      => null,
          'page_parent'        => 'themes.php',
          'page_permissions'   => 'manage_options',
          'menu_icon'          => '',
          'last_tab'           => '',
          'page_icon'          => 'icon-themes',
          'page_slug'          => '_options',
          'save_defaults'      => true,
          'default_show'       => false,
          'default_mark'       => '',
          'show_import_export' => false,

          'transient_time'     => 60 * MINUTE_IN_SECONDS,
          'output'             => true,
          'output_tag'         => true,
          'database'           => '',
          'system_info'        => false,

          'hints'              => array(
            'icon'          => 'icon-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
              'color'   => 'light',
              'shadow'  => true,
              'rounded' => false,
              'style'   => '',
            ),
            'tip_position'  => array(
              'my' => 'top left',
              'at' => 'bottom right',
            ),
            'tip_effect'    => array(
              'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
              ),
            'hide' => array(
              'effect'   => 'slide',
              'duration' => '500',
              'event'    => 'click mouseleave',
              ),
            ),
          )
        );
      }

    }

    global $reduxConfig;
    $reduxConfig = new Mrozidlo_framework_config();
  }
