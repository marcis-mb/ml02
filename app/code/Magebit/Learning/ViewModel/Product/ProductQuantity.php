<?php
/**
 * This file is part of the Magebit learning theme package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit Faq
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2019 Magebit, Ltd. (https://magebit.com/)
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Magebit\learning\ViewModel\Product;

use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Check product Available quantity in the scope of current websites in all sources together.
 */
class ProductQuantity implements ArgumentInterface
{

    /**
     * @var \Magento\InventorySalesApi\Api\GetProductSalableQtyInterface
     */
    protected $getProductSalableQtyInterface;

    /**
     * @var \Magento\InventorySales\Model\ResourceModel\GetAssignedStockIdForWebsite
     */
    protected $getAssignedStockIdForWebsite;

    /**
     * ProductQuantity constructor.
     * @param \Magento\InventorySalesApi\Api\GetProductSalableQtyInterface $getProductSalableQtyInterface
     * @param \Magento\InventorySales\Model\ResourceModel\GetAssignedStockIdForWebsite $getAssignedStockIdForWebsite
     */
    public function __construct(\Magento\InventorySalesApi\Api\GetProductSalableQtyInterface $getProductSalableQtyInterface,
                                \Magento\InventorySales\Model\ResourceModel\GetAssignedStockIdForWebsite $getAssignedStockIdForWebsite)
    {
        $this->getProductSalableQtyInterface = $getProductSalableQtyInterface;
        $this->getAssignedStockIdForWebsite = $getAssignedStockIdForWebsite;
    }


    /**
     * Return actual Saleable quantity
     *
     * @param $product
     * @return float
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getQty($product): float
    {
        $stockId = $this->getAssignedStockIdForWebsite->execute($product->getStore()->getWebsite()->getCode());
        return $this->getProductSalableQtyInterface->execute($product->getSku(), $stockId);
    }

}
