<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_CallForPrice
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\CallForPrice\ViewModel;

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ProductView implements ArgumentInterface
{

    /**
     * @var ProductRepository
     */
    protected $productRepo;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepo = $productRepository;
    }

    /**
     * @param $product
     * @return \Magento\Catalog\Api\Data\ProductInterface|mixed|null
     */
    public function getProductData($product)
    {
        try {
            return $this->productRepo->getById($product->getId());
        } catch (\Exception $e) {
        }
        return $product;
    }
}
