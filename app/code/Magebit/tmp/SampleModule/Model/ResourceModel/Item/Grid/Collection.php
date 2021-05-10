<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.6.5
 * Time: 08:37
 */

namespace Magebit\SampleModule\Model\ResourceModel\Item\Grid;


use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;


class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    public function __contstruct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = 'mastering_sample_item',
        $resourceModel = 'Magebit\SampleModule\Model\ResourceModel\Item'
    ){
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel
        );
    }
}
