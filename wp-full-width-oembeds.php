<?php
/*
Plugin Name: WordPress Full-width oEmbeds
Description: Adjust embeds of narrow oEmbed iframes to occupy the full-width of the content area, maintaining proportional height.
Version:     1.0
Author:      Hipmill
Author URI:  http://www.hipmill.com
License:     MIT
License URI: https://opensource.org/licenses/MIT
*/



// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



if ( ! class_exists( 'WP_Full_Width_Oembeds' ) ):

    class WP_Full_Width_Oembeds {

        /*
         * The constructor function.
         */
        protected function __construct() {
            // Add the required CSS.
            add_action( 'wp_head', array( $this, 'add_css' ), 99 );
            // Alter the HTML of the embed.
            add_filter( 'embed_oembed_html', array( $this, 'wrap_oembed_iframe_in_container' ) );
        }



        private function __clone() {}
        private function __wakeup() {}



        /**
         * Function which retrieves the singleton class instance.
         */
        public static function run_instance() {
            static $instance = null;
            if ( $instance === null ) {
                $instance = new static();
            }

            return $instance;
        }



        /**
         * Add the CSS to the page head. Ideally, remove this function
         * and associated hook and copy the contained CSS into the
         * theme style.css or other CSS file.
         */
        public function add_css() {
?>
            <style type="text/css">
                .oembed-wrapper {
                    display: block;
                    height: 0;
                    padding-bottom: 56.25%;
                    position: relative;
                    width: 100%;
                }

                .oembed-wrapper iframe {
                    height: 100%;
                    left: 0;
                    position: absolute;
                    top: 0;
                    width: 100%;
                }
            </style>
<?php
        }



        /**
         * Wrap oEmbed iframes in custom container,
         * to allow proper styling of iframe proportions.
         *
         * @param string $ifram_html the HTML of the discovered iframe
         * @return string the updated HTML
         */
        function wrap_oembed_iframe_in_container( $iframe_html ) {
            /* Wrap the iframe inside a span element, since
             * the parent element might be a paragraph. Span
             * element is styled via theme CSS to display block. */
            $iframe_html = sprintf( '<span class="oembed-wrapper">%s</span>', $iframe_html );
            return $iframe_html;
        }

    }

endif;

WP_Full_Width_Oembeds::run_instance();