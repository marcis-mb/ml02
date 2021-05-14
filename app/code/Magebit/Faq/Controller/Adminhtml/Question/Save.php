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

use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Backend\App\Action;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var QuestionFactory
     */
    private $questionFactory;

    /**
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param QuestionFactory|null $questionFactory
     * @param QuestionRepositoryInterface|null $questionRepository
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        QuestionFactory $questionFactory = null,
        QuestionRepositoryInterface $questionRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->questionFactory = $questionFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(QuestionFactory::class);
        $this->questionRepository = $questionRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(QuestionRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute(): ResultInterface
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = Question::STATUS_ENABLED;
            }
            if (empty($data['id'])) {
                $data['id'] = null;
            }

            /** @var /Magebit\Faq\Model\Question $model */
            $model = $this->questionFactory->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->questionRepository->get($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This question no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $model->setData($data);
            try {
                $this->questionRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the question.'));
                $this->dataPersistor->clear('faq_question');
                return $this->processQuestionReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
            }

            $this->dataPersistor->set('faq_question', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process and set the question return
     *
     * @param \Magebit\Faq\Model\Question $model
     * @param array $data
     * @param \Magento\Framework\Controller\ResultInterface $resultRedirect
     * @return \Magento\Framework\Controller\ResultInterface
     */
    private function processQuestionReturn($model, $data, $resultRedirect): ResultInterface
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
        } else if ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        }
        return $resultRedirect;
    }
}
