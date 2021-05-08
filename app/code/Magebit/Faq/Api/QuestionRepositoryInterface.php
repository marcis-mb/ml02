<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:06
 */

namespace Magebit\Faq\Api;


interface QuestionRepositoryInterface
{
    /**
     * Get question data by id
     *
     * @param int $id
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id);

    /**
     * Create question
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\StateException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(Data\QuestionInterface $question);

    /**
     * Get question list
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magebit\Faq\Api\Data\QuestionSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete question
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return bool Will returned True if deleted
     * @throws \Magento\Framework\Exception\StateException
     */

    public function delete(Data\QuestionInterface $question);
    /**
     * @param int $id
     * @return bool Will returned True if deleted
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException
     */
    public function deleteById($id);


}
