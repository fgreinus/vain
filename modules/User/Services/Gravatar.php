<?php

namespace Modules\User\Services;

class Gravatar
{
    /* do not load any image if none is associated with the email hash,instead return an HTTP 404 (File Not Found) response */
    const DEFAULT_404 = '404';

    /* (mystery-man) a simple, cartoon-style silhouetted outline of a person (does not vary by email hash) */
    const DEFAULT_MAN = 'mm';

    /* a geometric pattern based on an email hash */
    const DEFAULT_IDENTICON = 'identicon';

    /* a generated 'monster' with different colors, faces, etc */
    const DEFAULT_MONSTERID = 'monsterid';

    /* generated faces with differing features and backgrounds */
    const DEFAULT_WAVATAR = 'wavatar';

    /* awesome generated, 8-bit arcade-style pixelated faces */
    const DEFAULT_RETRO = 'retro';

    /* a transparent PNG image */
    const DEFAULT_BLANK = 'blank';

    /**
     * rating levels for avatars.
     */
    const RATING_SAFE = 'g';

    const RATING_RUDE = 'pg';

    const RATING_VIOLANCE = 'r';

    const RATING_ADULT = 'x';

    /**
     * Size in pixels.
     *
     * @var int
     */
    protected $size;

    /**
     * Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ].
     *
     * @var string
     */
    protected $default;

    /**
     * Maximum rating (inclusive) [ g | pg | r | x ].
     *
     * @var string
     */
    protected $rating;

    public function __construct()
    {
        $this->size = 80;
        $this->default = self::DEFAULT_MAN;
        $this->rating = self::RATING_SAFE;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     *
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param string $default
     *
     * @return $this
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param string $rating
     *
     * @return $this
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     *
     * @return string containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($email)
    {
        $hash = md5(strtolower(trim($email)));

        return sprintf('http://www.gravatar.com/avatar/%s?s=%d&d=%s&r=%s', $hash, $this->getSize(), $this->getDefault(), $this->getRating());
    }
}
