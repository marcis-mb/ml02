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
     * @param string $id
     * @param bool $editMode
     * @param int|null $storeId
     * @param bool $forceReload
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id, $editMode = false, $storeId = null, $forceReload = false);

    /**
     * Create question
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @param bool $saveOptions
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\StateException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Magebit\Faq\Api\Data\QuestionInterface $question, $saveOptions = false);

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
     * @param \Magento\Cms\Api\Data\BlockInterface $question
     * @return bool Will returned True if deleted
     * @throws \Magento\Framework\Exception\StateException
     */

    //  * @param \Magebit\Faq\Api\Data\QuestionInterface $question
    //public function delete(\Magebit\Faq\Api\Data\QuestionInterface $question);
    public function delete(\Magento\Cms\Api\Data\BlockInterface $question);
    /**
     * @param string $id
     * @return bool Will returned True if deleted
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException
     */
    public function deleteById($id);


}
