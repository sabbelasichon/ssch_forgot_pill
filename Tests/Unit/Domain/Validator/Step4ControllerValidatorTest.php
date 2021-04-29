<?php


namespace Ssch\SschForgotPill\Tests\Unit\Domain\Validator;


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

use Nimut\TestingFramework\TestCase\UnitTestCase;
use Ssch\SschForgotPill\Domain\Validator\Step4ControllerValidator;
use Ssch\SschForgotPill\Domain\Model\ForgotPill;

class Step4ControllerValidatorTest extends UnitTestCase
{

    protected Step4ControllerValidator $subject;


    protected function setUp()
    {
        $this->subject = $this->getMockBuilder(Step4ControllerValidator::class)->setMethods(['translateErrorMessage'])->getMock();
    }

    /**
     * @test
     */
    public function isValidForFirstWeek()
    {
        $newForgotPill = new ForgotPill();
        $newForgotPill->setWhichWeek(1);
        $newForgotPill->setDidYouHaveSex(1);
        $this->assertFalse($this->subject->validate($newForgotPill)->hasErrors());
    }

    /**
     * @test
     */
    public function isValidForSecondWeek()
    {
        $newForgotPill = new ForgotPill();
        $newForgotPill->setWhichWeek(2);
        $newForgotPill->setDidYouTakeThePillCorrectlyInPreviousWeeks(true);
        $this->assertFalse($this->subject->validate($newForgotPill)->hasErrors());
    }

    /**
     * @test
     */
    public function isValidForThirdWeek()
    {
        $newForgotPill = new ForgotPill();
        $newForgotPill->setWhichWeek(3);
        $newForgotPill->setDidYouTakeThePillCorrectlyInPreviousWeeks(true);
        $this->assertFalse($this->subject->validate($newForgotPill)->hasErrors());
    }

    /**
     * @test
     */
    public function isInValidNoWeekDefined()
    {
        $newForgotPill = new ForgotPill();
        $this->assertTrue($this->subject->validate($newForgotPill)->hasErrors());
    }

    /**
     * @test
     */
    public function isInValidDidYouHaveSexNotDefined()
    {
        $newForgotPill = new ForgotPill();
        $newForgotPill->setWhichWeek(1);
        $this->assertTrue($this->subject->validate($newForgotPill)->hasErrors());
    }

    /**
     * @test
     */
    public function isInValidDidYouTakeThePillCorrectlyInPreviousWeeks()
    {
        $newForgotPill = new ForgotPill();
        $newForgotPill->setWhichWeek(2);
        $this->assertTrue($this->subject->validate($newForgotPill)->hasErrors());
    }

}
