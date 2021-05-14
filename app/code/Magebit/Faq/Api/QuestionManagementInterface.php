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

namespace Magebit\Faq\Api;


/**
 * Interface QuestionManagementInterface
 * @package Magebit\Faq\Api
 */
interface QuestionManagementInterface
{

    /**
     * Enable Question
     *
     * @param \Magebit\Faq\Model\Question $question
     * @return void
     */
    public function enableQuestion(\Magebit\Faq\Model\Question $question): void;


    /**
     * Disable Question
     *
     * @param \Magebit\Faq\Model\Question $question
     * @return void
     */
    public function disableQuestion(\Magebit\Faq\Model\Question $question): void;

}
