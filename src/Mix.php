<?php
/**
 * Laravel Mix helper for WordPress plugins and themes.
 *
 * This project generally assume that developers are working with the base
 * Laravel Mix setup. It assumes there is a public folder that houses all of
 * their build assets (e.g., `public/css`, `public/js`, etc.). The `public` path
 * and URI can be customized and passed into the constructor.
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
         * Directory URI to public assets folder.
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
	 * @access protected
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
        public function mix() {

		if ( ! $this->mix && $manifest = $this->manifest() ) {
                        $this->mix = (array) json_decode(
                                file_get_contents( $manifest ),
                                true
                        );
                }

		return $this->mix;
	}

        /**
	 * Returns the URI to the asset file. This method always returns the
	 * asset file URI, regardless of whether it exists in the manifest.
	 *
	 * @since  1.0.0
	 * @access public
         * @param  string  $path
	 * @return string
	 */
        public function asset( $path ) {

                // Get the JSON-decoded manifest.
                $manifest = $this->mix();

                // Make sure to trim any slashes from the front of the path.
                $path = '/' . ltrim( $path, '/' );

		// Gets the path from the manifest.
                if ( $manifest && isset( $manifest[ $path ] ) ) {
                        $path = $manifest[ $path ];
                }

		// Returns the file path appended to the public URI.
                return untrailingslashit( $this->uri ) . $path;
        }
}
