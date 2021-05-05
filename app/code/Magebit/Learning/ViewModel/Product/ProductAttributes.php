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

declare(strict_types=1);

namespace Magebit\Learning\ViewModel\Product;

use Magento\Framework\View\Element\Block\ArgumentInterface;


class ProductAttributes implements ArgumentInterface
{

    /**
     * Prioritary attributes and their order
     *
     * @var array
     */
    protected $attributeCodes = [
        'dimensions' => false,
        'color' => false,
        'material' => false,
    ];


    /**
     * ProductAttributes constructor.
     */
    public function __construct()
    {
    }


    /**
     * Get 3 attributes. If some of prioritary attributes missign, place filled with other attributes.
     *
     * @param $product
     * @param $additional
     * @param $helper
     * @return array
     */
    public function getAttributes($product, $additional, $helper): array
    {
        $filteredAttributes = [];
        $allAttributes = [];
        $attributeCount = 0;
        $additionalAttributeCount = 0;

        foreach ($additional as $_data) {
            $attributeCode = $_data['code'];
            if ($attributeCode == 'dimensions' || $attributeCode == 'color' || $attributeCode == 'material') {
                $this->attributeCodes[$attributeCode] = true;
                $key = 'basic-' . $attributeCode;
                $attributeCount++;
            } else {
                $key = 'additional-' . ++$additionalAttributeCount;
            }
            $allAttributes [$key]['label'] = $_data['label'];
            $allAttributes [$key]['data'] = $helper->productAttribute($product, $_data['value'], $_data['code']);
        }

        foreach ($this->attributeCodes as $attributeCode => $status) {
            if ($status) {
                $filteredAttributes[] = $allAttributes['basic-' . $attributeCode];
            }
        }

        for ($i = 1; $i < $additionalAttributeCount && $attributeCount < 3; $i++, $attributeCount++) {
            $filteredAttributes[] = $allAttributes['additional-' . $i];
        }

        return $filteredAttributes;
    }


}
