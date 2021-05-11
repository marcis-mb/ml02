<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:17
 */

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use \Magento\Framework\Model\AbstractModel;


class Question extends AbstractModel implements QuestionInterface
{
    /**#@+
     * Block's statuses
     */
    const STATUS_ENABLED = 0;
    const STATUS_DISABLED = 1;

    /**
     * Construct.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Question::class);
    }


    /**
     * @return int|mixed|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @return mixed|null|string
     */
    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * @param string $question
     * @return QuestionInterface|Question
     */
    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * @return mixed|null|string
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @param string $answer
     * @return QuestionInterface|Question
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * @return int|mixed|null
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @param int $status
     * @return QuestionInterface|Question
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @return int|mixed|null
     */
    public function getPosition()
    {
        return $this->getData(self::POSITION);
    }

    /**
     * @param int $position
     * @return QuestionInterface|Question
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * @return mixed|null|string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Prepare block's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
