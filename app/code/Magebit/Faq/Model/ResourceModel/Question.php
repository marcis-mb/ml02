<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:16
 */

namespace Magebit\Faq\Model\ResourceModel;


use \Magento\Framework\EntityManager\EntityManager;
use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\Model\ResourceModel\Db\Context;
use \Magento\Store\Model\StoreManagerInterface;

class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
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
        EntityManager $entityManager
    )
    {
        $this->_storeManager = $storeManager;
        $this->entityManager = $entityManager;
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('magebit_faq', 'id');
    }

//    /**
//     * Get block id.
//     *
//     * @param AbstractModel $object
//     * @param mixed $value
//     * @param string $field
//     * @return bool|int|string
//     * @throws LocalizedException
//     * @throws \Exception
//     */
//    private function getBlockId(AbstractModel $object, $value, $field = null)
//    {
//        $entityMetadata = $this->metadataPool->getMetadata(BlockInterface::class);
//        if (!is_numeric($value) && $field === null) {
//            $field = 'identifier';
//        } elseif (!$field) {
//            $field = $entityMetadata->getIdentifierField();
//        }
//        $entityId = $value;
//        if ($field != $entityMetadata->getIdentifierField() || $object->getStoreId()) {
//            $select = $this->_getLoadSelect($field, $value, $object);
//            $select->reset(Select::COLUMNS)
//                ->columns($this->getMainTable() . '.' . $entityMetadata->getIdentifierField())
//                ->limit(1);
//            $result = $this->getConnection()->fetchCol($select);
//            $entityId = count($result) ? $result[0] : false;
//        }
//        return $entityId;
//    }
//
//    /**
//     * Load an object
//     *
//     * @param /Magento\Framework\Model\AbstractModel $object
//     * @param mixed $value
//     * @param string $field field to load by (defaults to model id)
//     * @return $this
//     */
//    public function load(AbstractModel $object, $value, $field = null)
//    {
//        $blockId = $this->getBlockId($object, $value, $field);
//        if ($blockId) {
//            $this->entityManager->load($object, $blockId);
//        }
//        return $this;
//    }

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
