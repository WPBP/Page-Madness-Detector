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
            'elementor'     => array( 'detect' => 'elementor', 'version' => 'elementor_version' ),
            'elementor-pro' => array( 'detect' => 'elementor_pro', 'version' => 'elementor_pro_version' ),
            'js_composer'   => array( 'detect' => 'wpbakery', 'version' => 'wpbakery_version' ),
            'siteorigin'    => array( 'detect' => 'siteorigin', 'version' => 'siteorigin_version' ),
            'fl-builder'    => array( 'detect' => 'beaverbuilder_lite', 'version' => 'beaverbuilder_lite_version' ),
            'fusion'        => array( 'detect' => 'fusion', 'version' => 'fusion_version' ),
            'oxygen'        => array( 'detect' => 'oxygen', 'version' => 'oxygen_version' ),
            'bricks'        => array( 'detect' => 'bricks', 'version' => 'bricks_version' ),
        );
        $this->themes_slug = array(
            'divi' => array( 'detect' => 'divi', 'version' => 'divi_version' ),
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
            return \call_user_func( $this->plugins_slug[ $slug ]['detect'] );
        }

        if ( isset( $this->themes_slug[ $slug ] ) ) {
            return \call_user_func( $this->themes_slug[ $slug ]['detect'] );
        }

        return false;
    }

    /**
     * Return the page builder version if found
     *
     * @param string $slug The plugin/theme slug/textdomain
     * @return string|bool
     */
    public function version( $slug ) {
        if ( isset( $this->plugins_slug[ $slug ] ) ) {
            return \call_user_func( $this->plugins_slug[ $slug ]['version'] );
        }

        if ( isset( $this->themes_slug[ $slug ] ) ) {
            return \call_user_func( $this->themes_slug[ $slug ]['version'] );
        }

        return false;
    }

    /**
     * Detect if there is atleast one of the page builder active
     *
     * @return bool
     */
    public function has_entropy() {
        foreach( $this->plugins_slug as $plugin ) {
            if ( \call_user_func( array( $this, $plugin['detect'] ) ) ) {
                return true;
            }
        }

        foreach( $this->themes_slug as $theme ) {
            if ( \call_user_func( array( $this, $theme['detect'] ) ) ) {
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
     * Return Elementor Free version
     *
     * @return string
     */
    public static function elementor_version() {
        return \defined( 'ELEMENTOR_VERSION' ) && \ELEMENTOR_VERSION;
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
     * Return Elementor Pro version
     *
     * @return string
     */
    public static function elementor_pro_version() {
        return \defined( 'ELEMENTOR_PRO_VERSION' ) && \ELEMENTOR_PRO_VERSION;
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
     * Return WPBakery version
     *
     * @return string
     */
    public static function wpbakery_version() {
        return \defined( 'WPB_VC_VERSION' ) && \WPB_VC_VERSION;
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
     * Return Page Builder by Siteorigin version
     *
     * @return string
     */
    public static function siteorigin_version() {
        return \defined( 'SITEORIGIN_PANELS_VERSION' ) && \SITEORIGIN_PANELS_VERSION;
    }

    /**
     * Detect if Beaver Builder
     *
     * @return bool
     */
    public static function beaverbuilder_lite() {
        return \defined( 'FL_BUILDER_VERSION' );
    }

    /**
     * Return Beaver Builder version
     *
     * @return string
     */
    public static function beaverbuilder_lite_version() {
        return \defined( 'FL_BUILDER_VERSION' ) && \FL_BUILDER_VERSION;
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
     * Return Fusion Page Builder version
     *
     * @return string
     */
    public static function fusion_version() {
        return \defined( 'FSN_VERSION' ) && \FSN_VERSION;
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
     * Return Oxygen Builder version
     *
     * @return string
     */
    public static function oxygen_version() {
        return \defined( 'CT_VERSION' ) && \CT_VERSION;
    }

    /**
     * Detect if Divi
     *
     * @return bool
     */
    public static function divi() {
        return \function_exists( 'et_setup_theme' );
    }

    /**
     * Return Divi version
     *
     * @return string
     */
    public static function divi_version() {
        return \function_exists( 'et_setup_theme' ) && \et_get_theme_version();
    }

    /**
     * Detect if Bricks
     *
     * @return bool
     */
    public static function bricks() {
        return \defined( 'BRICKS_VERSION' );
    }

    /**
     * Return Bricks version
     *
     * @return string
     */
    public static function bricks_version() {
        return \defined( 'BRICKS_VERSION' ) && \BRICKS_VERSION;
    }
}
