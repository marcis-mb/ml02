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

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magebit\Faq\Model\QuestionFactory $questionFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_questionFactory = $questionFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $question = $this->_questionFactory->create();
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
