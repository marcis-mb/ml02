<?php
declare(strict_types=1);
/**
 * This file is part of the Magebit Faq package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit Faq
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2019 Magebit, Ltd. (https://magebit.com/)
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(QuestionModel::MAIN_TABLE, QuestionModel::ID);
    }
}
