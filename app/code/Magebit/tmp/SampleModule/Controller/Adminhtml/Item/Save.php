<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 10:27
 */

namespace Magebit\SampleModule\Controller\Adminhtml\Item;


use Magebit\SampleModule\Model\ItemFactory;

class Save extends \Magento\Backend\App\Action
{
    private $itemFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ItemFactory $itemFactory
    ){
        $this->itemFactory = $itemFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->itemFactory->create()
            ->setData($this->getRequest()->getPostValue()['general'])
            ->save();
        return $this->resultRedirectFactory->create()->setPath('magebit/index/index');
    }
}
