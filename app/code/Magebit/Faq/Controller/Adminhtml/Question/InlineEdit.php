<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:10
 */

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action\Context;
use Magebit\Faq\Api\QuestionRepositoryInterface as QuestionRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use Magebit\Faq\Api\Data\QuestionInterface;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magebit_Faq::question';

    /**
     * @var \Magebit\Faq\Api\QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param QuestionRepository $questionRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        QuestionRepository $questionRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $questionId) {
                    /** @var \Magebit\Faq\Model\Question $question */
                    $question = $this->questionRepository->get($questionId);
                    try {
                        $question->setData(array_merge($question->getData(), $postItems[$questionId]));
                        $this->questionRepository->save($question);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithQuestionId(
                            $question,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add question title to error message
     *
     * @param QuestionInterface $question
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithQuestionId(QuestionInterface $question, $errorText)
    {
        return '[Question ID: ' . $question->getId() . '] ' . $errorText;
    }
}
