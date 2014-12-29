<?php

/**
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */

namespace Elcodi\StoreProductBundle\Transformer;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Elcodi\Component\Product\Entity\Interfaces\ProductInterface;
use Elcodi\Component\Sitemap\Transformer\Interfaces\SitemapTransformerInterface;

/**
 * Class SitemapProductTransformer
 */
class SitemapProductTransformer implements SitemapTransformerInterface
{
    /**
     * @var UrlGeneratorInterface
     *
     * Url generator
     */
    protected $urlGenerator;

    /**
     * Construct
     *
     * @param UrlGeneratorInterface $urlGenerator Url generator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Get url given an entity
     *
     * @param Object $entity Entity
     *
     * @return string url
     */
    public function getLoc($entity)
    {
        return ($entity instanceof ProductInterface)
            ? $this
                ->urlGenerator
                ->generate('store_product_view', [
                    'id' => $entity->getId(),
                    'slug' => $entity->getSlug(),
                ], true)
            : '';
    }

    /**
     * Get last mod
     *
     * @param Object $entity Entity
     *
     * @return string Last mod value
     */
    public function getLastMod($entity)
    {
        return ($entity instanceof ProductInterface)
            ? $entity->getUpdatedAt()->format("c")
            : '';
    }

    /**
     * Get Change freq
     *
     * @param Object $entity Entity
     *
     * @return string Change freq value
     */
    public function getChangeFreq($entity)
    {
        return 'daily';
    }

    /**
     * Get Priority
     *
     * @param Object $entity Entity
     *
     * @return string Priority value
     */
    public function getPriority($entity)
    {
        return 1;
    }
}
