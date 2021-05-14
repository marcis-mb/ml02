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

interface QuestionInterface
{
    /**
     * Database table name
     */
    const MAIN_TABLE = 'magebit_faq';


    /**#@+
     * Database table fields
     */
    const ID = 'id';

    const QUESTION = 'question';

    const ANSWER = 'answer';

    const STATUS = 'status';

    const POSITION = 'position';

    const UPDATED_AT = 'updated_at';

    /**
     * Question id
     *
     * @return string|null
     */
    public function getId(): ?string;

    /**
     * FAQ question
     *
     * @return string|null
     */
    public function getQuestion(): ?string;

    /**
     * Set FAQ question
     *
     * @param string $question
     * @return QuestionInterface
     */
    public function setQuestion($question): QuestionInterface;

    /**
     * FAQ answer
     *
     * @return string|null
     */
    public function getAnswer(): ?string;

    /**
     * Set FAQ answer
     *
     * @param string $answer
     * @return QuestionInterface
     */
    public function setAnswer($answer): QuestionInterface;

    /**
     * Question status
     *
     * @return int|null
     */
    public function getStatus(): ?int;

    /**
     * Set question status
     *
     * @param int $status
     * @return QuestionInterface
     */
    public function setStatus($status): QuestionInterface;

    /**
     * Question position
     *
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * Set question position
     *
     * @param int $position
     * @return QuestionInterface
     */
    public function setPosition($position): QuestionInterface;

    /**
     * Question updated date
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;



}
