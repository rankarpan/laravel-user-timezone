<?php

namespace TarunMangukiya\TimeZoneConverter;

use Exception;
use DateTime;
use DateTimeZone;
use GeoIP;
use Cookie;

class TimeZoneConverter
{

    //Current User timezone to UTC timezone
    public function convertToUTCzone($datetime, $format = 'Y-m-d H:i:s')
    {
        $userTimezone = Cookie::get('userTimezone');

        if (empty($userTimezone))
        {
            $userTimezone = $this->getUserTimeZone();
        }

        if($datetime && isset($userTimezone))
        {
            $new_datetime = new DateTime($datetime, new DateTimeZone($userTimezone));
            $new_datetime->setTimeZone(new DateTimeZone('UTC'));
            return $new_datetime->format($format);
        }
        else
        {
            throw new Exception('Invalid User TimeZone!');
        }
    }

    //UTC timezone to Current user timezone
    public function convertFromUTCzone($datetime, $format = 'Y-m-d H:i:s')
    {
        $userTimezone = Cookie::get('userTimezone');

        if (empty($userTimezone))
        {
            $userTimezone = $this->getUserTimeZone();
        }

        if($datetime && isset($userTimezone))
        {
            $new_datetime = new DateTime($datetime, new DateTimeZone('UTC'));
            $new_datetime->setTimeZone(new DateTimeZone($userTimezone));
            return $new_datetime->format($format);
        }
        else
        {
            throw new Exception('Invalid User TimeZone!');
        }
    }

    public function getUserTimeZone()
    {
        $ip = $this->getClientIP();

        $location = GeoIP::getLocation($ip);

        $userTimezone = $location['timezone'];

        Cookie::queue('userTimezone', $userTimezone, 2880);

        return $userTimezone;
    }

    // Get Client IP Address
    private function getClientIP()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if (isset($_SERVER['HTTPX_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if (isset($_SERVER['HTTPX_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        }
        else if (isset($_SERVER['HTTPFORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        else if (isset($_SERVER['HTTPFORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        }
        else {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }
        return $ipaddress;
    }

}