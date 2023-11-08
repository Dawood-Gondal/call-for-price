<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_CallForPrice
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\CallForPrice\Model;

use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Ui\DataProvider\AbstractDataProvider;
use M2Commerce\CallForPrice\Model\ResourceModel\Requester\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var ProductAttributeRepositoryInterface
     */
    protected $productAttributeRepository;

    /**
     * @throws NoSuchEntityException
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $requesterCollectionFactory,
        ProductAttributeRepositoryInterface $productAttributeRepository,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $requesterCollectionFactory->create();
        $this->productAttributeRepository = $productAttributeRepository;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $attribute = $this->productAttributeRepository->get('name');
        $productNameAttrId = $attribute->getAttributeId();
        $this->collection->getSelect()
            ->joinLeft(
                ['product' => 'catalog_product_entity'],
                "product.entity_id = main_table.product_id",
                ['product_sku' => 'product.sku']
            )
            ->joinLeft(
                ['cpev' => 'catalog_product_entity_varchar'],
                'cpev.entity_id = main_table.product_id AND cpev.attribute_id=' . $productNameAttrId,
                ['product_name' => 'cpev.value']
            );
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        $this->loadedData = [];

        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }

        return $this->loadedData;
    }
}
