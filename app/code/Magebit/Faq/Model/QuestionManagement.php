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

namespace Magebit\Faq\Model;


use \Magebit\Faq\Api\QuestionManagementInterface;
use \Magebit\Faq\Model\ResourceModel\QuestionFactory;


/**
 * Class QuestionManagement
 * @package Magebit\Faq\Model
 */
class QuestionManagement implements QuestionManagementInterface
{

    /**
     * @var QuestionFactory
     */
    protected $questionFactory;


    /**
     * QuestionManagement constructor.
     * @param QuestionFactory $questionFactory
     */
    public function __construct(QuestionFactory $questionFactory)
    {
        $this->questionFactory = $questionFactory;
    }


    /**
     * @param \Magebit\Faq\Model\Question $question
     * @return void
     * @throws \Exception
     */
    public function enableQuestion(Question $question): void
    {
        $question->setStatus(Question::STATUS_ENABLED)->save();
    }


    /**
     * @param \Magebit\Faq\Model\Question $question
     * @return void
     * @throws \Exception
     */
    public function disableQuestion(Question $question): void
    {
        $question->setStatus(Question::STATUS_DISABLED)->save();
    }


}
