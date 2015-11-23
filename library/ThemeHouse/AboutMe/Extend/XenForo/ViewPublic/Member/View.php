<?php

/**
 *
 * @see XenForo_ViewPublic_Member_View
 */
class ThemeHouse_AboutMe_Extend_XenForo_ViewPublic_Member_View extends XFCP_ThemeHouse_AboutMe_Extend_XenForo_ViewPublic_Member_View
{

    public function renderHtml()
    {
        parent::renderHtml();

        $userProfileModel = XenForo_Model::create('XenForo_Model_UserProfile');

        $this->_params['user']['about'] = $userProfileModel->getAndMergeAttachmentsIntoAbout($this->_params['user']['about'],
            $this->_params['user']['user_id']);

        if (!empty($this->_params['user']['about']['attachments'])) {
            $bbCodeParser = XenForo_BbCode_Parser::create(
                XenForo_BbCode_Formatter_Base::create('Base', array(
                    'view' => $this
                )));
            $bbCodeOptions = array(
                'states' => array(
                    'viewAttachments' => true
                )
            );

            $this->_params['user']['aboutHtml'] = XenForo_ViewPublic_Helper_Message::getBbCodeWrapper($this->_params['user']['about'], $bbCodeParser,
                $bbCodeOptions);
        }
    } /* END renderHtml */
}