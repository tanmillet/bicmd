<?php
require_once "BICmd.php";

/**
 * Class BiUser
 */
class BiUser extends BICmd {

    //初始化model可操作属性
    protected $fill_user_auth_model = ['testid', 'user_id'];

    //初始化Class可执行方法
    public $method_maps =
        [
            'superuser' => 'SuperUser',
            'userauth' => 'UserAuth',
        ];

    /**
     * 初始化必要的参数命令
     * BiUser constructor.
     */
    public function __construct()
    {
        parent::__construct();

//       array_map(function ($val) use ($prams) {
//            if (!isset($prams[$val]) ) {
//                die($val . ' : error01');
//            }
//        }, $this->opt_req_commands);


//        echo $prams['cmd'] . PHP_EOL;

        //判断命令是否属于可执行
        if (!isset($this->prams['cmd']) || empty($this->prams['cmd']) || !in_array($this->prams['cmd'], $this->commands)) {
            die('error01');
        }
//        echo $prams['m'] . PHP_EOL;
        if (!isset($this->prams['m']) || empty($this->prams['m']) || !(array_key_exists($this->prams['m'], $this->method_maps) == true)) {
            die('error02');
        }
//        echo $prams['opid'] . PHP_EOL;
        if ($this->prams['cmd'] != ['insert', 'ups']) {
            if (!isset($this->prams['opid']) || empty($this->prams['opid'])) {
                die('error03');
            }
        }
//        echo $prams['attrs'] . PHP_EOL;
        if (!isset($this->prams['attrs']) || empty($this->prams['attrs']) || !strpos($this->prams['attrs'], ':')) {
            die('error04');
        }

        $this->exec_id = $this->prams['opid'];
        $this->exec_command = $this->prams['cmd'];
        $this->exec_attrs = explode('+', $this->prams['attrs']);
        $method = $this->exec_command . $this->method_maps[$this->prams['m']];
        $this->$method();
    }

    /**
     * 更新一条记录
     */
    public function uponeUserAuth()
    {
        $user_id = $this->exec_id;
        if (!is_numeric($user_id)) {
            die($user_id . ' : error6');
        }
        $this->upsUserAuth($user_id);
    }

    /**
     * 更新全部记录
     * @param int $user_id
     */
    public function upsUserAuth($user_id = 0)
    {
        foreach ($this->exec_attrs as $exec_attr) {
            list($key, $val) = explode(':', $exec_attr);
            if (!in_array($key, $this->fill_user_auth_model)) {
                die($key . ' : error05');
            }
            $attrs[$key] = $val;
        }
        $this->mockUserAuthModelUpUserAuth($attrs, $user_id);

        die('exec is ok');
    }


    /**
     * @param array $action_ids
     * @param int $user_id
     */
    private function mockUserAuthModelUpUserAuth($action_ids = [], $user_id = 0)
    {
        print_r($user_id);
        echo PHP_EOL;
        print_r($action_ids);
    }

}

$biuser = new BiUser();