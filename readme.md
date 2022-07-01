# Page Madness Detector

The library name is just an information for something that WordPress developers know. Page Builder/Visual Composer create a huge entrophy with the various features that they offers with difference by versions.

This library is a way to create a wrapper that let's the developer to detect if they are used in the website.

**WIP**

## Detect

### Plugins

* Elementor
* Elementor Pro
* WP Bakery
* Site Origin
* Beaver Builder Lite
* Fusion Page Builder
* Oxygen Builder

### Themes (that include those solutions)

* Divi

## Examples

```php
<?php
$builder = new Page_Madness_Detector();
if ( $builder->detect('elementor') || $builder->detect('elementor-pro') ) {
    echo 'Elementor';
}

// If any plugin or theme is active detected by the library
$builder->has_entrophy();
```
