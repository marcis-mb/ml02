<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:15
 */

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Indexer\Category\Product\TableMaintainer;
use Magento\Catalog\Model\Indexer\Product\Price\PriceTableResolver;
use Magento\Catalog\Model\Product\Attribute\Source\Status as ProductStatus;
use Magento\Catalog\Model\Product\Gallery\ReadHandler as GalleryReadHandler;
//use Magento\Catalog\Model\ResourceModel\Product\Collection\ProductLimitationFactory;
use Magento\CatalogUrlRewrite\Model\ProductUrlRewriteGenerator;
use Magento\CatalogUrlRewrite\Model\Storage\DbStorage;
use Magento\Customer\Api\GroupManagementInterface;
use Magento\Customer\Model\Indexer\CustomerGroupDimensionProvider;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DB\Select;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Indexer\DimensionFactory;
use Magento\Store\Model\Indexer\WebsiteDimensionProvider;
use Magento\Store\Model\Store;
use Magento\Catalog\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;


class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'magebit_faq_question_collection';
    protected $_eventObject = 'question_collection';

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ){
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $connection,
            $resource
        );
    }

    /**
     * Initialize resources
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Magebit\Faq\Model\Question::class, \Magebit\Faq\Model\ResourceModel\Question::class);
    }

}
