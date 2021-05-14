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

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Backend\Block\Widget\Context;
use Marco\Faq\Model\Question;

/**
 * Class Delete
 * @package Magebit\Faq\Ui\Component\Form\Button
 */
class Delete implements ButtonProviderInterface
{

    /**
     * @var \Magento\Backend\Block\Widget\Context
     */
    protected $context;

    /**
     * @var \Magebit\Faq\Api\QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * Delete constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }


    /**
     * @return array
     */
    public function getButtonData(): array
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
    public function getDeleteUrl(): string
    {
        return $this->context->getUrlBuilder()->getUrl('*/*/delete', ['id' => $this->getId()]);
    }

    public function getId(){
        return $this->context->getRequest()->getParam(Question::ID);
    }

}

