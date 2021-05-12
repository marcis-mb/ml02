<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.12.5
 * Time: 14:23
 */

namespace Magebit\Faq\ViewModel;


use Magebit\Faq\Model\QuestionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class QuestionList implements ArgumentInterface
{
    const SORT_ORDER_ASC = 'asc';

    private $questionFactory;

    public function __construct(
        QuestionFactory $questionFactory
    )
    {
        $this->questionFactory = $questionFactory;
    }

    public function getQuestions(){
        $question = $this->questionFactory->create();
        return $question->getCollection()->setOrder($question::POSITION, self::SORT_ORDER_ASC);
    }
}
