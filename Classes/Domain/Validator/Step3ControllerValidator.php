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
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Step3ControllerValidator extends AbstractStepsControllerValidator
{
    /**
     * @param ForgotPill $newForgotPill
     */
    public function isValid($newForgotPill)
    {

        parent::isValid($newForgotPill);

        if ( ! GeneralUtility::inList('1,2,3', $newForgotPill->getWhichWeek())) {
            $this->addChooseOptionError();
        }
    }
}
