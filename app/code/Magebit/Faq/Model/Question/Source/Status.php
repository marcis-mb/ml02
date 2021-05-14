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

namespace Magebit\Faq\Model\Question\Source;


use Magento\Framework\Data\OptionSourceInterface;
use Magebit\Faq\Model\Question;

/**
 * Class Status
 * @package Magebit\Faq\Model\Question\Source
 */
class Status implements OptionSourceInterface
{
    /**
     * @var \Magebit\Faq\Model\Question
     */
    protected $question;

    /**
     * Constructor
     *
     * @param \Magebit\Faq\Model\Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Get question status options
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $availableOptions = $this->question->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
