<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:05
 */

namespace Magebit\Faq\Api;


/**
 * Interface QuestionManagementInterface
 * @package Magebit\Faq\Api
 */
interface QuestionManagementInterface
{

    /**
     * Enable Question
     *
     * @param \Magebit\Faq\Model\Question $question
     * @return mixed
     */
    public function enableQuestion(\Magebit\Faq\Model\Question $question);


    /**
     * Disable Question
     *
     * @param \Magebit\Faq\Model\Question $question
     * @return mixed
     */
    public function disableQuestion(\Magebit\Faq\Model\Question $question);

}
