<?php

declare(strict_types=1);

if (! function_exists('alert')) {
    /**
     * Helper function to send an alert.
     *
     * @param string|null $message
     * @param string      $level
     *
     * @return \Orchid\Platform\Alert\Alert
     */
    function alert($message = null, $level = 'info')
    {
        $notifier = app('alert');

        if (! is_null($message)) {
            return $notifier->message($message, $level);
        }

        return $notifier;
    }
}

if (! function_exists('setting')) {
    /**
     * @param      $key
     * @param null $default
     *
     * @return mixed
     */
    function setting($key, $default = null)
    {
        return \Orchid\Platform\Facades\Setting::get($key, $default);
    }
}

if (! function_exists('generate_form')) {
    /**
     * Generate a ready-made html form for display to the user.
     *
     * @param array       $fields
     * @param             $data
     * @param string|null $language
     * @param string|null $prefix
     * @return string
     * @throws \Orchid\Platform\Exceptions\TypeException
     */
    function generate_form(array $fields, $data = [], string $language = null, string $prefix = null)
    {
        if (is_array($data)) {
            $data = new \Orchid\Platform\Screen\Repository($data);
        }

        return (new \Orchid\Platform\Fields\Builder($fields, $data, $language, $prefix))->generateForm();
    }
}

if (! function_exists('dashboard_domain')) {

    /**
     * @param string $default
     *
     * @return string
     */
    function dashboard_domain($default = 'localhost')
    {
        try {
            return isset(parse_url(config('app.url'))['host']) ? parse_url(config('app.url'))['host'] : $default;
        } catch (\TypeError $exception) {
            return 'localhost';
        }
    }
}

if (! function_exists('is_sort')) {

    /**
     * @param null $property
     * @return string
     */
    function is_sort($property = null)
    {
        $filter = new \Orchid\Platform\Filters\Filter();

        return $filter->isSort($property);
    }
}

if (! function_exists('get_sort')) {

    /**
     * @param null $property
     * @return string
     */
    function get_sort($property)
    {
        $filter = new \Orchid\Platform\Filters\Filter();

        return $filter->getSort($property);
    }
}

if (! function_exists('get_filter')) {

    /**
     * @param null $property
     * @return string
     */
    function get_filter($property)
    {
        $filter = new \Orchid\Platform\Filters\Filter();

        return $filter->getFilter($property);
    }
}

if (! function_exists('revert_sort')) {

    /**
     * @param null $property
     * @return string
     */
    function revert_sort($property)
    {
        $filter = new \Orchid\Platform\Filters\Filter();

        return $filter->revertSort($property);
    }
}