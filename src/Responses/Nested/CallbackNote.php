<?php

namespace Apruvd\V4\Responses\Nested;

/**
 * Class CallbackNote
 * @package Apruvd\V4\Responses\Nested
 */
class CallbackNote extends NestedHydrator {

    /**
     * @var string $author
     */
    public $author = null;

    /**
     * @var \DateTime|string $timestamp
     */
    public $timestamp = null;

    /**
     * @var string $body
     */
    public $body = null;

    /**
     * @var array $links
     */
    public $links = null;

    /**
     * @var string $warning_level
     */
    public $warning_level = null;

}