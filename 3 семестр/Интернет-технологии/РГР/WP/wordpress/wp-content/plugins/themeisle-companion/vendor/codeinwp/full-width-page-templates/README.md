# Full-Width Templates
-------------
A composer library which injects, in WordPress Dashboard, a Full-Width option in the Page Template selector.

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/ff19f3a4a9724f5c97f88d64fbbc1493)](https://www.codacy.com/app/andrei.lupu/full-width-page-templates?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Codeinwp/full-width-page-templates&amp;utm_campaign=Badge_Grade)

#### Supported Builders:
* A plain simple WordPress page
* Elementor

### Compatible themes?
At this moment this library ensures compatibility with the follwing WordPress themes(and more to come):
* [Hestia](https://wordpress.org/themes/hestia/) - by ThemeIsle
* [Hestia Pro](https://themeisle.com/themes/hestia-pro/) - by ThemeIsle
* [Zerif Lite](https://themeisle.com/themes/zerif-lite) - by ThemeIsle
* [ShopIsle](https://wordpress.org/themes/shop-isle/) - by ThemeIsle
* [Orfeo](https://themeisle.com/themes/orfeo) - by ThemeIsle
* [Edge](https://wordpress.org/themes/edge/) - By themefreesia  
* [Experon](https://wordpress.org/themes/experon/) - ThinkUpThemes  
* [Genesis](http://my.studiopress.com/themes/genesis/) - By StudioPress  
* [GeneratePress](https://wordpress.org/themes/generatepress/) - By Tom Usborne   
* [Storefront](https://wordpress.org/themes/storefront/) - by WooThemes/Automattic 
* [TwentyTwelve](https://wordpress.org/themes/twentytwelve/) - by WordPress.org  
* [TwentyThirteen](https://wordpress.org/themes/twentythirteen/) - by WordPress.org  
* [TwentyFourteen](https://wordpress.org/themes/twentyfourteen/) - by WordPress.org  
* [TwentyFifteen](https://wordpress.org/themes/twentyfifteen/) - by WordPress.org  
* [TwentySixteen](https://wordpress.org/themes/twentysixteen/) - by WordPress.org  
* [TwentySeventeen](https://wordpress.org/themes/twentyseventeen/) - by WordPress.org   
* [Vantage](https://wordpress.org/themes/vantage/) - by Greg Priday  
* [Virtue](https://wordpress.org/themes/virtue/) - by Kadence Themes   
* [Enlightenment](https://wordpress.org/themes/enlightenment/) - by Daniel Tara
* [Actions](https://wordpress.org/themes/actions/) - by WPDevHQ
* [ActionsPro](https://wpdevhq.com/themes/actions-pro/) - by WPDevHQ
* [Kale](https://wordpress.org/themes/kale/) - by lyrathemes
* [InVogue](https://wordpress.org/themes/invogue) - by Kaira
* [Universal-Store](https://wordpress.org/themes/universal-store/) - by Themes4WP
* [Editorial](https://wordpress.org/themes/editorial/) - by Mystery Themes
* [Renden Business](https://wordpress.org/themes/renden-business/) - by ThinkUpThemes
* [Spacious](https://wordpress.org/themes/spacious/) - by ThemeGrill
* [Flash](https://wordpress.org/themes/spacious/) - by ThemeGrill
* [Writee](https://wordpress.org/themes/writee/) - by Scissor Themes
* [VT Blogging](https://wordpress.org/themes/vt-blogging/) - by VolThemes
* [One Page Express](https://wordpress.org/themes/one-page-express/) - by horearadu
* [Primer](https://wordpress.org/themes/primer/) - by GoDaddy
* [Vantage](https://wordpress.org/themes/vantage/) - by SiteOrigin
* [Customizr](https://wordpress.org/themes/customizr/) - by Nicolas Guillaume
* [Nikko Portfolio](https://wordpress.org/themes/nikko-portfolio/) - by Colormelon
* [Poseidon](https://wordpress.org/themes/poseidon/) - by ThemeZee
* [Envo Business](https://wordpress.org/themes/envo-business/) - by EnvoThemes
* [Hueman](https://wordpress.org/themes/hueman/) - by Nicolas Guillaume
* [News Portal](https://wordpress.org/themes/news-portal/) - by Mystery Themes
* [Illdy](https://wordpress.org/themes/illdy/) - by Silkalns
* [Envy Blog](https://wordpress.org/themes/envy-blog/) - by Precise Themes
* [Avant](https://wordpress.org/themes/avant/) - by Kaira
* [OceanWP](https://wordpress.org/themes/oceanwp/) - by oceanwp
* [Astra](https://wordpress.org/themes/astra/) - by Brainstorm Force
* [Mesmerize](https://wordpress.org/themes/mesmerize/) - by horearadu
* [Sydney](https://wordpress.org/themes/sydney/) - by athemes
* [Ashe](https://wordpress.org/themes/ashe/) - by Royal Flush
* [Lodestar](https://wordpress.org/themes/lodestar/) - by Automattic
* [Total](https://wordpress.org/themes/total/) - by Hash Themes
* [Consulting](https://wordpress.org/themes/consulting/) - by ThinkUpThemes
* [ColorMag](https://wordpress.org/themes/colormag/) - by ThemeGrill
* [OnePress](https://wordpress.org/themes/onepress/) - by FameThemes
* [Shapely](https://wordpress.org/themes/shapely/) - by Silkalns
* [HitMag](https://wordpress.org/themes/hitmag/) - by ThemezHut
* [Divi](https://www.elegantthemes.com/gallery/divi) - by Elegant Themes

### How to use it?
Well, this is a Composer library so you will need to add this it as a dependency on your project( either plugin or a theme ) like this:
```
"require": {
    "codeinwp/full-width-page-templates": "master"
}
```
And run a via the terminal a `composer install` and hope that you have Composer installed globally.

The last step is the initialization. Call this wherever you like:
```
if ( class_exists( '\ThemeIsle\FullWidthTemplates' ) ) {
    \ThemeIsle\FullWidthTemplates::instance();
}
```

### Work with this repository?
To work directly with this repository, I use and recommend the following way.

Clone this repository inside the [mu-plugins](https://codex.wordpress.org/Must_Use_Plugins) WordPress directory. This way, we can be sure that the cloned version of this 
library will have priority before the one loaded from Composer.
After cloning you need to create a php file, like `load-fwt-lib.php`(I'm so bad at naming) and inside you will need to require the loader like this:
```
<?php
require_once( dirname( __FILE__ ) . '/full-width-page-templates/load.php' );
```

### How to make a theme compatible with the full-width template?

To add a new theme to the compatibility list, clone this repository(as we talked above) create a new directory with the
theme's name in the `themes` directory.
This theme directory supports two files:

* `inline-style.php` - A file loaded at the right moment to add an inline style
* `functions.php` - An optional file to add actions and filters.

Our goal here is to add a CSS snippet which will make sure that the page container width full.
So make use of the `inline-style.php` and add a snipet like this:
```
<?php
/* Support for the {Theme Name} theme */
$style = '.page-template-builder-fullwidth-std .site-content {
    width: 100%;
    padding: 0;
    margin:0;
}';
wp_add_inline_style( '{theme-style}', $style );
```
Where `{theme-style}` must be an enqueued style.(For example, Twenty Seventeen has 'twentyseventeen-style')

Don't forget to add the new theme to this README.md ;)
