<?php

namespace Ssch\SschForgotPill\Domain\Validator;

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

use Ssch\SschForgotPill\Domain\Model\ForgotPill;
use Ssch\SschForgotPill\Enumeration\WeekEnumeration;

class Step4ControllerValidator extends AbstractStepsControllerValidator
{
    /**
     * @param ForgotPill $newForgotPill
     */
    public function isValid($newForgotPill)
    {

        parent::isValid($newForgotPill);

        $whichWeek = (integer)$newForgotPill->getWhichWeek();

        switch ($whichWeek) {
            case WeekEnumeration::FIRST_WEEK:
                if (null === $newForgotPill->getDidYouHaveSex()) {
                    $this->addChooseOptionError();
                }
                break;
            case WeekEnumeration::SECOND_WEEK:
            case WeekEnumeration::THIRD_WEEK:
                if (null === $newForgotPill->getDidYouTakeThePillCorrectlyInPreviousWeeks()) {
                    $this->addChooseOptionError();
                }
                break;
            default:
                $this->addChooseOptionError();
                break;
        }
    }
}
