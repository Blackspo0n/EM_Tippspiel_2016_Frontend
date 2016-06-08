<?php

/**
 * This is a dirty smarty hack to eval the template code.
 * It prevents the framework to write files to the local file system
 *
 * @url http://www.smarty.net/forums/viewtopic.php?t=20612#77287
 * Class EvaledFileResource
 */
class EvaledFileResource extends Smarty_Internal_Resource_File {
    public function populate(Smarty_Template_Source $source, Smarty_Internal_Template $_template=null) {
        parent::populate($source, $_template);
        $source->recompiled = true;
    }
}

/**
 * Class SmartyInstance
 *
 * @method void assign(string $tplvar, mixed $obj);
 */
class SmartyInstance
{
    private $smarty;

    private function __construct() {
        $this->smarty = new Smarty();

        $this->smarty->setTemplateDir(ROOT_DIR . DS . 'theme');
        $this->smarty->compile_check = true;
        $this->smarty->force_compile = true;
        $this->smarty->setCompileDir(sys_get_temp_dir());
        $this->smarty->registerResource('file', new EvaledFileResource());

        $this->smarty->assign("base", "/" . basename(ROOT_DIR));

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
