<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:15
 */

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magebit\Faq\Model\Question as QuestionModel;
use \Magebit\Faq\Model\ResourceModel\Question as QuestionResourceModel;


class Collection extends AbstractCollection
{
    /**
     * Initialize resources
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(QuestionModel::class, QuestionResourceModel::class);
        //$this->_map['fields']['id'] = 'main_table.id';
    }

}
