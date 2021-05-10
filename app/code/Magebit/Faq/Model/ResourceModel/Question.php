<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:16
 */

namespace Magebit\Faq\Model\ResourceModel;

use \Magebit\Faq\Model\Question as QuestionModel;
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Question
 * @package Magebit\Faq\Model\ResourceModel
 */
class Question extends AbstractDb
{
    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init(QuestionModel::MAIN_TABLE, QuestionModel::ID);
    }
}
