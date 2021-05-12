<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:17
 */

namespace Magebit\Faq\Model;


use \Magebit\Faq\Api\QuestionManagementInterface;
use \Magebit\Faq\Model\ResourceModel\QuestionFactory;
use \Magebit\Faq\Model\Question;
use \Magebit\Faq\Model\Question\Source\Status;

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
     *
     */
    public function enableQuestion(\Magebit\Faq\Model\Question $question)
    {
        $question->setStatus(Status::STATUS_ENABLED)->save();
    }

    /**
     *
     */
    public function disableQuestion(\Magebit\Faq\Model\Question $question)
    {
        $question->setStatus(Status::STATUS_DISABLED)->save();
    }


}
