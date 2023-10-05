<?php

class TokenMiddleware
{
    protected static function setNewToken(string $page, int $expiry) {

        $token = new \stdClass();
        $token->page   = $page;
        $token->expiry = time() + $expiry;
        $token->sessiontoken  = base64_encode(random_bytes(32));
        $token->cookietoken   = md5(base64_encode(random_bytes(32)));
        ob_start();
        setcookie(self::makeCookieName($page), $token->cookietoken, $token->expiry);
        ob_end_flush();
        return $_SESSION['csrftokens'][$page] = $token;
    }

    protected static function getSessionToken(string $page) {

        return !empty($_SESSION['csrftokens'][$page]) ? $_SESSION['csrftokens'][$page] : null;
    }

    protected static function getCookieToken(string $page) : string {

        $value = self::makeCookieName($page);

        return !empty($_COOKIE[$value]) ? $_COOKIE[$value] : '';
    }

    protected static function makeCookieName(string $page) : string {

        if (empty($page)) {
            return '';
        }

        return 'csrftoken-' . substr(md5($page), 0, 10);
    }

    protected static function confirmSessionStarted() : bool {

        if (!isset($_SESSION)) {
            trigger_error('Session has not been started.', E_USER_ERROR);
            return false;
        }

        return true;
    }

    public static function getInputToken(string $page, int $expiry = 1800) {

        self::confirmSessionStarted();

        if (empty($page)) {
            trigger_error('Page is missing.', E_USER_ERROR);
            return false;
        }

        $token = (self::getSessionToken($page) ?? self::setNewToken($page, $expiry));

        return '<input type="hidden" id="csrftoken" name="csrftoken" value="'. $token->sessiontoken .'">';
    }

    public static function verifyToken(string $page, $removeToken = false, $requestToken = null) : bool {

        self::confirmSessionStarted();

        // if the request token has not been passed, check POST
        $requestToken = ($requestToken ?? $_POST['csrftoken'] ?? null);

        if (empty($page)) {
            trigger_error('Page alias is missing', E_USER_WARNING);
            return false;
        }
        else if (empty($requestToken)) {
            trigger_error('Token is missing', E_USER_WARNING);
            return false;
        }

        $token = self::getSessionToken($page);

        // if the time is greater than the expiry form submission window
        if (empty($token) || time() > (int) $token->expiry) {
            self::removeToken($page);
            return false;
        }

        // check the hash matches the Session / Cookie
        $sessionConfirm = hash_equals($token->sessiontoken, $requestToken);
        $cookieConfirm  = hash_equals($token->cookietoken, self::getCookieToken($page));

        // remove the token
        if ($removeToken) {
            self::removeToken($page);
        }

        // both session and cookie match
        if ($sessionConfirm && $cookieConfirm) {
            return true;
        }

        return false;
    }


    public static function removeToken(string $page) : bool {

        self::confirmSessionStarted();

        if (empty($page)) {
            return false;
        }

        unset($_COOKIE[self::makeCookieName($page)], $_SESSION['csrftokens'][$page]);

        return true;
    }

}