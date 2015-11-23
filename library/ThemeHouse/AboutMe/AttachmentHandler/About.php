<?php

/**
 * Post-specific attachment handler.
 *
 * @package XenForo_Attachment
 */
class ThemeHouse_AboutMe_AttachmentHandler_About extends XenForo_AttachmentHandler_Abstract
{

    protected $_userModel = null;

    protected $_userProfileModel = null;

    /**
     * Key of primary content in content data array.
     *
     * @var string
     */
    protected $_contentIdKey = 'user_id';

    /**
     * Route to get to a user profile
     *
     * @var string
     */
    protected $_contentRoute = 'members';

    /**
     * Name of the phrase that describes the about content type
     *
     * @var string
     */
    protected $_contentTypePhraseKey = 'about';

    /**
     * Determines if attachments and be uploaded and managed in this context.
     *
     * @see XenForo_AttachmentHandler_Abstract::_canUploadAndManageAttachments()
     */
    protected function _canUploadAndManageAttachments(array $contentData, array $viewingUser)
    {
        return true;

        if (!empty($contentData['user_id'])) {
            if ($contentData['user_id'] == $viewingUser['user_id']) {
                return true;
            }
        }

        return false;
    } /* END _canUploadAndManageAttachments */

    /**
     * Determines if the specified attachment can be viewed.
     *
     * @see XenForo_AttachmentHandler_Abstract::_canViewAttachment()
     */
    protected function _canViewAttachment(array $attachment, array $viewingUser)
    {
        $userModel = $this->_getUserModel();

        $user = $userModel->getFullUserById($attachment['content_id']);

        $userProfileModel = $this->_getUserProfileModel();

        return $userProfileModel->canViewFullUserProfile($user);
    } /* END _canViewAttachment */

    /**
     * Code to run after deleting an associated attachment.
     *
     * @see XenForo_AttachmentHandler_Abstract::attachmentPostDelete()
     */
    public function attachmentPostDelete(array $attachment, Zend_Db_Adapter_Abstract $db)
    {
        $db->query(
            '
			UPDATE xf_user_profile
			SET about_attach_count = IF(about_attach_count > 0, about_attach_count - 1, 0)
			WHERE user_id = ?
		', $attachment['content_id']);
    } /* END attachmentPostDelete */

    /**
     *
     * @return XenForo_Model_User
     */
    protected function _getUserModel()
    {
        if (!$this->_userModel) {
            $this->_userModel = XenForo_Model::create('XenForo_Model_User');
        }

        return $this->_userModel;
    } /* END _getUserModel */

    /**
     *
     * @return XenForo_Model_UserProfile
     */
    protected function _getUserProfileModel()
    {
        if (!$this->_userProfileModel) {
            $this->_userProfileModel = XenForo_Model::create('XenForo_Model_UserProfile');
        }

        return $this->_userProfileModel;
    } /* END _getUserProfileModel */

    /**
     *
     * @see XenForo_AttachmentHandler_Abstract::_getContentRoute()
     */
    protected function _getContentRoute()
    {
        return 'members';
    } /* END _getContentRoute */
}