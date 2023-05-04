# Page Madness Detector

The library name is just an information for something that *WordPress developers know*.  
Page Builders/Visual Composers create a huge entropy with the various features that they offers with difference by versions.  
This library is a way to create a wrapper that let's the developer to detect if they are used in the website.

## Detect list

### Plugins

* Elementor
* Elementor Pro
* WP Bakery
* Site Origin
* Beaver Builder Lite
* Fusion Page Builder
* Oxygen Builder
* Bricks Builder (it is a theme with child but use a constant)

### Themes (that include those solutions)

* Divi

## Examples

```php
<?php
$builder = new Page_Madness_Detector();
// Specific plugin/theme
if ( $builder->detect('elementor') || $builder->detect('elementor-pro') ) {
    echo 'Elementor';
}

// Boolean value if a plugin/theme of that list is detect
$builder->has_entropy();
// String if a version number is available or false if not detected
$builder->version('elementor');

// Filters
add_filter( 'page_madness_detector_add_plugin_detection', fuction( $plugins ) {
    return $plugins;
});
add_filter( 'page_madness_detector_add_theme_detection', fuction( $themes ) {
    return $themes;
});
```
