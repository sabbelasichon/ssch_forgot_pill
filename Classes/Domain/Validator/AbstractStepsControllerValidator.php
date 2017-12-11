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
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

abstract class AbstractStepsControllerValidator extends AbstractValidator
{

    /**
     * @var string
     */
    const EXT_KEY = 'ssch_forgot_pill';

    /**
     * @param ForgotPill $newForgotPill
     */
    public function isValid($newForgotPill)
    {
        if ( ! $newForgotPill instanceof ForgotPill) {
            $this->addError($this->translateErrorMessage('error.tx_sschforgotpill_domain_model_forgotpill.invalid_model_type',
                self::EXT_KEY), 1512993323);
        }
    }

    /**
     * Add the default error for all validation classes
     */
    protected function addChooseOptionError()
    {
        $this->addError($this->translateErrorMessage('error.tx_sschforgotpill_domain_model_forgotpill.is_empty',
            self::EXT_KEY), 1512993324);
    }
}
