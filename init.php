<?php

/**
 * Detect if the website is using a page builder/visual builder
 *
 * @author    Mte90 <mte90net@gmail.com>
 * @license   GPL-3.0+
 * @copyright 2022
 *
 */
class Page_Madness_Detector {

    private $plugins_slug = array(
        'elementor' => array( $this, 'elementor' ),
        'elementor-pro' => array( $this, 'elementor_pro' ),
        'js_composer' => array( $this, 'wpbakery' ),
    );

    private $themes_slug = array(
        'divi' => array( $this, 'divi' ),
    );

    /**
     * Load all the plugins definition
     */
    public function __construct() {
        $this->plugins_slug = \apply_filters( 'page_madness_detector_add_plugin_detection', $this->plugins_slug );
    }

    /**
     * Detect if that page builder is active
     *
     * @param string $slug The plugin/theme slug/textdomain
     * @return bool
     */
    public function detect( $slug ) {
        if ( isset( $this->plugins_slug[ $slug ] ) ) {
            return \call_user_func_array( $this->plugins_slug[ $slug ][0], $this->plugins_slug[ $slug ][1] );
        }

        if ( isset( $this->themes_slug[ $slug ] ) ) {
            return \call_user_func_array( $this->themes_slug[ $slug ][0], $this->themes_slug[ $slug ][1] );
        }

        return false;
    }

    /**
     * Detect if there is atleast one of the page builder active
     *
     * @return bool
     */
    public function has_entrophy() {
        foreach( $this->plugins_slug as $plugin ) {
            if ( \call_user_func_array( $this->plugins_slug[ $plugin ][0], $this->plugins_slug[ $plugin ][1] ) ) {
                return true;
            }
        }

        foreach( $this->themes_slug as $theme ) {
            if ( \call_user_func_array( $this->themes_slug[ $theme ][0], $this->themes_slug[ $theme ][1] ) ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Detect if Elementor Free
     *
     * @return bool
     */
    public static function elementor() {
        return \defined( 'ELEMENTOR_VERSION' );
    }

    /**
     * Detect if Elementor Pro
     *
     * @return bool
     */
    public static function elementor_pro() {
        return \defined( 'ELEMENTOR_PRO_VERSION' );
    }

    /**
     * Detect if WPBakery
     *
     * @return bool
     */
    public static function wpbakery() {
        return \defined( 'WPB_VC_VERSION' );
    }

    /**
     * Detect if Divi
     *
     * @return bool
     */
    public static function divi() {
        return \function_exists( 'et_setup_theme' );
    }
}
