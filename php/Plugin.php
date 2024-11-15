<?php
/**
 * Plugin
 *
 * @package Pronamic\WordPressTelemetry
 */

namespace Pronamic\WordPressTelemetry;

/**
 * Plugin class
 */
final class Plugin {
	/**
	 * Instance.
	 *
	 * @var self
	 */
	protected static $instance = null;

	/**
	 * Return instance of this class.
	 *
	 * @return self A single instance of this class.
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Setup.
	 * 
	 * @return void
	 */
	public function setup() {
		\add_action( 'init', [ $this, 'init' ] );

		\add_action( 'pronamic_telemetry_cron', [ $this, 'collect_and_send_data' ] );
	}

	/**
	 * Initialize.
	 * 
	 * @return void
	 */
	public function init() {
		$result = \wp_next_scheduled( 'pronamic_telemetry_cron' );

		if ( false === $result ) {
			\wp_schedule_event( \time(), 'daily', 'pronamic_telemetry_cron' );
		}
	}

	/**
	 * Collect and send data.
	 * 
	 * @return void
	 */
	public function collect_and_send_data() {
		/**
		 * Data.
		 * 
		 * @link https://github.com/WordPress/WordPress/blob/9bc4fadffa05adc4bb72120bf335160639e46764/wp-includes/update.php#L417-L426
		 */
		$data = [
			'home_url'    => \home_url( '/' ),
			'php_version' => \PHP_VERSION,
			'plugins'     => \get_plugins(),
			'themes'      => \wp_get_themes(),
			'wp_version'  => \wp_get_wp_version(),
		];

		$map = [
			'server' => 'SERVER',
		];

		foreach ( $map as $parameter => $key ) {
			$name = '_' . $key;

			$data[ $parameter ] = $GLOBALS[ $name ];
		}

		\wp_remote_post(
			'https://wp.pronamic.directory/wp-json/pronamic-telemetry/v1/data',
			[
				'body' => $data,
			]
		);
	}
}
