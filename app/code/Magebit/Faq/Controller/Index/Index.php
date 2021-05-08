<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:10
 */

namespace Magebit\Faq\Controller\Index;

use \Magento\Framework\App\Action\Action;


class Index extends Action
{
    protected $_pageFactory;

    protected $_questionFactory;

    protected $_resourceModel;

    //protected $_questionRepository;



    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magebit\Faq\Model\QuestionFactory $questionFactory
        //\Magebit\Faq\Api\QuestionRepositoryInterface $questionRepository
        //\Magebit\Faq\Model\ResourceModel\Question $resourceModel
    )
    {

        $this->_pageFactory = $pageFactory;
        $this->_questionFactory = $questionFactory;

        parent::__construct($context);
        //$this->_questionRepository = $questionRepository;
        //$this->resourceModel = $resourceModel;


    }

    public function execute()
    {
        $question = $this->_questionFactory->create();
        $question->setQuestion("Is test Ok?");
        $question->setAnswer("First part is!");
        //$this->questionRepository->save($question);
        echo $question->getQuestion();
        $collection = $question->getCollection();
        foreach($collection as $item){
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }
        exit();
        return $this->_pageFactory->create();
    }
}
