<?php

class SmartyInstance
{
    private $smarty;

    private function __construct() {
        $this->smarty = new Smarty();

        $this->smarty->assign("base", "/" . basename(ROOT_DIR));

        $this->smarty->setTemplateDir(ROOT_DIR . DS . 'theme');
        $this->smarty->setCompileDir(ROOT_DIR . DS . 'theme_compile');
    }

    static public function getInstance() {
        static $instance;

        if($instance === null) {
            $instance = new self();
        }

        return $instance;
    }
    public function __call($func, $args) {
        if(is_callable(array($this->smarty, $func))) return call_user_func_array(array($this->smarty, $func), $args);

        throw new Exception("This and SMARTY Class doesnt have these method: " . $func);
    }

}