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

use Ssch\SschForgotPill\Session\SessionStorageInterface;
use Ssch\SschForgotPill\Utility\ArrayUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter;

abstract class AbstractMultistepForgotPillController extends ActionController
{
    /**
     * @var SessionStorageInterface
     */
    protected $sessionStorage;

    /**
     * @var array
     */
    protected $sessionData = [];

    /**
     * @var array
     */
    protected $formData = [];

    /**
     * @var string
     */
    protected $sessionDataStorageKey = 'forgotPillSession';

    /**
     * @var string
     */
    protected $formDataKey = 'newForgotPill';

    /**
     * The action methode name of the first action.
     *
     * @var string
     */
    protected $firstActionMethodName = 'introAction';

    /**
     * The action methode name of the last action.
     *
     * @var string
     */
    protected $finalActionMethodName = 'resultAction';

    /**
     * @var bool
     */
    protected $goBack = false;

    /**
     * @param SessionStorageInterface $sessionStorage
     */
    public function injectSessionStorage(SessionStorageInterface $sessionStorage)
    {
        $this->sessionStorage = $sessionStorage;
    }

    /**
     * Setup up some things at the beginning of every action.
     */
    public function initializeAction()
    {
        try {

            // First of all load the session Data
            $this->formData = $this->loadSessionData();

            // Get all the request arguments
            $requestArguments = $this->request->getArguments();

            // Prepare and merge arguments to store in form data
            $this->formData = ArrayUtility::arrayMergeRecursiveOverrule($this->formData, $this->getFormDataFromRequest($requestArguments));

            // Now assign the form Data array to the requestArguments array
            $requestArguments[$this->formDataKey] = $this->formData;
            $this->request->setArguments($requestArguments);

            // Store data in session
            $this->storeSessionData();

            if ($this->arguments->hasArgument($this->formDataKey)) {
                $propertyMappingConfiguration = $this->arguments->getArgument($this->formDataKey)->getPropertyMappingConfiguration();
                $propertyMappingConfiguration->allowAllProperties();
                $propertyMappingConfiguration->setTypeConverterOption(PersistentObjectConverter::class, PersistentObjectConverter::CONFIGURATION_CREATION_ALLOWED, true);
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Returns if this is the first action.
     *
     * @return bool
     */
    protected function isFirstAction()
    {
        return $this->actionMethodName === $this->firstActionMethodName;
    }

    /**
     * Returns if this is the final action.
     *
     * @return bool
     */
    protected function isFinalAction()
    {
        return $this->actionMethodName === $this->finalActionMethodName;
    }

    /**
     * @return array|mixed
     */
    protected function loadSessionData()
    {
        $this->sessionData = $this->sessionStorage->read($this->sessionDataStorageKey);

        if(null === $this->sessionData || empty($this->sessionData[$this->formDataKey])) {
            return [];
        }

        return $this->sessionData[$this->formDataKey];
    }

    /**
     * Store the session data.
     */
    protected function storeSessionData()
    {
        if (!empty($this->formData)) {
            $this->sessionData[$this->formDataKey] = $this->formData;
            $this->sessionStorage->write($this->sessionDataStorageKey, $this->sessionData);
        }
    }

    /**
     * Clear all sesssion data.
     */
    protected function clearSessionData()
    {
        $this->sessionData = [];
        $this->sessionStorage->remove($this->sessionDataStorageKey);
    }

    /**
     * @param array $requestArguments
     *
     * @return array
     */
    protected function getFormDataFromRequest(array $requestArguments = [])
    {
        $formDataFromRequest = [];

        $requestArgumentsForFormData = $requestArguments[$this->formDataKey];
        if (is_array($requestArgumentsForFormData) && !empty($requestArgumentsForFormData)) {
            foreach ($requestArgumentsForFormData as $key => $value) {
                $formDataFromRequest[$key] = $value;
            }
        }

        return $formDataFromRequest;
    }

    /**
     * Redirect to the first action.
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    protected function redirectToFirstActionMethod()
    {
        $this->clearSessionData();
        $this->redirect('intro');
    }
}
