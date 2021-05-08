<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:17
 */

namespace Magebit\Faq\Model;


use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;


use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\EntityManager\HydratorInterface;

use \Magebit\Faq\Api\QuestionRepositoryInterface;
use \Magebit\Faq\Api\Data\QuestionInterface;

/**
 * Class QuestionRepository
 * @package Magebit\Faq\Model
 */
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

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;


    /**
     * QuestionRepository constructor.
     * @param QuestionFactory $questionFactory
     * @param \Magebit\Faq\Api\Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ResourceModel\Question\CollectionFactory $collectionFactory
     * @param ResourceModel\Question $resourceModel
     */
    public function __construct(
        QuestionFactory $questionFactory,
        \Magebit\Faq\Api\Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        ResourceModel\Question\CollectionFactory $collectionFactory,
        ResourceModel\Question $resourceModel
    ){
        $this->questionFactory = $questionFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resourceModel = $resourceModel;
      }

    /**
     * @param string $id
     * @return QuestionInterface|Question
     * @throws NoSuchEntityException
     */
    public function get($id)
    {
        $question = $this->questionFactory->create();
        $this->resourceModel->load($question, $id);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('The Question with the "%1" ID doesn\'t exist.', $id));
        }

        return $question;
    }

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function save(\Magebit\Faq\Api\Data\QuestionInterface $question)
    {
        try {
            $this->resourceModel->save($question);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $question;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magebit\Faq\Api\Data\QuestionSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Magebit\Faq\Model\ResourceModel\Question\Collection $collection */
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var \Magebit\Faq\Api\Data\QuestionSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Question
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Magebit\Faq\Api\Data\QuestionInterface $question)
    {
        try {
            $this->resourceModel->delete($question);
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
