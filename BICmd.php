<?php

class BICmd {

    //初始化可以执行操作类型
    protected $commands = ['insert', 'delone', 'upone', 'ups'];

    //初始化可执行方法
    protected $method_maps = [];

    //输入cli命令参数
    protected $longopt = ['help:', 'token:', 'cmd:', 'm:', 'opid:', 'attrs:',];

    //初始化加载存储终端参数
    protected $prams = [];

    //初始化执行命令
    protected $exec_command = null;

    //初始化执行ID
    protected $exec_id = 0;

    //初始化需要更新或者新建Model属性
    protected $exec_attrs = [];

    /**
     * BCmd constructor.
     */
    public function __construct()
    {
        $this->prams = getopt('', $this->longopt);
        if (isset($this->prams['help']) && !empty($this->prams['help'])) {
            die($this->help($this->prams['help']));
        }
        if (!isset($this->prams['token']) || $this->prams['token'] != 'bgn0123') {
            die('errror0000001');
        }
    }

    /**
     * @return string
     */
    public function help()
    {
        return PHP_EOL . $this->getGlissadeLine(4) . ' --help :  表示查询bicmd命令帮助文档' . PHP_EOL . PHP_EOL
            . $this->getGlissadeLine(3) . ' --token :  系统设定可执行令牌' . PHP_EOL . PHP_EOL
            . $this->getGlissadeLine(5) . ' --cmd :  执行系统设定命令' . PHP_EOL . PHP_EOL
            . $this->getGlissadeLine(7) . ' --m :  执行model方法名称' . PHP_EOL . PHP_EOL
            . $this->getGlissadeLine(4) . ' --opid : 执行特定model需要的执行标识' . PHP_EOL . PHP_EOL
            . $this->getGlissadeLine(3) . ' --attrs : 执行model需要的执行参数' . PHP_EOL . PHP_EOL;
    }


    /**
     * @param $count
     * @return string
     */
    protected function getGlissadeLine($count)
    {
        $glissade = '';
        for ($i = 0; $i < $count; $i++) {
            $glissade .= ' ';
        }
        return $glissade;
    }


}