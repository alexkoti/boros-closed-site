=== Boros Closed Site ===
Contributors: alexkoti
Donate link: https://example.com/
Tags: redirect, maintenance
Requires at least: 5.0.0
Tested up to: 5.9.1
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Close site for non-logged users. Show maintenance HTML message or redirect to another url.

== Installation ==

Add the constant 'CLOSED_SITE' `in wp-config.php` with value `true` or absolute url.

If the constant value is a absolute url, the visitor will redirected to url, with 302 code. If the value is `true`, the 
will show a pre-made maintenance message, or use a custom HTML from 'boros_closed_site_html' hook.

The hook 'boros_closed_site_html' need to be in functions.php in the active theme or inside a any active plugin.

Examples

```
// custom HTML message
add_filter('boros_closed_site_html', function(){
    return '
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Closed</title>
</head>
<body>
<h1>Closed</h1>
<p>Maintenance</p>
</body>
</html>
    ';
});

// show predefined message (or custom HTML if 'boros_closed_site_html' hook used):
define( 'CLOSED_SITE', true );

// simple redirect 302:
define( 'CLOSED_SITE', 'https://google.com' );

// set url and redirect status
define( 'CLOSED_SITE', array('https://google.com', 301) );
define( 'CLOSED_SITE', array('https://google.com', 302) );
```
