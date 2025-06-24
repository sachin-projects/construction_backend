<?php

if (! function_exists('make_slug')) {
    /**
     * Generate a slug from a given string.
     *
     * @param string $string
     * @return string
     */
    function make_slug($string)
    {
        // Remove any unwanted characters (like non-ASCII characters)
        $slug = preg_replace('/[^a-z0-9\s-]/i', '', $string);

        // Replace spaces with dashes
        $slug = preg_replace('/\s+/', '-', $slug);

        // Convert to lowercase
        $slug = strtolower($slug);

        return $slug;
    }
}
