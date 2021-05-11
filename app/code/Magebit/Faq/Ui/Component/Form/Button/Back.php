<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:19
 */

namespace Magebit\Faq\Ui\Component\Form\Button;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

use Magento\Framework\UrlInterface;

class Back implements ButtonProviderInterface
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $urlBuilder;

    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->urlBuilder->getUrl('*/*/')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

}
