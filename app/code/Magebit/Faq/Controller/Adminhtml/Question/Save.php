<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:11
 */

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Controller\Adminhtml\Product;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Question save controller
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends \Magento\Catalog\Controller\Adminhtml\Product implements HttpPostActionInterface
{
    /**
     * @var Initialization\Helper
     */
    protected $initializationHelper;

    /**
     * @var \Magento\Catalog\Model\Product\Copier
     */
    protected $productCopier;

    /**
     * @var \Magento\Catalog\Model\Product\TypeTransitionManager
     */
    protected $productTypeManager;

    /**
     * @var \Magento\Catalog\Api\CategoryLinkManagementInterface
     */
    protected $categoryLinkManagement;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Magento\Framework\Escaper
     */
    private $escaper;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Save constructor.
     *
     * @param Action\Context $context
     * @param Builder $productBuilder
     * @param Initialization\Helper $initializationHelper
     * @param \Magento\Catalog\Model\Product\Copier $productCopier
     * @param \Magento\Catalog\Model\Product\TypeTransitionManager $productTypeManager
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Escaper $escaper
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagement
     * @param StoreManagerInterface $storeManager
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context,
    Product\Builder $productBuilder,
    Initialization\Helper $initializationHelper,
    \Magento\Catalog\Model\Product\Copier $productCopier,
    \Magento\Catalog\Model\Product\TypeTransitionManager $productTypeManager,
    \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
    \Magento\Framework\Escaper $escaper = null,
    \Psr\Log\LoggerInterface $logger = null,
    \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagement = null,
    \Magento\Store\Model\StoreManagerInterface $storeManager = null
) {
    parent::__construct($context, $productBuilder);
    $this->initializationHelper = $initializationHelper;
    $this->productCopier = $productCopier;
    $this->productTypeManager = $productTypeManager;
    $this->productRepository = $productRepository;
    $this->escaper = $escaper ?: ObjectManager::getInstance()
        ->get(\Magento\Framework\Escaper::class);
    $this->logger = $logger ?: ObjectManager::getInstance()
        ->get(\Psr\Log\LoggerInterface::class);
    $this->categoryLinkManagement = $categoryLinkManagement ?: ObjectManager::getInstance()
        ->get(\Magento\Catalog\Api\CategoryLinkManagementInterface::class);
    $this->storeManager = $storeManager ?: ObjectManager::getInstance()
        ->get(\Magento\Store\Model\StoreManagerInterface::class);
}

    /**
     * Save question action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
{
    $data = $this->getRequest()->getPostValue();
    if ($data) {
        $question = $this->getRequest()->getParam('question');
        $answer = $this->getRequest()->getParam('answer');
        $status = $this->getRequest()->getParam('status',0);
        $position = $this->getRequest()->getParam('position',0);

        try {
            $product = $this->initializationHelper->initialize(
                $this->productBuilder->build($this->getRequest())
            );
            $this->productTypeManager->processProduct($product);
            if (isset($data['product'][$product->getIdFieldName()])) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('The product was unable to be saved. Please try again.')
                );
            }

            $originalSku = $product->getSku();
            $canSaveCustomOptions = $product->getCanSaveCustomOptions();
            $product->save();
            $this->handleImageRemoveError($data, $product->getId());
            $productId = $product->getEntityId();
            $productAttributeSetId = $product->getAttributeSetId();
            $productTypeId = $product->getTypeId();
            $extendedData = $data;
            $extendedData['can_save_custom_options'] = $canSaveCustomOptions;
            $this->copyToStores($extendedData, $productId);
            $this->messageManager->addSuccessMessage(__('You saved the product.'));
            $this->getDataPersistor()->clear('catalog_product');
            if ($product->getSku() != $originalSku) {
                $this->messageManager->addNoticeMessage(
                    __(
                        'SKU for product %1 has been changed to %2.',
                        $this->escaper->escapeHtml($product->getName()),
                        $this->escaper->escapeHtml($product->getSku())
                    )
                );
            }
            $this->_eventManager->dispatch(
                'controller_action_catalog_product_save_entity_after',
                ['controller' => $this, 'product' => $product]
            );

            if ($redirectBack === 'duplicate') {
                $product->unsetData('quantity_and_stock_status');
                $newProduct = $this->productCopier->copy($product);
                $this->checkUniqueAttributes($product);
                $this->messageManager->addSuccessMessage(__('You duplicated the product.'));
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->logger->critical($e);
            $this->messageManager->addExceptionMessage($e);
            $data = isset($product) ? $this->persistMediaData($product, $data) : $data;
            $this->getDataPersistor()->set('catalog_product', $data);
            $redirectBack = $productId ? true : 'new';
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage($e->getMessage());
            $data = isset($product) ? $this->persistMediaData($product, $data) : $data;
            $this->getDataPersistor()->set('catalog_product', $data);
            $redirectBack = $productId ? true : 'new';
        }
    } else {
        $resultRedirect->setPath('catalog/*/', ['store' => $storeId]);
        $this->messageManager->addErrorMessage('No data to save');
        return $resultRedirect;
    }

    if ($redirectBack === 'new') {
        $resultRedirect->setPath(
            'catalog/*/new',
            ['set' => $productAttributeSetId, 'type' => $productTypeId]
        );
    } elseif ($redirectBack === 'duplicate' && isset($newProduct)) {
        $resultRedirect->setPath(
            'catalog/*/edit',
            ['id' => $newProduct->getEntityId(), 'back' => null, '_current' => true]
        );
    } elseif ($redirectBack) {
        $resultRedirect->setPath(
            'catalog/*/edit',
            ['id' => $productId, '_current' => true, 'set' => $productAttributeSetId]
        );
    } else {
        $resultRedirect->setPath('catalog/*/', ['store' => $storeId]);
    }
    return $resultRedirect;
}

    /**
     * Retrieve data persistor
     *
     * @return DataPersistorInterface|mixed
     * @deprecated 101.0.0
     */
    protected function getDataPersistor()
{
    if (null === $this->dataPersistor) {
        $this->dataPersistor = $this->_objectManager->get(DataPersistorInterface::class);
    }

    return $this->dataPersistor;
}

}
{

}
