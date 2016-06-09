<?php

/**
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 */
class guidelines implements IController
{

    public function Run()
    {
        Application::$smarty->assign('contentfile', 'guidelines.tpl');
    }
}