<?php
/**
 * Plugin Name: Boros Closed Site or Redirect
 * Plugin URI:  https://alexkoti.com
 * Description: Close site for non-logged users. Show maintenance HTML message or redirect to another url.
 * Version:     1.0.0
 * Author:      Alex Koti
 * Author URI:  http://alexkoti.com
 * License:     GPL2
 */

/*
{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {URI to Plugin License}.
*/

add_action( 'template_redirect', 'close_site' );
function close_site(){
    if( defined('CLOSED_SITE') ){
        if( !is_user_logged_in() ){
            // definir se é url(redirect) ou lock page
            if( is_bool(CLOSED_SITE) and CLOSED_SITE === true ){
                
                $closed_site_html = apply_filters('boros_closed_site_html', '');
                if( !empty( $closed_site_html ) ){
                    echo $closed_site_html;
                }
                else {
                    ?>
                    <!doctype html>
                    <html <?php language_attributes(); ?>>
                    <head>
                        <meta charset="<?php bloginfo( 'charset' ); ?>" />
                        <meta name="viewport" content="width=device-width, initial-scale=1" />
                        <?php wp_head(); ?>
                    </head>
                    <body style="background-color: #fff; padding: 50px; text-align: center;">
                        <h1>Maintenance</h1>
                        <?php wp_footer(); ?>
                    </body>
                    </html>
                    <?php
                }
                exit();
            }
            else {
                if( is_array(CLOSED_SITE) ){
                    wp_redirect( CLOSED_SITE[0], CLOSED_SITE[1] );
                }
                else{
                    wp_redirect( CLOSED_SITE, 302 );
                }
                exit();
            }
        }
    }
}

