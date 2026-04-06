<?php
class CI_Super {
    public $load;
    public $input;
    public $session;
    public $db;
    public $uri_string = '';

    public function bootstrap() {
        $this->load = new CI_Loader($this);
        $this->input = new CI_Input();
        $this->session = new CI_Session();
        $this->db = new CI_DB($GLOBALS['DBCFG']);
        foreach (($GLOBALS['AUTOLOAD']['helper'] ?? []) as $helper) {
            $this->load->helper($helper);
        }
        foreach (($GLOBALS['AUTOLOAD']['model'] ?? []) as $model) {
            $this->load->model($model);
        }
    }

    public function run() {
        [$class, $method, $params] = CI_Router::resolve($_SERVER['REQUEST_URI'] ?? '/');
        $file = APPPATH . 'controllers/' . $class . '.php';
        if (!is_file($file)) show_404();
        require_once APPPATH . 'core/MY_Controller.php';
        require_once $file;
        if (!class_exists($class)) show_404();
        $controller = new $class();
        if (!method_exists($controller, $method)) show_404();
        call_user_func_array([$controller, $method], $params);
    }
}

class CI_Controller {
    public $load;
    public $input;
    public $session;
    public $db;
    public function __construct() {
        $ci = get_instance();
        $this->load = $ci->load;
        $this->input = $ci->input;
        $this->session = $ci->session;
        $this->db = $ci->db;
    }
    public function __get($name) { return get_instance()->$name ?? null; }
}

class CI_Model {
    public $db;
    public function __construct() {
        $this->db = get_instance()->db;
    }
    public function __get($name) { return get_instance()->$name ?? null; }
}

class CI_Loader {
    private $ci;
    public function __construct($ci) { $this->ci = $ci; }
    public function __get($name) { return $this->ci->$name ?? null; }
    public function model($model, $alias = null) {
        $file = APPPATH . 'models/' . $model . '.php';
        if (!is_file($file)) throw new Exception('Model not found: ' . $model);
        require_once $file;
        $obj = new $model();
        $name = $alias ?: $model;
        $this->ci->$name = $obj;
        return $obj;
    }
    public function view($view, $data = []) {
        extract($data, EXTR_SKIP);
        include APPPATH . 'views/' . $view . '.php';
    }
    public function helper($helper) {
        $map = [
            'uco' => APPPATH . 'helpers/uco_helper.php',
            'url' => APPPATH . 'helpers/url_helper.php',
            'form' => APPPATH . 'helpers/form_helper.php',
        ];
        $path = $map[$helper] ?? APPPATH . 'helpers/' . $helper . '_helper.php';
        if (is_file($path)) require_once $path;
    }
}

class CI_Input {
    public function method() { return strtolower($_SERVER['REQUEST_METHOD'] ?? 'get'); }
    public function post($key = null, $xss = false) { return $this->fetch($_POST, $key, $xss); }
    public function get($key = null, $xss = false) { return $this->fetch($_GET, $key, $xss); }
    private function fetch($src, $key, $xss) {
        if ($key === null) return $src;
        $val = $src[$key] ?? null;
        if ($xss && is_string($val)) return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
        return $val;
    }
}

class CI_Session {
    public function userdata($key) { return $_SESSION['userdata'][$key] ?? null; }
    public function set_userdata($key, $val = null) {
        if (is_array($key)) { foreach ($key as $k => $v) $_SESSION['userdata'][$k] = $v; return; }
        $_SESSION['userdata'][$key] = $val;
    }
    public function unset_userdata($key) { unset($_SESSION['userdata'][$key]); }
    public function set_flashdata($key, $val) { $_SESSION['flashdata'][$key] = $val; }
    public function flashdata($key) {
        if (!array_key_exists($key, $_SESSION['flashdata'] ?? [])) return null;
        $val = $_SESSION['flashdata'][$key];
        unset($_SESSION['flashdata'][$key]);
        return $val;
    }
}

class CI_Router {
    public static function resolve($requestUri) {
        $path = parse_url($requestUri, PHP_URL_PATH) ?: '/';
        $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php')), '/');
        if ($scriptDir && $scriptDir !== '/' && substr($path, 0, strlen($scriptDir)) === $scriptDir) {
            $path = substr($path, strlen($scriptDir));
        }
        $path = trim($path, '/');
        $path = $path === 'index.php' ? '' : preg_replace('~^index\.php/?~', '', $path);
        $routes = $GLOBALS['ROUTES'] ?? [];
        $uri = $path;
        if ($uri === '') {
            $target = $routes['default_controller'] ?? 'welcome';
        } else {
            $target = self::mapRoute($uri, $routes) ?? $uri;
        }
        $segments = array_values(array_filter(explode('/', trim($target, '/')), 'strlen'));
        $controller = ucfirst($segments[0] ?? 'Welcome');
        $method = $segments[1] ?? 'index';
        $params = array_slice($segments, 2);
        return [$controller, $method, $params];
    }
    private static function mapRoute($uri, $routes) {
        foreach ($routes as $pattern => $target) {
            if (in_array($pattern, ['default_controller','404_override','translate_uri_dashes'], true)) continue;
            $regex = '#^' . str_replace(['(:any)','(:num)'], ['([^/]+)','([0-9]+)'], $pattern) . '$#';
            if (preg_match($regex, $uri, $m)) {
                array_shift($m);
                foreach ($m as $i => $val) $target = str_replace('$'.($i+1), $val, $target);
                return $target;
            }
        }
        return null;
    }
}

class CI_DB_Result {
    private $stmt;
    public function __construct($stmt) { $this->stmt = $stmt; }
    public function row_array() { $row = $this->stmt->fetch(PDO::FETCH_ASSOC); return $row ?: []; }
    public function result_array() { return $this->stmt->fetchAll(PDO::FETCH_ASSOC); }
    public function row() { $row = $this->stmt->fetch(PDO::FETCH_OBJ); return $row ?: (object)[]; }
}

class CI_DB {
    public $pdo;
    private $where = [];
    private $params = [];
    private $order = '';
    private $lastInsertId = 0;
    private $inTransaction = false;

    public function __construct($cfg) {
        $dsn = 'mysql:host=' . ($cfg['hostname'] ?? 'localhost') . ';dbname=' . ($cfg['database'] ?? '') . ';charset=' . ($cfg['char_set'] ?? 'utf8mb4');
        $this->pdo = new PDO($dsn, $cfg['username'] ?? 'root', $cfg['password'] ?? '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    private function resetQB() { $this->where = []; $this->params = []; $this->order = ''; }
    public function where($key, $val = null) { $this->where[] = "$key = ?"; $this->params[] = $val; return $this; }
    public function order_by($field, $dir = null) {
        if ($dir === null) { $this->order = $field; }
        else { $this->order = $field . ' ' . $dir; }
        return $this;
    }
    public function get($table, $limit = null) {
        $sql = "SELECT * FROM $table";
        if ($this->where) $sql .= ' WHERE ' . implode(' AND ', $this->where);
        if ($this->order) $sql .= ' ORDER BY ' . $this->order;
        if ($limit !== null) $sql .= ' LIMIT ' . (int)$limit;
        $stmt = $this->pdo->prepare($sql); $stmt->execute($this->params);
        $this->resetQB();
        return new CI_DB_Result($stmt);
    }
    public function get_where($table, $where, $limit = null) {
        foreach ($where as $k=>$v) $this->where($k, $v);
        return $this->get($table, $limit);
    }
    public function insert($table, $data) {
        $cols = array_keys($data);
        $sql = "INSERT INTO $table (`" . implode('`,`', $cols) . "`) VALUES (" . implode(',', array_fill(0, count($cols), '?')) . ")";
        $stmt = $this->pdo->prepare($sql);
        $ok = $stmt->execute(array_values($data));
        $this->lastInsertId = (int)$this->pdo->lastInsertId();
        return $ok;
    }
    public function insert_id() { return $this->lastInsertId; }
    public function update($table, $data) {
        $set = []; $vals = [];
        foreach ($data as $k=>$v) { $set[] = "$k = ?"; $vals[] = $v; }
        $sql = "UPDATE $table SET " . implode(',', $set);
        if ($this->where) { $sql .= ' WHERE ' . implode(' AND ', $this->where); $vals = array_merge($vals, $this->params); }
        $stmt = $this->pdo->prepare($sql); $ok = $stmt->execute($vals); $this->resetQB(); return $ok;
    }
    public function delete($table, $where = []) {
        foreach ($where as $k=>$v) $this->where($k, $v);
        $sql = "DELETE FROM $table" . ($this->where ? ' WHERE ' . implode(' AND ', $this->where) : '');
        $stmt = $this->pdo->prepare($sql); $ok = $stmt->execute($this->params); $this->resetQB(); return $ok;
    }
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql); $stmt->execute($params); return new CI_DB_Result($stmt);
    }
    public function count_all($table) {
        return (int)$this->pdo->query("SELECT COUNT(*) FROM $table")->fetchColumn();
    }
    public function count_all_results($table) {
        $sql = "SELECT COUNT(*) FROM $table" . ($this->where ? ' WHERE ' . implode(' AND ', $this->where) : '');
        $stmt = $this->pdo->prepare($sql); $stmt->execute($this->params); $c=(int)$stmt->fetchColumn(); $this->resetQB(); return $c;
    }
    public function trans_begin() { if (!$this->inTransaction) { $this->pdo->beginTransaction(); $this->inTransaction = true; } }
    public function trans_commit() { if ($this->inTransaction) { $this->pdo->commit(); $this->inTransaction = false; } }
    public function trans_rollback() { if ($this->inTransaction) { $this->pdo->rollBack(); $this->inTransaction = false; } }
    public function trans_status() { return true; }
}
