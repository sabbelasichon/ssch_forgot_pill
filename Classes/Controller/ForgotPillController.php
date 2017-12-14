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

        if ( ! $newForgotPill->getIsProtectedByTimes()) {
            $this->redirect('result');
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
            $this->redirect('result');
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

        $this->view->assignMultiple(['newForgotPill', $newForgotPill, 'partialName' => $newForgotPill->getStep4PartialName()]);

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
            $this->view->assignMultiple(['newForgotPill' => $newForgotPill, 'partialName' => $newForgotPill->getResultPartialName()]);
            $this->postProcessingAction($newForgotPill);
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
