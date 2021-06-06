<?php

namespace Domain\Service\Logic;

class DateTimeLogic
{
    /**
     * Test whether a source is unixtime.
     *
     * @param string $source
     * @return boolean
     */
    public function isUnixtime(string $source): bool
    {
        if (preg_match('/^\d{10}$/u', $source)) {
            return true;
        }
        return false;
    }

    /**
     * Test whether a source is millisecond.
     *
     * @param mixed $source
     * @return bool
     */
    public function isMillisecond(string $source): bool
    {
        if (preg_match('/^\d{13}$/', $source)) {
            return true;
        }
        return false;
    }

    /**
     * Test whether a source is microtime.
     *
     * @param string $source
     * @return boolean
     */
    public function isMicrotime(string $source): bool
    {
        if (preg_match('/^0\.\d{6,8}\s\d{10}$/', $source)) {
            return true;
        }
        return false;
    }

    /**
     * Test whether a source is microsecond.
     *
     * @param string $source
     * @return boolean
     */
    public function isMicrosecond(string $source): bool
    {
        if (preg_match('/^\d{16}$/', $source)) {
            return true;
        }
        return false;
    }
}
