<?php
/**
 * Laravel Mix helper for WordPress plugins and themes.
 *
 * @package   HybridMix
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2021 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/themehybrid/hybrid-mix
 */

namespace Hybrid\Mix;

/**
 * Helper class for working with Laravel Mix.
 *
 * @since  1.0.0
 * @access public
 */
class Mix {

        /**
	 * Directory path to public assets folder.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
        protected $path = '';

        /**
         * Directory URI to assets folder.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        protected $uri = '';

        /**
	 * JSON decoded array of the `mix-manifest.json` file.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
        protected $mix = [];

        /**
	 * Sets up the default object state.
	 *
	 * @since  1.0.0
	 * @access public
         * @param  string  $path
         * @param  string  $uri
	 * @return void
	 */
        public function __construct( $path, $uri ) {
                $this->path = $path;
                $this->uri  = $uri;
        }

        /**
	 * Returns the `mix-manifest.json` file if it exists or an empty string.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
        protected function manifest() {
                $manifest = trailingslashit( $this->path ) . 'mix-manifest.json';

                return file_exists( $manifest ) ? $manifest : '';
        }

        /**
	 * Returns an array of the JSON-decoded `mix-manifest.json`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
        protected function mix() {

		if ( ! $this->mix && $manifest = $this->manifest() ) {
                        $this->mix = (array) json_decode(
                                file_get_contents( $manifest ),
                                true
                        );
                }

		return $this->mix;
	}

        /**
	 * Returns the URI to the asset file.
	 *
	 * @since  1.0.0
	 * @access public
         * @param  string  $path
	 * @return string
	 */
        public function asset( $path ) {

                // Get the Laravel Mix manifest.
                $manifest = $this->mix();

                // Make sure to trim any slashes from the front of the path.
                $path = '/' . ltrim( $path, '/' );

                if ( $manifest && isset( $manifest[ $path ] ) ) {
                        $path = $manifest[ $path ];
                }

                return untrailingslashit( $this->uri ) . $path;
        }
}
