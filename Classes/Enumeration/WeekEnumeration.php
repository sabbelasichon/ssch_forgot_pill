<?php


namespace Ssch\SschForgotPill\Enumeration;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */


use TYPO3\CMS\Core\Type\Enumeration;

class WeekEnumeration extends Enumeration
{

    /**
     * @var string
     */
    const FIRST_WEEK = 1;

    /**
     * @var string
     */
    const SECOND_WEEK = 2;

    /**
     * @var string
     */
    const THIRD_WEEK = 3;

}
