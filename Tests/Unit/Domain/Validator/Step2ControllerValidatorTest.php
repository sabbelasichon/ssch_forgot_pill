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
use Ssch\SschForgotPill\Domain\Model\ForgotPill;
use Ssch\SschForgotPill\Domain\Validator\Step2ControllerValidator;

class Step2ControllerValidatorTest extends UnitTestCase
{

    /**
     * @var Step2ControllerValidator
     */
    protected $subject;


    protected function setUp()
    {
        $this->subject = $this->getMockBuilder(Step2ControllerValidator::class)->setMethods(['translateErrorMessage'])->getMock();
    }

    /**
     * @test
     * @dataProvider validValues
     */
    public function isValid($value)
    {
        $newForgotPill = new ForgotPill();
        $newForgotPill->setWhenDidYouForgotToTakeThePill($value);
        $this->assertFalse($this->subject->validate($newForgotPill)->hasErrors());
    }

    /**
     * @return array
     */
    public function validValues()
    {
        return [
            [1],
            [2],
        ];
    }

    /**
     * @test
     * @dataProvider inValidValues
     */
    public function isNotValid($value)
    {
        $newForgotPill = new ForgotPill();
        $newForgotPill->setWhenDidYouForgotToTakeThePill($value);
        $this->assertTrue($this->subject->validate($newForgotPill)->hasErrors());
    }

    /**
     * @return array
     */
    public function inValidValues()
    {
        return [
            [''],
            [0],
            [999],
            [false],
            [null],
        ];
    }

}
