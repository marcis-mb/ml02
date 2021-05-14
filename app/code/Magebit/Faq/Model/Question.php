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

use Magebit\Faq\Api\Data\QuestionInterface;
use \Magento\Framework\Model\AbstractModel;


/**
 * Class Question
 * @package Magebit\Faq\Model
 */
class Question extends AbstractModel implements QuestionInterface
{
    /**#@+
     * Question's statuses
     */
    const STATUS_ENABLED = 0;

    const STATUS_DISABLED = 1;

    /**
     * Construct.
     *
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Question::class);
    }


    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->getData(self::ID);
    }

    /**
     * @return string|null
     */
    public function getQuestion(): ?string
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * @param string $question
     * @return QuestionInterface
     */
    public function setQuestion($question): QuestionInterface
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * @return string|null
     */
    public function getAnswer(): ?string
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @param string $answer
     * @return QuestionInterface
     */
    public function setAnswer($answer): QuestionInterface
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @param int $status
     * @return QuestionInterface
     */
    public function setStatus($status): QuestionInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->getData(self::POSITION);
    }

    /**
     * @param int $position
     * @return QuestionInterface
     */
    public function setPosition($position): QuestionInterface
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Prepare question's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses(): array
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
