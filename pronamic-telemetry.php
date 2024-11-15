<?php
/**
 * Plugin Name: Pronamic Telemetry
 * Plugin URI: https://www.pronamic.eu/plugins/pronamic-telemetry/
 * Description: Pronamic Telemetry is a library that collects data from WordPress websites powered by Pronamic solutions.
 *
 * Version: 1.0.0
 * Requires at least: 5.9
 * Requires PHP: 8.1
 *
 * Author: Pronamic
 * Author URI: https://www.pronamic.eu/
 *
 * Text Domain: pronamic-telemetry
 * Domain Path: /languages/
 *
 * License: proprietary
 *
 * GitHub URI: https://github.com/pronamic/wp-pronamic-telemetry
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPressTelemetry
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload_packages.php';

\Pronamic\WordPressTelemetry\Plugin::instance()->setup();
