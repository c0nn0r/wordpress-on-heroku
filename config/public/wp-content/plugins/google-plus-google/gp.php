<?php
/*
Plugin Name: Google Plus
Plugin URI: http://wordpress.org/extend/plugins/google-plus-google/
Description: Google Plus Widgets to your wordpress blog.
Version: 1.0.2
Author: Ajitae
Author URI: http://ajitae.com/
License: GPL2

Copyright 2011  PLUGIN_AUTHOR_NAME  (email : ajitaeshine -at- gmail -dot- com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

define('GP_DIR', WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)));
define('GP_URL', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)));
define('GP_ONE', get_option('gp_one'));

require_once 'includes/gp.class.php';

require_once 'includes/one.php';

require_once 'includes/hook.php';

$gp = '';
if (get_option('gp_id'))
    $gp = New GP(get_option('gp_id'));