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

    /**
     * Plugin list
     *
     * @var array
     */
    public $plugins_slug = array();

    /**
     * Themes list
     *
     * @var array
     */
    public $themes_slug = array();

    /**
     * Filters to customize plugins/themes
     */
    public function __construct() {
        $this->plugins_slug = array(
            'elementor'     => 'elementor',
            'elementor-pro' => 'elementor_pro',
            'js_composer'   => 'wpbakery',
            'siteorigin'    => 'siteorigin',
            'fl-builder'    => 'beaverbuilder_lite',
            'fusion'        => 'fusion',
            'oxygen'        => 'oxygen',
        );
        $this->themes_slug = array(
            'divi' => 'divi',
        );
        $this->plugins_slug = \apply_filters( 'page_madness_detector_add_plugin_detection', $this->plugins_slug );
        $this->themes_slug  = \apply_filters( 'page_madness_detector_add_theme_detection', $this->themes_slug );
    }

    /**
     * Detect if that page builder is active
     *
     * @param string $slug The plugin/theme slug/textdomain
     * @return bool
     */
    public function detect( $slug ) {
        if ( isset( $this->plugins_slug[ $slug ] ) ) {
            return \call_user_func( $this->plugins_slug[ $slug ] );
        }

        if ( isset( $this->themes_slug[ $slug ] ) ) {
            return \call_user_func( $this->themes_slug[ $slug ] );
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
            if ( \call_user_func( array( $this, $plugin ) ) ) {
                return true;
            }
        }

        foreach( $this->themes_slug as $theme ) {
            if ( \call_user_func( array( $this, $theme ) ) ) {
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
     * Detect if Page Builder by Siteorigin
     *
     * @return bool
     */
    public static function siteorigin() {
        return \defined( 'SITEORIGIN_PANELS_VERSION' );
    }

    /**
     * Detect if Beaver Builder
     *
     * @return bool
     */
    public static function beaverbuilder_lite() {
        return \class_exists( 'FLBuilderLoader' );
    }

    /**
     * Detect if Fusion Page Builder
     *
     * @return bool
     */
    public static function fusion() {
        return \defined( 'FSN_VERSION' );
    }

    /**
     * Detect if Oxygen Builder
     *
     * @return bool
     */
    public static function oxygen() {
        return \defined( 'CT_VERSION' );
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
