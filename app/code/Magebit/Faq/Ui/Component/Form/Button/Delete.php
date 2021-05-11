<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:19
 */

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

use Magento\Backend\Block\Widget\Context;

class Delete implements ButtonProviderInterface
{

    /**
     * @var Context
     */
    protected $context;

    protected $questionRepository;

    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'label' => __('Delete Question'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * URL to send delete requests to.
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->context->getUrlBuilder()->getUrl('*/*/delete', ['id' => $this->getId()]);
    }

    public function getId(){
        return 4;
    }

}

