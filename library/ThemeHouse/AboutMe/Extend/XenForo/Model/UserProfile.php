<?php

/**
 *
 * @see XenForo_Model_UserProfile
 */
class ThemeHouse_AboutMe_Extend_XenForo_Model_UserProfile extends XFCP_ThemeHouse_AboutMe_Extend_XenForo_Model_UserProfile
{

    /**
     * Determines if a new attachment can be posted in the specified user's
     * about section, with the given permissions.
     * If no permissions are specified, permissions are retrieved from the
     * currently visiting user. This does not check viewing permissions.
     *
     * @param array $user Info about the user posting in
     * @param string $errorPhraseKey Returned phrase key for a specific error
     * @param array|null $viewingUser
     *
     * @return boolean
     */
    public function canUploadAndManageAboutAttachment(array $user = array(), &$errorPhraseKey = '', array $viewingUser = null)
    {
        $this->standardizeViewingUserReference($viewingUser);

        if (!$viewingUser['user_id']) {
            return false;
        }

        if ($viewingUser['user_id'] == $user['user_id']) {
            return XenForo_Visitor::getInstance()->canEditProfile();
        } else {
            return false;
        }

        return false;
    } /* END canUploadAndManageAboutAttachment */

    /**
     * Gets the set of attachment params required to allow uploading.
     *
     * @param array $user
     * @param array $contentData Information about the user, for URL building
     * @param array|null $viewingUser
     * @param string|null $tempHash
     *
     * @return array bool
     */
    public function getAboutAttachmentParams(array $user = array(), array $contentData = array(), array $viewingUser = null,
        $tempHash = null)
    {
        if ($this->canUploadAndManageAboutAttachment($user, $null, $viewingUser)) {
            $existing = is_string($tempHash) && strlen($tempHash) == 32;
            $output = array(
                'hash' => $existing ? $tempHash : md5(uniqid('', true)),
                'content_type' => 'about',
                'content_data' => $contentData
            );
            if ($existing) {
                $attachmentModel = $this->getModelFromCache('XenForo_Model_Attachment');
                $output['attachments'] = $attachmentModel->prepareAttachments(
                    $attachmentModel->getAttachmentsByTempHash($tempHash));
            }

            return $output;
        } else {
            return false;
        }
    } /* END getAboutAttachmentParams */

    /**
     * Gets the attachments that belong to the given about, and merges them in
     * with their parent (in the attachments key).
     * The attachments key will not be set if no attachments are found for the
     * message.
     *
     * @param string $about
     *
     * @return array About, with attachments added if necessary
     */
    public function getAndMergeAttachmentsIntoAbout($about, $userId)
    {
        $attachmentModel = $this->_getAttachmentModel();

        $attachments = $attachmentModel->prepareAttachments(
            $attachmentModel->getAttachmentsByContentId('about', $userId));

        if ($attachments) {
            return array(
                'message' => $about,
                'attachments' => $attachments
            );
        }

        return array(
        	'message' => $about
        );
    } /* END getAndMergeAttachmentsIntoAbout */

    /**
     *
     * @return XenForo_Model_Attachment.
     */
    protected function _getAttachmentModel()
    {
        return $this->getModelFromCache('XenForo_Model_Attachment');
    } /* END _getAttachmentModel */
}