<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:04
 */

namespace Magebit\Faq\Api\Data;


interface QuestionSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get questions list.
     *
     * @return \Magebit\Faq\Api\Data\QuestionInterface[]
     */
    public function getItems();

    /**
     * Set questions list.
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface[] $questions
     * @return $this
     */
    public function setItems(array $questions);
}
