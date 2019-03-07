<?php
namespace Mageside\CatalogHoverImage\Model\Plugin;

use Magento\TestFramework\ObjectManager;

class SchemaLocator
{
    /**
     * After Get Schema
     *
     * @param \Magento\Framework\Config\SchemaLocator $schemaLocator
     * @param string $result
     * @return array
     */
    public function afterGetSchema(\Magento\Framework\Config\SchemaLocator $schemaLocator, $result)
    {
        $result = sprintf(realpath(__DIR__ . '/../../etc/view.xsd'));
        return $result;
    }
}