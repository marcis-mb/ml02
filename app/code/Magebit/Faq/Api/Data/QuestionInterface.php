<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:04
 */

namespace Magebit\Faq\Api\Data;

use \Magento\Framework\Api\CustomAttributesDataInterface;

interface QuestionInterface
{
    /**#@+
     * Constants defined for keys of  data array
     */
    const ID = 'id';

    const QUESTION = 'question';

    const ANSWER = 'answer';

    const STATUS = 'status';

    const POSITION = 'position';

    const UPDATED_AT = 'updated_at';

    const ATTRIBUTES = [
        self::ID,
        self::QUESTION,
        self::ANSWER,
        self::STATUS,
        self::UPDATED_AT,
    ];

    /**#@-*/

    /**
     * Question id
     *
     * @return int|null
     */
    public function getId();

    /**
     * FAQ question
     *
     * @return string|null
     */
    public function getQuestion();

    /**
     * Set FAQ question
     *
     * @param string $question
     * @return $this
     */
    public function setQuestion($question);

    /**
     * FAQ answer
     *
     * @return string|null
     */
    public function getAnswer();

    /**
     * Set FAQ answer
     *
     * @param string $answer
     * @return $this
     */
    public function setAnswer($answer);

    /**
     * Question status
     *
     * @return int|null
     */
    public function getStatus();

    /**
     * Set question status
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Question position
     *
     * @return int|null
     */
    public function getPosition();

    /**
     * Set question position
     *
     * @param int $position
     * @return $this
     */
    public function setPosition($position);

    /**
     * Question updated date
     *
     * @return string|null
     */
    public function getUpdatedAt();



}
