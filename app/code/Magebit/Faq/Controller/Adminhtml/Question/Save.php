<?php


namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;

class Save
    extends \Magento\Backend\App\Action
{
    /**
     * @var \Magebit\Faq\Api\QuestionRepositoryInterface;
     */
    private $questionRepository;

    private $questionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        QuestionFactory $questionFactory,
        QuestionRepositoryInterface $questionRepository
    ){
        $this->questionFactory = $questionFactory;
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    public function execute(){
        $this->questionFactory->create()
            ->setData($this->getRequest()->getPostValue())
            ->save();
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
