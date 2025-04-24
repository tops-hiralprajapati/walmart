<?php

require_once __DIR__ . '/constants.php';

const API_DATA_FILE = RESOURCE_DIR . '/apis.json';
const COUNTRIES_DATA_FILE = RESOURCE_DIR . '/countries.json';

/**
 * Get the paths to the schemas that match the given filters.
 *
 * @param array|null $categories 
 * @param array|null $countries 
 * @param array|null $apiCodes 
 * @throws InvalidArgumentException 
 * @return array All the schemas that match the given filters.
 *      Associative array, where each subarray is formatted like so:
 *      [
 *          'path' => string,
 *          'category' => string,
 *          'country' => string,
 *          'api' => [
 *              'code' => string,
 *              'name' => string,
 *          ]
 *      ]
 */
function schemas(?array $categories, ?array $countries, ?array $apiCodes): array
{
    $apiData = json_decode(file_get_contents(API_DATA_FILE), true);

    $allCats = array_keys($apiData);
    $cats = null;
    if (is_null($categories) || $categories === []) {
        $cats = $allCats;
    } else {
        $cats = array_intersect($allCats, $categories);
    }

    if (empty($cats)) {
        throw new InvalidArgumentException('No matching categories found.');
    }

    $allCountries = json_decode(file_get_contents(COUNTRIES_DATA_FILE), true);
    $ctrys = null;
    if (is_null($countries) || $countries === []) {
        $ctrys = $allCountries;
    } else {
        $ctrys = array_intersect($allCountries, $countries);
    }

    if (empty($ctrys)) {
        throw new InvalidArgumentException('No matching countries found.');
    }

    $paths = [];
    foreach ($cats as $cat) {
        $apis = null;
        $allCatApis = array_keys($apiData[$cat]['apis']);
        if (is_null($apiCodes) || $apiCodes === []) {
            $apis = $allCatApis;
        } else {
            $apis = array_intersect($allCatApis, $apiCodes);
        }

        if (empty($apis)) {
            echo "No matching API names found in the {$apiData[$cat]['name']} category. Skipping category...\n";
        }

        foreach ($apis as $api) {
            foreach ($ctrys as $ctry) {
                // Not all countries are eligible for all APIs
                if (!in_array($ctry, $apiData[$cat]['apis'][$api]['countries'], true)) {
                    continue;
                }

                $paths[] = [
                    'path' => MODEL_DIR . "/$ctry/$cat/$api.json",
                    'category' => $cat,
                    'country' => $ctry,
                    'api' => [
                        'code' => $api,
                        'name' => $apiData[$cat]['apis'][$api]['name'],
                    ],
                ];
            }
        }
    }

    return $paths;
}

/**
 * Process command line options for commands that can filter schemas by 
 * category, country, or name.
 *
 * @return array Filtered categories, countries, and names. If there are no values
 *               for a given filter, the array will be empty. Format:
 *               ['categories' => [...], 'countries' => [...], 'apiCodes' => [...]]
 */
function handleSchemaOpts(): array
{
    $opts = getopt('', VALID_OPTS);

    if (array_key_exists('help', $opts)) {
        echo "\nUsage: generate-api.php --category=cat1,cat2 --country=ca,mx,us --api-code=code1,code2,code3
        --category: A comma-separated list of the Walmart API categories to generate. If this flag is not passed, all categories will be generated.
            Can be one or more of:
                * cp (Content Provider)
                * mp (Marketplace)apis
                * dsv (Drop Ship Vendor)
                * ws (Warehouse Supplier)
        --country: A comma-separated list of the countries to generate schemas for. If this flag is not passed, all countries will be generated.
            Can be one or more of:
                * ca (Canada)
                * mx (Mexico)
                * us (United States)
        --api-code: A comma-separated list of the schema codes to generate, based on the schema filenames in resources/schemas. If this flag is not passed, all schemas will be generated.\n\n";
        exit(1);
    }

    $categories = [];
    if (array_key_exists('category', $opts)) {
        $categories = is_array($opts['category']) ? $opts['category'] : explode(',', $opts['category']);
    }
    $countries = [];
    if (array_key_exists('country', $opts)) {
        $countries = is_array($opts['country']) ? $opts['country'] : explode(',', $opts['country']);
    }
    $names = [];
    if (array_key_exists('api-code', $opts)) {
        $names = is_array($opts['api-code']) ? $opts['api-code'] : explode(',', $opts['api-code']);
    }

    return [
        'categories' => $categories,
        'countries' => $countries,
        'apiCodes' => $names,
    ];
}

/**
 * Get the current version code for the library.
 *
 * @return string 
 */
function libVersion(): string
{
    $configPath = RESOURCE_DIR . '/generator-config.json';
    $config = json_decode(file_get_contents($configPath), true);
    return $config['artifactVersion'];
}

/**
 * Merge two arrays recursively, overwriting keys in the first array with keys from the second array.
 * Poached from https://www.php.net/manual/en/function.array-merge-recursive.php#92195
 *
 * @param array $array1
 * @param array $array2
 * @return array 
 */
function array_merge_recursive_distinct(array &$array1, array &$array2): array
{
    $merged = $array1;

    foreach ($array2 as $key => &$value) {
        if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
            $merged[$key] = array_merge_recursive_distinct($merged[$key], $value);
        } else {
            $merged [$key] = $value;
        }
    }

    return $merged;
}

/**
 * Remove one or many array items from a given array using "dot" notation.
 * Adapted from Laravel's Illuminate\Support\Arr::forget() method.
 *
 * @param  array  $array
 * @param  array|string|int|float  $keys
 * @return void
 */
function array_forget(&$array, $keys)
{
    $original = &$array;
    $keys = (array) $keys;

    if (count($keys) === 0) {
        return;
    }

    foreach ($keys as $key) {
        // If the exact key exists in the top-level, remove it
        if (array_key_exists($key, $array)) {
            unset($array[$key]);
            continue;
        }

        $parts = explode('.', $key);

        // Clean up before each pass
        $array = &$original;

        while (count($parts) > 1) {
            $part = array_shift($parts);

            if (isset($array[$part]) && is_array($array[$part])) {
                $array = &$array[$part];
            } else {
                continue 2;
            }
        }

        unset($array[array_shift($parts)]);
    }
}