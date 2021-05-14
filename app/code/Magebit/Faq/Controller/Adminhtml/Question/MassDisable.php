<?php
declare(strict_types=1);
/**
 * This file is part of the Magebit Faq package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit Faq
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2019 Magebit, Ltd. (https://magebit.com/)
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\NotFoundException;
use Magebit\Faq\Api\QuestionManagementInterface;

/**
 * Class MassDisable
 * @package Magebit\Faq\Controller\Adminhtml\Question
 */
class MassDisable extends Action
{

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magebit_Faq::questions';

    /**
     * @var /Magento\Ui\Component\MassAction\Filter
     */
    protected $filter;

    /**
     * @var /Magebit\Faq\Model\ResourceModel\Question\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var /Magebit\Faq\Api\QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * @var QuestionManagementInterface
     */
    private $questionManagement;

    /**
     * MassDisable constructor.
     * @param Action\Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param QuestionManagementInterface $questionManagement
     * @param QuestionRepositoryInterface|null $questionRepository
     */
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

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws NotFoundException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(): ResultInterface
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
