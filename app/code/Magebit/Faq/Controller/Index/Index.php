<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:10
 */

namespace Magebit\Faq\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Element\Template;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use \Magebit\Faq\Model\QuestionFactory;

class Index extends Action
{
    private $pageFactory;

    private $questionFactory;

    //private $questionInterface;

    /**
     * @var \Magebit\Faq\Api\QuestionRepositoryInterface;
     */
    private $questionRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        QuestionFactory $questionFactory,
        QuestionRepositoryInterface $questionRepository
    )
    {
        $this->pageFactory = $pageFactory;
        $this->questionFactory = $questionFactory;
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->getConfig()->getTitle()->set('Frequently Asked Questions');

        /** @var Template $block */
        $block = $page->getLayout()->getBlock('magebit.faq.index.layout');
        $question = $this->questionFactory->create();

        $question->setAnswer('Fourth question?');
        $question->setQuestion('Fourth answer!');

        $this->questionRepository->save($question);

        //$questionToDelete = $this->questionRepository->get(3);
        $this->questionRepository->deleteById(3);

        $collection = $question->getCollection();
        $block->setData('collection', $collection);

        return $page;
    }
}
