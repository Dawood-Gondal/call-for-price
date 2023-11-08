<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_CallForPrice
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\CallForPrice\Pricing\Render;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product\Pricing\Renderer\SalableResolverInterface;
use Magento\Catalog\Pricing\Price\MinimalPriceCalculatorInterface;
use Magento\Framework\Pricing\Price\PriceInterface;
use Magento\Framework\Pricing\Render\RendererPool;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\View\Element\Template\Context;

class FinalPriceBox extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    /**
     * @var ProductRepositoryInterface
     */
    protected ProductRepositoryInterface $productRepository;

    /**
     * @param Context $context
     * @param SaleableInterface $saleableItem
     * @param PriceInterface $price
     * @param RendererPool $rendererPool
     * @param ProductRepositoryInterface $productRepository
     * @param SalableResolverInterface|null $salableResolver
     * @param MinimalPriceCalculatorInterface|null $minimalPriceCalculator
     * @param array $data
     */
    public function __construct(
        Context $context,
        SaleableInterface $saleableItem,
        PriceInterface $price,
        RendererPool $rendererPool,
        ProductRepositoryInterface $productRepository,
        SalableResolverInterface $salableResolver = null,
        MinimalPriceCalculatorInterface $minimalPriceCalculator = null,
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        parent::__construct(
            $context,
            $saleableItem,
            $price,
            $rendererPool,
            $data,
            $salableResolver,
            $minimalPriceCalculator
        );
    }

    /**
     * @param $html
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function wrapResult($html): string
    {
        $product = $this->productRepository->getById($this->getSaleableItem()->getId());

        // If call_for_price enable hide price
        if ($product->getCallForPrice() == 1) {
            return '';
        }

        return '<div class="price-box ' . $this->getData('css_classes') . '" ' .
            'data-role="priceBox" ' .
            'data-product-id="' . $this->getSaleableItem()->getId() . '" ' .
            'data-price-box="product-id-' . $this->getSaleableItem()->getId() . '"' .
            '>' . $html . '</div>';
    }
}
