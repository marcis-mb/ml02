<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:16
 */

namespace Magebit\Faq\Model\ResourceModel;


use \Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\Model\ResourceModel\Db\Context;
use \Magento\Store\Model\StoreManagerInterface;

class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        EntityManager $entityManager,
        MetadataPool $metadataPool
    )
    {
        $this->_storeManager = $storeManager;
        $this->entityManager = $entityManager;
        $this->metadataPool = $metadataPool;
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('magebit_faq', 'id');
    }

    /**
     * @inheritDoc
     */
    public function getConnection()
    {
        return $this->metadataPool->getMetadata(\Magebit\Faq\Api\Data\QuestionInterface::class)->getEntityConnection();
    }


    /**
     * Save an object.
     *
     * @param AbstractModel $object
     * @return $this
     * @throws \Exception
     */
    public function save(AbstractModel $object)
    {
        $this->entityManager->save($object);
        return $this;
    }


    public function delete(AbstractModel $object)
    {
        $this->entityManager->delete($object);
        return $this;
    }
}
