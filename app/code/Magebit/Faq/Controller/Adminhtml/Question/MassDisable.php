<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:11
 */

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\NotFoundException;
use Magebit\Faq\Api\QuestionManagementInterface;

class MassDisable extends Action
{

    const ADMIN_RESOURCE = 'Magebit_Faq::questions';

    protected $filter;

    protected $collectionFactory;

    private $questionRepository;

    private $questionManagement;

    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        QuestionManagementInterface $questionManagement,
        QuestionRepositoryInterface $questionRepository = null
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->questionManagement = $questionManagement;
        $this->questionRepository = $questionRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->create(QuestionRepositoryInterface::class);
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            throw new NotFoundException(__('Question not found'));
        }
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $questionsDisabled = 0;
        foreach ($collection->getItems() as $question) {
            $this->questionManagement->disableQuestion($question);
            $questionsDisabled++;
        }

        if ($questionsDisabled) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been disabled.', $questionsDisabled)
            );
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('faq/question/index');
    }
}
