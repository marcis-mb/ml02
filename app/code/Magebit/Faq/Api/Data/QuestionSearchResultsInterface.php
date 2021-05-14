<?php
declare(strict_types=1);
/**
 * This file is part of the Magebit Faq package.
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

namespace Magebit\Faq\Api\Data;

use \Magento\Framework\Api\SearchResultsInterface;

interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get questions list.
     *
     * @return \Magebit\Faq\Api\Data\QuestionSearchResultsInterface
     */
    public function getItems(): QuestionSearchResultsInterface;

    /**
     * Set questions list.
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface[] $items
     * @return QuestionSearchResultsInterface
     */
    public function setItems(array $items): QuestionSearchResultsInterface;
}
