<?php

namespace Ssch\SschForgotPill\Domain\Model;

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

use Ssch\SschForgotPill\Enumeration\HowManyTimesEnumeration;
use Ssch\SschForgotPill\Enumeration\WhenDidYouForgetToTakePillEnumeration;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class ForgotPill extends AbstractEntity
{

    /**
     * Wie oft haben Sie die Pille vergessen?
     *
     * @var int
     */
    protected $howManyTimes;

    /**
     * Wann haben Sie die Pille vergessen?
     *
     * @var int
     */
    protected $whenDidYouForgotToTakeThePill;

    /**
     * In welcher Woche haben Sie die Pille vergessen?
     *
     * @var int
     */
    protected $whichWeek;

    /**
     * Hatten Sie in der Woche Geschlechtsverkehr?
     *
     * @var bool
     */
    protected $didYouHaveSex;

    /**
     * Haben Sie die Pille in den vorherigen Wochen korrekt eingenommen?
     *
     * @var bool
     */
    protected $didYouTakeThePillCorrectlyInPreviousWeeks;

    /**
     * Returns the howManyTimes.
     *
     * @return int
     */
    public function getHowManyTimes()
    {
        return $this->howManyTimes;
    }

    /**
     * Sets the howManyTimes.
     *
     * @param int $howManyTimes
     */
    public function setHowManyTimes($howManyTimes)
    {
        $this->howManyTimes = $howManyTimes;
    }

    /**
     * Returns the whenDidYouForgotToTakeThePill.
     *
     * @return int $whenDidYouForgotToTakeThePill
     */
    public function getWhenDidYouForgotToTakeThePill()
    {
        return $this->whenDidYouForgotToTakeThePill;
    }

    /**
     * Sets the whenDidYouForgotToTakeThePill.
     *
     * @param int $whenDidYouForgotToTakeThePill
     */
    public function setWhenDidYouForgotToTakeThePill($whenDidYouForgotToTakeThePill)
    {
        $this->whenDidYouForgotToTakeThePill = $whenDidYouForgotToTakeThePill;
    }

    /**
     * Returns the whichWeek.
     *
     * @return int $whichWeek
     */
    public function getWhichWeek()
    {
        return (int)$this->whichWeek;
    }

    /**
     * Sets the whichWeek.
     *
     * @param int $whichWeek
     */
    public function setWhichWeek($whichWeek)
    {
        $this->whichWeek = $whichWeek;
    }

    /**
     * Returns the didYouHaveSex.
     *
     * @return bool $didYouHaveSex
     */
    public function getDidYouHaveSex()
    {
        return $this->didYouHaveSex;
    }

    /**
     * Sets the didYouHaveSex.
     *
     * @param bool $didYouHaveSex
     */
    public function setDidYouHaveSex($didYouHaveSex)
    {
        $this->didYouHaveSex = $didYouHaveSex;
    }

    /**
     * Returns the boolean state of didYouHaveSex.
     *
     * @return bool
     */
    public function isDidYouHaveSex()
    {
        return $this->getDidYouHaveSex();
    }

    /**
     * Returns the didYouTakeThePillCorrectlyInPreviousWeeks.
     *
     * @return bool $didYouTakeThePillCorrectlyInPreviousWeeks
     */
    public function getDidYouTakeThePillCorrectlyInPreviousWeeks()
    {
        return $this->didYouTakeThePillCorrectlyInPreviousWeeks;
    }

    /**
     * Sets the didYouTakeThePillCorrectlyInPreviousWeeks.
     *
     * @param bool $didYouTakeThePillCorrectlyInPreviousWeeks
     */
    public function setDidYouTakeThePillCorrectlyInPreviousWeeks($didYouTakeThePillCorrectlyInPreviousWeeks)
    {
        $this->didYouTakeThePillCorrectlyInPreviousWeeks = $didYouTakeThePillCorrectlyInPreviousWeeks;
    }

    /**
     * Returns the boolean state of didYouTakeThePillCorrectlyInPreviousWeeks.
     *
     * @return bool
     */
    public function isDidYouTakeThePillCorrectlyInPreviousWeeks()
    {
        return $this->getDidYouTakeThePillCorrectlyInPreviousWeeks();
    }

    /**
     * @return bool
     */
    public function getIsProtected()
    {
        if ($this->getWhenDidYouForgotToTakeThePill() === WhenDidYouForgetToTakePillEnumeration::LESS_THAN_TWELVE_HOURS_AGO) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getIsProtectedByTimes()
    {
        if ($this->getHowManyTimes() > HowManyTimesEnumeration::ONCE) {
            return false;
        }

        return true;
    }
}
