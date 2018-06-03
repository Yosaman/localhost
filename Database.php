<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 02.06.2018
 * Time: 23:21
 */

namespace local;

class Database
{
    protected $pdo;
    protected static $instance;

    protected function __construct()
    {
        $db = [
            'dsn' => 'mysql:host=localhost;dbname=shortLink;charset=utf8',
            'user' => 'root',
            'pass' => '',
        ];
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    public static function instance() {
        if (self::$instance == null){
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Делает запрос к базе, возвращает
     * TRUE если удачно
     * FALSE если не удачно
     * подходит для обновления базы данных
     * @param $sql
     * @param $params
     * @return bool
     */
    public function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
//        echo 'hello';
//        debug($sql);
//        echo 'world';
        return $stmt->execute($params);
    }

    /**, $params = []
     * Делает запрос к базе, возвращает массив элементов (или пустой массив)
     * подходит для SELECT
     * @param $sql
     * @param $params
     * @return array
     */
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $res  = $stmt->execute($params);
        if ($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }


}