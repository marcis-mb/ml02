<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:16
 */

namespace Magebit\Faq\Model\Question;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magebit\Faq\Model\ResourceModel\Question\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $questionCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $questionCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;

    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

//    /**
//     * Get data
//     *
//     * @return array
//     */
//    public function getData()
//    {
//        echo "<pre>";
//        print_r($this->getCollection()->toArray());
//        echo "</pre>";
//        exit;
//        return $this->getCollection()->toArray();
//    }

    public function getData(){
        $result = [];
        $i = 0;
        foreach ($this->collection->getItems() as $item){
            //$result[$item->getId()]['general'] = $item->getData();
            $result['items'][$i++] = $item->getData();
        }
        //$result['totalRecords'] = $i;
//                echo "<pre>";
//        print_r($result);
//        echo "</pre>";
//        exit;
        return $result;
    }

}

//use Magento\Cms\Ui\Component\AddFilterInterface;
//use Magento\Framework\Api\Filter;
//use Magento\Framework\Api\FilterBuilder;
//use Magento\Framework\Api\Search\SearchCriteriaBuilder;
//use Magento\Framework\App\ObjectManager;
//use Magento\Framework\App\RequestInterface;
//use Magento\Framework\AuthorizationInterface;
//use Magento\Framework\View\Element\UiComponent\DataProvider\Reporting;
//
///**
// * DataProvider for cms ui.
// */
//class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
//{
//    /**
//     * @var AuthorizationInterface
//     */
//    private $authorization;
//
//    /**
//     * @var AddFilterInterface[]
//     */
//    private $additionalFilterPool;
//
//    /**
//     * @param string $name
//     * @param string $primaryFieldName
//     * @param string $requestFieldName
//     * @param Reporting $reporting
//     * @param SearchCriteriaBuilder $searchCriteriaBuilder
//     * @param RequestInterface $request
//     * @param FilterBuilder $filterBuilder
//     * @param array $meta
//     * @param array $data
//     * @param array $additionalFilterPool
//     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
//     */
//    public function __construct(
//        $name,
//        $primaryFieldName,
//        $requestFieldName,
//        Reporting $reporting,
//        SearchCriteriaBuilder $searchCriteriaBuilder,
//        RequestInterface $request,
//        FilterBuilder $filterBuilder,
//        array $meta = [],
//        array $data = [],
//        array $additionalFilterPool = []
//    ) {
//        parent::__construct(
//            $name,
//            $primaryFieldName,
//            $requestFieldName,
//            $reporting,
//            $searchCriteriaBuilder,
//            $request,
//            $filterBuilder,
//            $meta,
//            $data
//        );
//
//        $this->meta = array_replace_recursive($meta, $this->prepareMetadata());
//        $this->additionalFilterPool = $additionalFilterPool;
//    }
//
//    /**
//     * Get authorization info.
//     *
//     * @deprecated 101.0.7
//     * @return AuthorizationInterface|mixed
//     */
//    private function getAuthorizationInstance()
//    {
//        if ($this->authorization === null) {
//            $this->authorization = ObjectManager::getInstance()->get(AuthorizationInterface::class);
//        }
//        return $this->authorization;
//    }
//
//    /**
//     * Prepares Meta
//     *
//     * @return array
//     */
//    public function prepareMetadata()
//    {
//        $metadata = [];
//
//        if (!$this->getAuthorizationInstance()->isAllowed('Magebit_Faq::faq')) {
//            $metadata = [
//                'faq_question_columns' => [
//                    'arguments' => [
//                        'data' => [
//                            'config' => [
//                                'editorConfig' => [
//                                    'enabled' => false
//                                ],
//                                'componentType' => \Magento\Ui\Component\Container::NAME
//                            ]
//                        ]
//                    ]
//                ]
//            ];
//        }
//
//        return $metadata;
//    }
//
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
//}
