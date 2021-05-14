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


use Magebit\Faq\Model\QuestionFactory;
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
     * @var \Magebit\Faq\Model\QuestionFactory
     */
    private $questionFactory;

    /**
     * QuestionList constructor.
     * @param \Magebit\Faq\Model\QuestionFactory $questionFactory
     */
    public function __construct(
        QuestionFactory $questionFactory
    )
    {
        $this->questionFactory = $questionFactory;
    }

    /**
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public function getQuestions()
    {
        $question = $this->questionFactory->create();
        return $question->getCollection()
            ->addFilter($question::STATUS, $question::STATUS_ENABLED)
            ->setOrder($question::POSITION, self::SORT_ORDER_ASC);
    }
}
