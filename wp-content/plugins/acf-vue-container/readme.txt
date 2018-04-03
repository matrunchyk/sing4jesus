=== Advanced Custom Fields: Vue Container ===
Contributors: matrunchyk
Author: Serhii Matrunchyk
Author URI: http://matrunchyk.com
Plugin URI: http://www.advancedcustomfields.com
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: trunk
Version: 1.1.1


== Copyright ==
Copyright 2018 Serhii Matrunchyk

This software is NOT to be distributed, but can be INCLUDED in WP themes: Premium or Contracted.
This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.


== Description ==

= Break free from static inputs and create multiple rows of loop-able data =

The Vue Container field acts as placeholder for mounting Vue instances.


== Installation ==

This software can be treated as both a WP plugin and a theme include.
However, only when activated as a plugin will updates be available/

= Plugin =
1. Copy the 'acf-vue-container' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

= Include =
1. Copy the 'acf-vue-container' folder into your theme folder (can use sub folders)
   * You can place the folder anywhere inside the 'wp-content' directory
2. Edit your functions.php file and add the following code to include the field:

`
include_once('acf-vue-container/acf-vue-container.php');
`
3. Make sure the path is correct to include the acf-vue-container.php file
4. Remove the acf-vue-container-update.php file from the folder.


== Changelog ==

= 0.0.1 =
* Initial Release.
