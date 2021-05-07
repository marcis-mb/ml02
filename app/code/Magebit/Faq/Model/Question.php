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
    IdentityInterface,
    QuestionInterface
{
    const CACHE_TAG = 'magebit_faq_question';

    protected
    $_cacheTag = false;

    protected
    $_eventPrefix = 'magebit_faq_question';

    protected
    $_eventObject = 'question';


    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magebit\Faq\Model\ResourceModel\Question $resource,
        \Magebit\Faq\Model\ResourceModel\Question\Collection $resourceCollection,
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

    protected function _construct()
    {
        $this->_init(Question::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getQuestion()
    {
        // TODO: Implement getQuestion() method.
    }

    public function setQuestion($question)
    {
        // TODO: Implement setQuestion() method.
    }

    public function getAnswer()
    {
        // TODO: Implement getAnswer() method.
    }

    public function setAnswer($answer)
    {
        // TODO: Implement setAnswer() method.
    }

    public function getStatus()
    {
        // TODO: Implement getStatus() method.
    }

    public function setStatus($status)
    {
        // TODO: Implement setStatus() method.
    }

    public function getPosition()
    {
        // TODO: Implement getPosition() method.
    }

    public function setPosition($position)
    {
        // TODO: Implement setPosition() method.
    }

    public function getUpdatedAt()
    {
        // TODO: Implement getUpdatedAt() method.
    }

    public function getCustomAttribute($attributeCode)
    {
        // TODO: Implement getCustomAttribute() method.
    }

    public function setCustomAttribute($attributeCode, $attributeValue)
    {
        // TODO: Implement setCustomAttribute() method.
    }

    public function getCustomAttributes()
    {
        // TODO: Implement getCustomAttributes() method.
    }

    public function setCustomAttributes(array $attributes)
    {
        // TODO: Implement setCustomAttributes() method.
    }


}
