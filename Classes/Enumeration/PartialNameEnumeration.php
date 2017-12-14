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

class PartialNameEnumeration extends Enumeration
{

    const STEP4_ONEWEEK = 'Step4ForOneWeek';
    const STEP4_TWOWEEKS = 'Step4ForTwoWeeks';
    const STEP4_THREEWEEKS = 'Step4ForThreeWeeks';
    const RESULT_NO_PROTECTION = 'ResultNoProtection';
    const RESULT_PROTECTION = 'ResultProtection';
    const RESULT_NO_PROTECTION_FOR_ONE_WEEK = 'ResultNoProtectionForOneWeek';
    const RESULT_NO_ONE_WEEK_WITHOUT_SEX = 'ResultForOneWeekWithoutSex';
    const RESULT_TWO_WEEKS = 'ResultForTwoWeeks';
    const RESULT_THREE_WEEKS = 'ResultForThreeWeeks';


}
