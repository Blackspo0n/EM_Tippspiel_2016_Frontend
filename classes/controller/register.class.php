<?php

/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.05.2016
 * Time: 17:40
 */
class register implements IController
{
    public function __construct()
    {
        
    }

    public function Run()
    {
        if(array_key_exists('account', $_POST)) {
            $this->AccountRegister();
        }
        else {
            $this->RegisterFormular();
        }
        // TODO: Implement Run() method.
    }
    
    public function RegisterFormular(array $formDefaults = null) {
        Application::$smarty->assign('defaults', $formDefaults);
        Application::$smarty->assign('contentfile', 'register.form.tpl');



    }
    
    public function AccountRegister() {
        Application::$smarty->assign('contentfile', 'register.success.tpl');
    }
    
}