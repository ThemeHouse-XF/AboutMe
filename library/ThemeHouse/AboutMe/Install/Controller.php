<?php

class ThemeHouse_AboutMe_Install_Controller extends ThemeHouse_Install
{

    protected $_resourceManagerUrl = 'http://xenforo.com/community/resources/about-me.2571/';

    protected $_minVersionId = 1020000;

    protected $_minVersionString = '1.2.0';

    protected function _getTableChanges()
    {
        return array(
            'xf_user_profile' => array(
                'about_attach_count' => 'INT(10) NOT NULL DEFAULT 0', /* END 'about_attach_count' */
            ), /* END 'xf_user_profile' */
        );
    } /* END _getTableChanges */

    protected function _getContentTypes()
    {
        return array(
            'about' => array(
                'addon_id' => 'ThemeHouse_AboutMe', /* END 'addon_id' */
                'fields' => array(
                    'attachment_handler_class' => 'ThemeHouse_AboutMe_AttachmentHandler_About', /* END 'attachment_handler_class' */
                ), /* END 'fields' */
            ), /* END 'about' */
        );
    } /* END _getContentTypes */
}