<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_CallForPrice
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\CallForPrice\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Validator\ValidateException;

class CallForPrice implements DataPatchInterface
{
    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    protected $setup;

    /**
     * @param EavSetupFactory $eavSetupFactory
     * @param ModuleDataSetupInterface $setup
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        ModuleDataSetupInterface $setup
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->setup = $setup;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     * @throws LocalizedException|ValidateException
     */
    public function apply()
    {
        $this->setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->setup]);

        $eavSetup->removeAttribute(
            Product::ENTITY,
            'call_for_price'
        );

        $eavSetup->addAttribute(
            Product::ENTITY,
            'call_for_price',
            [
                'label' => 'Call For Price',
                'group' => 'General',
                'type' => 'int',
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                'frontend' => '',
                'note' => 'Yes to show call for price request button on pdp and plp',
                'input' => 'boolean',
                'class' => '',
                'source' => Boolean::class,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '0',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
            ]
        );
        $this->setup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases(): array
    {
        return [];
    }
}
