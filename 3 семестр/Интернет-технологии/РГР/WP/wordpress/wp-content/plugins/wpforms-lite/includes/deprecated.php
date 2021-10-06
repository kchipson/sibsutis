<?php
/**
 * To be compatible with both WP 4.9 (that can run on PHP 5.2+) and WP 5.3+ (PHP 5.6+)
 * we need to rewrite some core WP classes and tweak our own skins to not use PHP 5.6 splat operator (...$args)
 * that were introduced in WP 5.3 in \WP_Upgrader_Skin::feedback().
 * This alias is a safeguard to those developers who decided to use our internal class WPForms_Install_Silent_Skin,
 * which we deleted.
 *
 * @since 1.5.6.1
 */
class_alias( 'WPForms\Helpers\PluginSilentUpgraderSkin', 'WPForms_Install_Silent_Skin' );
