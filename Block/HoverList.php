<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */

namespace Mageside\CatalogHoverImage\Block;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Block\Product\ListProduct;
use Mageside\CatalogHoverImage\Helper\Config as HelperConfig;

class HoverList extends ListProduct
{
    /**
     * @var HelperConfig
     */
    private $helperConfig;

    /**
     * HoverList constructor.
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\Data\Helper\PostHelper $postDataHelper
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     * @param CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param HelperConfig $helperConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        HelperConfig $helperConfig,
        array $data = []
    ) {
        $this->helperConfig = $helperConfig;
        parent::__construct(
            $context,
            $postDataHelper,
            $layerResolver,
            $categoryRepository,
            $urlHelper,
            $data
        );
    }

    /**
     * @return string
     */
    public function getHoverImageList()
    {
        $imagesHoverAddress = [];
        $_productCollection = $this->getLoadedProductCollection();
        foreach ($_productCollection as $_product) {
            if (!empty($_product->getData('hover_catalog'))) {
                $imagesHoverAddress[$_product->getData('entity_id')] = $this->getImage($_product, 'hover_image')
                    ->getData('image_url');
            }
        }

        return $this->jsonEncode($imagesHoverAddress);
    }

    /**
     * Instead of using deprecated class
     *
     * @param $data
     * @return string
     */
    public function jsonEncode($data)
    {
        $result = json_encode($data);
        if (false === $result) {
            $result = json_encode([]);
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->helperConfig->isEnabled();
    }
}
