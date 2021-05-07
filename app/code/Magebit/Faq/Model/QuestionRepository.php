<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:17
 */

namespace Magebit\Faq\Model;


use Magento\Eav\Model\Entity\Attribute\Exception as AttributeException;
use Magento\Framework\Api\Data\ImageContentInterfaceFactory;
use Magento\Framework\Api\ImageContentValidatorInterface;
use Magento\Framework\Api\ImageProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\DB\Adapter\ConnectionException;
use Magento\Framework\DB\Adapter\DeadlockException;
use Magento\Framework\DB\Adapter\LockWaitException;
use Magento\Framework\EntityManager\Operation\Read\ReadExtensions;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\TemporaryState\CouldNotSaveException as TemporaryCouldNotSaveException;
use Magento\Framework\Exception\ValidatorException;

use \Magebit\Faq\Api\QuestionRepositoryInterface;
use \Magebit\Faq\Api\Data\QuestionInterface;

class QuestionRepository implements QuestionRepositoryInterface
{

    /**
     * @var QuestionFactory
     */
    protected $questionFactory;

    /**
     * @var \Magebit\Faq\Api\Data\QuestionSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var \Magebit\Faq\Model\ResourceModel\Question\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Magebit\Faq\Model\ResourceModel\Question
     */
    protected $resourceModel;

protected $inter;
protected $resource;


    public function __construct(
        QuestionFactory $questionFactory,
        \Magebit\Faq\Api\Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory,
        \Magebit\Faq\Model\ResourceModel\Question\CollectionFactory $collectionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magebit\Faq\Model\ResourceModel\Question $resourceModel,
        \Magento\Cms\Api\Data\BlockInterface $inter,
        \Magento\Cms\Model\ResourceModel\Block $resource
    ){
        $this->questionFactory = $questionFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resourceModel = $resourceModel;

        $this->resource = $resource;
        $this->inter = $inter;
    }

    public function get($id, $editMode = false, $storeId = null, $forceReload = false)
    {
        $question = $this->questionFactory->create();
        $this->resourceModel->load($question, $id);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('The Question with the "%1" ID doesn\'t exist.', $id));
        }

        return $question;
    }

    public function save(\Magebit\Faq\Api\Data\QuestionInterface $question, $saveOptions = false)
    {
//        if (empty($block->getStoreId())) {
//            $block->setStoreId($this->storeManager->getStore()->getId());
//        }
//
//        if ($block->getId() && $block instanceof Block && !$block->getOrigData()) {
//            $block = $this->hydrator->hydrate($this->getById($block->getId()), $this->hydrator->extract($block));
//        }
//
//        try {
//            $this->resource->save($block);
//        } catch (\Exception $exception) {
//            throw new CouldNotSaveException(__($exception->getMessage()));
//        }
//        return $block;
        return $question;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
//        /** @var \Magento\Cms\Model\ResourceModel\Block\Collection $collection */
//        $collection = $this->blockCollectionFactory->create();
//
//        $this->collectionProcessor->process($criteria, $collection);
//
//        /** @var Data\BlockSearchResultsInterface $searchResults */
//        $searchResults = $this->searchResultsFactory->create();
//        $searchResults->setSearchCriteria($criteria);
//        $searchResults->setItems($collection->getItems());
//        $searchResults->setTotalCount($collection->getSize());
//        return $searchResults;
    }

    /**
     * Delete Question
     *
     * @param \Magento\Cms\Api\Data\BlockInterface $inter
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Magento\Cms\Api\Data\BlockInterface $inter)
    {
        try {
            $this->resource->delete($inter);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Question by id
     *
     * @param string $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->get($id));
    }

}
