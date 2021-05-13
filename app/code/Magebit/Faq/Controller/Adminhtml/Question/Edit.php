<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:10
 */

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionFactory;

//class Edit
//    extends \Magento\Backend\App\Action
//{
//    private $questionFactory;
//
//    public function __construct(
//        \Magento\Backend\App\Action\Context $context,
//        QuestionFactory $questionFactory
//    ){
//        $this->questionFactory = $questionFactory;
//        parent::__construct($context);
//    }
//
//    public function execute(){
//        $this->questionFactory->create()
//            ->setData($this->getRequest()->getPostValue())
//            ->save();
//        return $this->resultRedirectFactory->create()->setPath('faq/question/index');
//    }
//}

use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Edit FAQ question action.
 */
class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $questionFactory;

    protected $coreRegistry;

    /**
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magebit\Faq\Model\QuestionFactory $questionFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magebit\Faq\Model\QuestionFactory $questionFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->questionFactory = $questionFactory;
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Edit FAQ question
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->questionFactory->create();

//        echo "id: " . $id . "<br><pre>";
//        print_r($this->getRequest()->getParams());
//        echo "</pre>";
        //exit;

        // 2. Initial checking
        if ($id) {
            $model->load($id);
//            echo "id: " . $id . "<br><pre>";
//            print_r($model->getData());
//            echo "</pre>";
//            exit;
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This question no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->coreRegistry->register('faq_question', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
//        $this->initPage($resultPage)->addBreadcrumb(
//            $id ? __('FAQ Question') : __('New Question'),
//            $id ? __('FAQ Question') : __('New Question')
//        );
        $resultPage->getConfig()->getTitle()->prepend(__('FAQ Question Edit'));
        //$resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('FAQ Question Edit'));
        return $resultPage;
    }
}
