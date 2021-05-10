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

class MassDelete extends Action
{

    const ADMIN_RESOURCE = 'Magebit_Faq::questions';

    protected $filter;

    protected $collectionFactory;

    private $categoryRepository;

    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        QuestionRepositoryInterface $categoryRepository = null
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->categoryRepository = $categoryRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->create(QuestionRepositoryInterface::class);
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            throw new NotFoundException(__('Page not found'));
        }
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $questionsDeleted = 0;
        foreach ($collection->getItems() as $category) {
            $this->categoryRepository->delete($category);
            $questionsDeleted++;
        }

        if ($questionsDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $questionsDeleted)
            );
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('faq/question/index');
    }
}
