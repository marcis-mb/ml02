<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:16
 */

namespace Magebit\Faq\Model\Question;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Reporting;

class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    /**
     * @var AuthorizationInterface
     */
    private $authorization;

//    /**
//     * @var AddFilterInterface[]
//     */
//    private $additionalFilterPool;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Reporting $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param array $meta
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Reporting $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );

        $this->meta = array_replace_recursive($meta, $this->prepareMetadata());
    }

    /**
     * Get authorization info.
     *
     * @deprecated 101.0.7
     * @return AuthorizationInterface|mixed
     */
    private function getAuthorizationInstance()
    {
        if ($this->authorization === null) {
            $this->authorization = ObjectManager::getInstance()->get(AuthorizationInterface::class);
        }
        return $this->authorization;
    }

    /**
     * Prepares Meta
     *
     * @return array
     */
    public function prepareMetadata()
    {
        $metadata = [];

        if (!$this->getAuthorizationInstance()->isAllowed('Magebit_Faq::save')) {
            $metadata = [
                'faq_question_columns' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'editorConfig' => [
                                    'enabled' => false
                                ],
                                'componentType' => \Magento\Ui\Component\Container::NAME
                            ]
                        ]
                    ]
                ]
            ];
        }

        return $metadata;
    }

//    /**
//     * @inheritdoc
//     */
//    public function addFilter(Filter $filter)
//    {
//        if (!empty($this->additionalFilterPool[$filter->getField()])) {
//            $this->additionalFilterPool[$filter->getField()]->addFilter($this->searchCriteriaBuilder, $filter);
//        } else {
//            parent::addFilter($filter);
//        }
//    }
}
