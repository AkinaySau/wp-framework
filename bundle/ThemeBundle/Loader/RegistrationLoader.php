<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 19.12.18
 * Time: 17:07
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\ThemeBundle\Loader;


use Sau\WP\Framework\Bundle\ThemeBundle\Configuration;
use Sau\WP\Framework\Bundle\ThemeBundle\Registration\RegistrationInterface;

class RegistrationLoader
{
    protected $collection;

    /**
     * @return RegistrationInterface[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param RegistrationInterface $registration
     */
    public function add(RegistrationInterface $registration): void
    {
        $this->collection[ get_class($registration) ] = $registration;
    }

    public function load(Configuration $configuration)
    {
        foreach ($this->getCollection() as $registration) {
            $registration->registration($configuration);
        }
    }
}
