<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 12:11
 */

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Framework\Controller\ResultFactory;

/**
 * Create Question block action.
 */
class NewAction
    extends \Magento\Backend\App\Action
{
    public function execute(){
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
