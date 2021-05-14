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

namespace Magebit\Faq\Model\Question;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

/**
 * Class DataProvider
 * @package Magebit\Faq\Model\Question
 */
class DataProvider extends ModifierPoolDataProvider
{
    /**
     * @var \Magebit\Faq\Model\ResourceModel\Question\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    private $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $questionCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $questionCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

    }


    /**
     * Get data
     *
     * @return array
     */
    public function getData(): ?array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Magebit\Faq\Model\Question $question */
        foreach ($items as $question) {
            $this->loadedData[$question->getId()] = $question->getData();
        }

        $data = $this->dataPersistor->get('faq_question');
        if (!empty($data)) {
            $question = $this->collection->getNewEmptyItem();
            $question->setData($data);
            $this->loadedData[$question->getId()] = $question->getData();
            $this->dataPersistor->clear('faq_question');
        }
        return $this->loadedData;

    }

}
