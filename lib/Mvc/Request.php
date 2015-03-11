<?php
/**
 * Класс запроса
 */

namespace PhpBase\Mvc;

/**
 * Класс запроса
 */
class Request
{
    /**
     * @var \PhpBase\SmartArray
     */
    public $get;

    /**
     * @var \PhpBase\SmartArray
     */
    public $post;
    
    /**
     * @var \PhpBase\SmartArray
     */
    public $files;


    /**
     * @var \PhpBase\SmartArray
     */
    public $request;

    /**
     * @var \PhpBase\SmartArray
     */
    public $cookie;


    /**
     * Запрошенный путь
     *
     * @var string
     */
    protected $_path = '';


    /**
     * Конструктор
     */
    public function __construct()
    {
        $this->get = new \PhpBase\SmartArray($_GET);
        $this->post = new \PhpBase\SmartArray($_POST);
        $this->cookie = new \PhpBase\SmartArray($_COOKIE);
        $this->request = new \PhpBase\SmartArray($_REQUEST);
        $this->files = new \PhpBase\SmartArray($_FILES);

        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $qmPos = strpos($uri, '?');

        if ($qmPos !== false) {
            $uri = substr($uri, 0, $qmPos);
        }

        $this->_path = ltrim($uri, '/');
    }


    /**
     * Возвращает путь
     *
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }


    /**
     * POST запрос ?
     *
     * @return bool
     */
    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }


    /**
     * POST запрос ?
     *
     * @return bool
     */
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }


    /**
     * Аякс запрос ?
     *
     * @return bool
     */
    public function isAjax()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }


    /**
     * Возвращает IP адрес
     *
     * @return string
     */
    public function getUserIp()
    {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    }


    /**
     * Возвращает User-Agent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return isset($_SERVER['HTTP_USER_AGENT']) ?
            $_SERVER['HTTP_USER_AGENT'] : '';
    }


    /**
     * Возвращает реферера
     *
     * @return string
     */
    public function getReferer()
    {
        return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    }
}
