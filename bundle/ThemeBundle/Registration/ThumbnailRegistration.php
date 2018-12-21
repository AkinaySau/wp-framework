<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 19.12.18
 * Time: 16:35
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\ThemeBundle\Registration;


use Sau\WP\Framework\Bundle\ThemeBundle\Configuration;

class ThumbnailRegistration implements RegistrationInterface
{
    /**
     * @param Configuration $configuration
     */
    public function registration(Configuration $configuration)
    {
        add_theme_support( 'post-thumbnails' );
        if (is_array($thumbnails = $configuration->getConfig('thumbnail'))) {
            foreach ($thumbnails as $thumbnail) {
                add_image_size($thumbnail[ 'name' ], $thumbnail[ 'width' ], $thumbnail[ 'height' ],
                    $thumbnail[ 'crop' ]);
                if ($thumbnail[ 'media_manager' ]) {
                    add_filter('image_size_names_choose', function ($sizes) use ($thumbnail) {
                        return array_merge($sizes, [$thumbnail[ 'name' ] => $thumbnail[ 'media_manager' ]]);
                    });
                }
            }
        }
    }
}
