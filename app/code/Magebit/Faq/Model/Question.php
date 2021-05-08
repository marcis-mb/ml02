<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:17
 */

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Api\CustomAttributesDataInterface;
use \Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\ProductAttributeMediaGalleryEntryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductLinkRepositoryInterface;
use Magento\Catalog\Model\Product\Attribute\Backend\Media\EntryConverterPool;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\Product\Configuration\Item\Option\OptionInterface;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Pricing\SaleableInterface;


class Question extends AbstractModel implements
    QuestionInterface,
    IdentityInterface
{
    /**
     *
     */
    const CACHE_TAG = 'magebit_faq_question';

    /**
     * @var bool
     */
    protected
    $_cacheTag = false;

    /**
     * @var string
     */
    protected
    $_eventPrefix = 'magebit_faq_question';

    /**
     * @var string
     */
    protected
    $_eventObject = 'question';


    /**
     * Question constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\Question $resource
     * @param ResourceModel\Question\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ResourceModel\Question $resource,
        ResourceModel\Question\Collection $resourceCollection,
        array $data = []
    )
    {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * Construct.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Question::class);
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int|mixed|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @return mixed|null|string
     */
    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * @param string $question
     * @return QuestionInterface|Question
     */
    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * @return mixed|null|string
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @param string $answer
     * @return QuestionInterface|Question
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * @return int|mixed|null
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @param int $status
     * @return QuestionInterface|Question
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @return int|mixed|null
     */
    public function getPosition()
    {
        return $this->getData(self::POSITION);
    }

    /**
     * @param int $position
     * @return QuestionInterface|Question
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * @return mixed|null|string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }


}
