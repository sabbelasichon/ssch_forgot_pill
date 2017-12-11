<?php


namespace Ssch\SschForgotPill\Hooks;

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

class RealUrlAutoConfiguration
{


    /**
     * Generates additional RealURL configuration and merges it with provided configuration
     *
     * @param array $params Default configuration
     *
     * @return array Updated configuration
     */
    public function addConfig($params)
    {
        return array_merge_recursive($params['config'], [
                'fixedPostVars' => [
                    'pille' => [
                        [
                            'GETvar' => 'tx_sschforgotpill_pi1[action]',
                            'valueMap' => [
                                'schritt-1' => 'step1',
                                'schritt-2' => 'step2',
                                'schritt-3' => 'step3',
                                'schritt-4' => 'step4',
                                'intro' => 'intro',
                                'ergebnis' => 'result',
                            ],
                            'noMatch' => 'bypass',
                        ],
                    ],
                ],
            ]
        );
    }

}
