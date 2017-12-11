<?php

namespace Ssch\SschForgotPill\Utility;

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

class ArrayUtility
{

    /**
     * Merges two arrays recursively and "binary safe" (integer keys are overridden as well), overruling similar values in the first array ($firstArray) with the values of the second array ($secondArray)
     * In case of identical keys, ie. keeping the values of the second.
     *
     * @param array $firstArray First array
     * @param array $secondArray Second array, overruling the first array
     * @param boolean $dontAddNewKeys If set, keys that are NOT found in $firstArray (first array) will not be set. Thus only existing value can/will be overruled from second array.
     * @param boolean $emptyValuesOverride If set (which is the default), values from $secondArray will overrule if they are empty (according to PHP's empty() function)
     *
     * @return array Resulting array where $secondArray values has overruled $firstArray values
     * @api
     */
    static public function arrayMergeRecursiveOverrule(
        array $firstArray,
        array $secondArray,
        $dontAddNewKeys = false,
        $emptyValuesOverride = true
    ) {
        foreach ($secondArray as $key => $value) {
            if (array_key_exists($key, $firstArray) && is_array($firstArray[$key])) {
                if (is_array($secondArray[$key])) {
                    $firstArray[$key] = self::arrayMergeRecursiveOverrule($firstArray[$key], $secondArray[$key],
                        $dontAddNewKeys, $emptyValuesOverride);
                } else {
                    $firstArray[$key] = $secondArray[$key];
                }
            } else {
                if ($dontAddNewKeys) {
                    if (array_key_exists($key, $firstArray)) {
                        if ($emptyValuesOverride || ! empty($value)) {
                            $firstArray[$key] = $value;
                        }
                    }
                } else {
                    if ($emptyValuesOverride || ! empty($value)) {
                        $firstArray[$key] = $value;
                    }
                }
            }
        }
        reset($firstArray);

        return $firstArray;
    }

}
