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
     */
    public function enableQuestion();

    /**
     * Disable Question
     *
     */
    public function disableQuestion();

}
