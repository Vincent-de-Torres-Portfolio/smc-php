<?php

namespace Utility\GeneralUtility;


use Classes\Member;
use Classes\Cart;
use Classes\Movie;

use Classes\Ticket;



class GeneralUtility {
    /**
     * Generates a random movie ID.
     *
     * @param int $length The length of the generated movie ID (default is 6).
     * @return string The generated movie ID.
     */
    public static function generateMovieId($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($characters);
        $movieId = '';
        for ($i = 0; $i < $length; $i++) {
            $movieId .= $characters[rand(0, $charLength - 1)];
        }
        return $movieId;
    }

    public static function encapsulateInPreTags($inputString) {
        // Encapsulate the input string within <pre> tags
        return "<pre>" . htmlspecialchars($inputString) . "</pre>";
    }

    /**
     * Generates a hashed member ID using MD5 algorithm.
     *
     * @return string The generated hashed member ID.
     */
    public static function generateMemberId() {
        $randomNumber = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $timestamp = time();
        $memberId = date('YmdHis', $timestamp) . $randomNumber;
        $hashedMemberId = md5($memberId);
        return substr($hashedMemberId, 0, 16);
    }

    /**
     * Gets the current date and time in 'Y-m-d H:i:s' format.
     *
     * @return string The current date and time.
     */
    public static function getCurrentDateTime() {
        return date('Y-m-d H:i:s');
    }
}



