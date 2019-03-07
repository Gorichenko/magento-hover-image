<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CatalogHoverImage\Block\Adminhtml\System\Config\Fieldset;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Module\ModuleList\Loader;
use Mageside\CatalogHoverImage\Helper\Config as Helper;

class Hint extends Template implements RendererInterface
{
    /**
     * @var string
     */
    protected $_template = 'Mageside_CatalogHoverImage::system/config/fieldset/hint.phtml';

    /**
     * @var \Magento\Framework\Module\ModuleList\Loader
     */
    private $loader;

    /**
     * @var \Mageside\CatalogHoverImage\Helper\Config
     */
    private $helper;

    /**
     * Hint constructor.
     * @param Context $context
     * @param Loader $loader
     * @param Helper $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Loader $loader,
        Helper $helper,
        array $data = []
    ) {
        $this->loader = $loader;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return mixed
     */
    public function render(AbstractElement $element)
    {
        return $this->toHtml();
    }

    /**
     * @return mixed
     */
    public function getModuleName()
    {
        return $this->helper->getConfigModule('module_name');
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        $modules = $this->loader->load();
        $v = "";
        if (isset($modules['Mageside_CatalogHoverImage'])) {
            $v = "v" . $modules['Mageside_CatalogHoverImage']['setup_version'];
        }

        return $v;
    }

    /**
     * @return mixed
     */
    public function getModulePage()
    {
        return $this->helper->getConfigModule('module_page_link');
    }
}