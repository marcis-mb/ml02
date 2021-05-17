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

namespace Magebit\Faq\ViewModel;

use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Class QuestionList
 * @package Magebit\Faq\ViewModel
 */
class QuestionList implements ArgumentInterface
{
    /**
     * Sort order
     */
    const SORT_ORDER_ASC = 'asc';

    /**
     * @var \Magebit\Faq\Model\ResourceModel\Question\Collection
     */
    private $collection;

    /**
     * QuestionList constructor.
     * @param QuestionFactory $questionFactory
     * @param CollectionFactory $questionCollectionFactory
     */
    public function __construct(
        CollectionFactory $questionCollectionFactory
    )
    {
        $this->collection = $questionCollectionFactory->create();
    }


    /**
     * @return \Magento\Framework\DataObject[]
     */
    public function getQuestions(): array
    {
        $questions = $this->collection
            ->addFilter(Question::STATUS, Question::STATUS_ENABLED)
            ->setOrder(Question::POSITION, self::SORT_ORDER_ASC)
            ->getItems();
        return $questions;
    }
}
