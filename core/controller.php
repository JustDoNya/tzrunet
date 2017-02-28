<?php
class controller
{
    /**
     * Хранит один экземпляр класса Controller
     * @static Controller $_init
     **/
    private static $_init = null;
    /**
     * Хранит экземпляр Базы данных
     * @var $_db
     **/
    private $_db = null;
    /**
     * Функция инициализации конструктора
     * @return controller|GetInit
     **/
    public static function GetInit()
    {
        if(empty(self::$_init))
        {
            self::$_init = new self;
        }
        return self::$_init;
    }
    /**
     * Точка входа
     **/
    public function index()
    {
        mb_internal_encoding("UTF-8");
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-type: aplication/json');
            //echo json_encode($this->$_POST['type']());
            $this->ajax();
            exit;
        }
        $this->module();
    }
    private function module($name = 'main'){
        require('modules/'.$name.'.php');
        include('view/header.php');
        $module = new $name();
        $array = [
            'users' => $module->GetUsers(),
            'qualification' => $module->GetQualification(),
            'city' => $module->GetCity(),
        ];
        $this->inc_tpl($name, $array);
        include('view/footer.php');
    }
    private function ajax($name = 'main'){
        require('modules/'.$name.'.php');
        $module = new $name();
        echo json_encode($module->GetUsers($_POST['city'],$_POST['qualification']));
    }
    private function inc_tpl($tpl, $array) {
        include('view/'.$tpl.'.php');
    }
}
