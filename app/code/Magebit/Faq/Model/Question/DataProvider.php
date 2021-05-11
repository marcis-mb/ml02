<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:16
 */

namespace Magebit\Faq\Model\Question;

use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magebit\Faq\Model\ResourceModel\Question\Collection
     */
    protected $collection;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $questionCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $questionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

//    public function getData(){
//        $result = $this->collection->getItems();
////        $result = [];
////        foreach ($this->collection->getItems() as $item){
////            $result[$item->getId()]['general'] = $item->getData();
////        }
//        return $result;
//    }

}
