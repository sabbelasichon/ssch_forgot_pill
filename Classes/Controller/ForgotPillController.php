<?php

namespace Ssch\SschForgotPill\Controller;

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
use Ssch\SschForgotPill\Domain\Repository\ForgotPillRepository;
use Ssch\SschForgotPill\Enumeration\WeekEnumeration;

class ForgotPillController extends AbstractMultistepForgotPillController
{
    /**
     * forgotPillRepository.
     *
     * @var ForgotPillRepository
     */
    protected $forgotPillRepository;


    /**
     * @param ForgotPillRepository $forgotPillRepository
     */
    public function injectForgotPillRepository(ForgotPillRepository $forgotPillRepository)
    {
        $this->forgotPillRepository = $forgotPillRepository;
    }

    /**
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function initializeAction()
    {
        // Get all the request arguments
        $requestArguments = $this->request->getArguments();
        if (isset($requestArguments['back'], $requestArguments['backaction'])) {
            $this->redirect($requestArguments['backaction']);
        }


        parent::initializeAction();
    }

    /**
     * Index action.
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function indexAction()
    {
        if (isset($this->settings['firstAction'])) {
            $this->forward($this->settings['firstAction']);
        }

        if ($this->settings['jumpDirectlyToIntro']) {
            $this->forward('intro');
        }
        $this->view->assign('firstActionMethodName', $this->firstActionMethodName);
    }

    /**
     * Teaser action.
     */
    public function teaserAction()
    {
    }

    /**
     * Intro action.
     */
    public function introAction()
    {
    }

    /**
     * @param ForgotPill $newForgotPill
     */
    public function step1Action(ForgotPill $newForgotPill = null)
    {
        // Due to a small bug in some form viewhelpers of fluid, we provide a fresh instance
        if (null === $newForgotPill) {
            /** @var ForgotPill $newForgotPill */
            $newForgotPill = $this->objectManager->get(ForgotPill::class);
        }
        $this->view->assign('newForgotPill', $newForgotPill);
    }

    /**
     * @param ForgotPill $newForgotPill
     * @validate $newForgotPill \Ssch\SschForgotPill\Domain\Validator\Step1ControllerValidator
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function step2Action(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }

        if (!$newForgotPill->getIsProtectedByTimes()) {
            $this->redirect('resultNoProtection');
        }

        $this->view->assign('newForgotPill', $newForgotPill);

    }

    /**
     * @param ForgotPill $newForgotPill
     * @validate $newForgotPill \Ssch\SschForgotPill\Domain\Validator\Step2ControllerValidator
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function step3Action(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }

        if ($newForgotPill->getIsProtected()) {
            $this->redirect('resultProtection');
        }

        $this->view->assign('newForgotPill', $newForgotPill);
    }

    /**
     * @param ForgotPill $newForgotPill
     * @validate $newForgotPill \Ssch\SschForgotPill\Domain\Validator\Step3ControllerValidator
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function step4Action(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }

        switch ($newForgotPill->getWhichWeek()) {
            case WeekEnumeration::FIRST_WEEK:
                $this->redirect('step4ForOneWeek');
                break;
            case WeekEnumeration::SECOND_WEEK:
                $this->redirect('step4ForTwoWeeks');
                break;
            case WeekEnumeration::THIRD_WEEK:
                $this->redirect('step4ForThreeWeeks');
                break;
            default:
                $this->redirectToFirstActionMethod();
                break;
        }
        $this->view->assign('newForgotPill', $newForgotPill);

    }

    /**
     * @param ForgotPill $newForgotPill
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function step4ForOneWeekAction(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }

        $this->view->assign('newForgotPill', $newForgotPill);

    }

    /**
     * @param ForgotPill $newForgotPill
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function step4ForTwoWeeksAction(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }
        $this->view->assign('newForgotPill', $newForgotPill);
    }

    /**
     * @param ForgotPill $newForgotPill
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function step4ForThreeWeeksAction(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }
        $this->view->assign('newForgotPill', $newForgotPill);
    }

    /**
     * @param ForgotPill $newForgotPill
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function resultNoProtectionAction(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }

        $this->postProcessingAction($newForgotPill);
    }

    /**
     * @param ForgotPill $newForgotPill
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function resultProtectionAction(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }
        $this->postProcessingAction($newForgotPill);
    }

    /**
     * @param ForgotPill $newForgotPill
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function resultForOneWeekWithoutSexAction(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }
        $this->postProcessingAction($newForgotPill);
    }

    /**
     * @param ForgotPill $newForgotPill
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function resultNoProtectionForOneWeekAction(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }
        $this->postProcessingAction($newForgotPill);
    }

    /**
     * @param ForgotPill $newForgotPill
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function resultForTwoWeeksAction(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }
        $this->postProcessingAction($newForgotPill);
    }

    /**
     * @param ForgotPill $newForgotPill
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function resultForThreeWeeksAction(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }

        $this->postProcessingAction($newForgotPill);
    }

    /**
     * @param ForgotPill $newForgotPill
     * @validate $newForgotPill \Ssch\SschForgotPill\Domain\Validator\Step4ControllerValidator
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     */
    public function resultAction(ForgotPill $newForgotPill = null)
    {
        if (null === $newForgotPill) {
            $this->redirectToFirstActionMethod();
        }

        try {
            $redirectAction = '';
            if ($newForgotPill->getWhichWeek() === WeekEnumeration::FIRST_WEEK) {
                $redirectAction = $newForgotPill->getDidYouHaveSex() ? 'resultNoProtectionForOneWeek' : 'resultForOneWeekWithoutSex';
            } elseif ($newForgotPill->getWhichWeek() === WeekEnumeration::SECOND_WEEK) {
                $redirectAction = $newForgotPill->getDidYouTakeThePillCorrectlyInPreviousWeeks() ? 'resultForTwoWeeks' : 'resultNoProtection';
            } elseif ($newForgotPill->getWhichWeek() === WeekEnumeration::THIRD_WEEK) {
                $redirectAction = $newForgotPill->getDidYouTakeThePillCorrectlyInPreviousWeeks() ? 'resultForThreeWeeks' : 'resultNoProtection';
            }
            $this->redirect($redirectAction);
        } catch (\Exception $e) {
            $this->redirectToFirstActionMethod();
        }
    }

    /**
     * Clear the session and save the object in database.
     *
     * @param ForgotPill $newForgotPill
     *
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    protected function postProcessingAction(ForgotPill $newForgotPill = null)
    {
        $this->forgotPillRepository->add($newForgotPill);
        parent::clearSessionData();
    }
}
