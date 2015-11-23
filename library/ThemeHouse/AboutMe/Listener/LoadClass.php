<?php

class ThemeHouse_AboutMe_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_AboutMe' => array(
                'datawriter' => array(
                    'XenForo_DataWriter_User'
                ), /* END 'datawriter' */
                'controller' => array(
                    'XenForo_ControllerPublic_Account'
                ), /* END 'controller' */
                'model' => array(
                    'XenForo_Model_UserProfile'
                ), /* END 'model' */
                'view' => array(
                    'XenForo_ViewPublic_Member_View'
                ), /* END 'view' */
            ), /* END 'ThemeHouse_AboutMe' */
        );
    } /* END _getExtendedClasses */

    public static function loadClassDataWriter($class, array &$extend)
    {
        $loadClassDataWriter = new ThemeHouse_AboutMe_Listener_LoadClass($class, $extend, 'datawriter');
        $extend = $loadClassDataWriter->run();
    } /* END loadClassDataWriter */

    public static function loadClassController($class, array &$extend)
    {
        $loadClassController = new ThemeHouse_AboutMe_Listener_LoadClass($class, $extend, 'controller');
        $extend = $loadClassController->run();
    } /* END loadClassController */

    public static function loadClassModel($class, array &$extend)
    {
        $loadClassModel = new ThemeHouse_AboutMe_Listener_LoadClass($class, $extend, 'model');
        $extend = $loadClassModel->run();
    } /* END loadClassModel */

    public static function loadClassView($class, array &$extend)
    {
        $loadClassView = new ThemeHouse_AboutMe_Listener_LoadClass($class, $extend, 'view');
        $extend = $loadClassView->run();
    } /* END loadClassView */
}