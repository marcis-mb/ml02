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
    public function enableQuestion()
    {
        // TODO: Implement enableQuestion() method.
    }

    /**
     *
     */
    public function disableQuestion()
    {
        // TODO: Implement disableQuestion() method.
    }


}
