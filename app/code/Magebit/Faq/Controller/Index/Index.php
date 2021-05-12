<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:10
 */

namespace Magebit\Faq\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\Page;

class Index extends Action
{
    private $pageFactory;

    /**
     * @var \Magebit\Faq\Api\QuestionRepositoryInterface;
     */
    private $questionRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Page $page */
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set('Frequently Asked Questions');
        return $page;
    }
}
