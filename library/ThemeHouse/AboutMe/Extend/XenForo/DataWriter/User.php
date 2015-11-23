<?php

/**
 *
 * @see XenForo_DataWriter_User
 */
class ThemeHouse_AboutMe_Extend_XenForo_DataWriter_User extends XFCP_ThemeHouse_AboutMe_Extend_XenForo_DataWriter_User
{

    /**
     * Holds the temporary hash used to pull attachments and associate them with
     * this message.
     *
     * @var string
     */
    const DATA_ATTACHMENT_HASH = 'attachmentHash';

    protected function _getFields()
    {
        $fields = parent::_getFields();

        $fields['xf_user_profile']['about_attach_count'] = array(
            'type' => self::TYPE_UINT,
            'default' => 0,
            'max' => 65535
        );

        return $fields;
    } /* END _getFields */

    protected function _preSave()
    {
        if (isset($GLOBALS['XenForo_ControllerPublic_Account'])) {
            /* @var $controller XenForo_ControllerPublic_Account */
            $controller = $GLOBALS['XenForo_ControllerPublic_Account'];

            $attachmentHash = $controller->getInput()->filterSingle('attachment_hash', XenForo_Input::STRING);

    		$this->setExtraData(XenForo_DataWriter_ConversationMessage::DATA_ATTACHMENT_HASH, $attachmentHash);
        }

        parent::_preSave();
    } /* END _preSave */

    /**
     * Post-save handling.
     */
    protected function _postSave()
    {
        $attachmentHash = $this->getExtraData(self::DATA_ATTACHMENT_HASH);
        if ($attachmentHash) {
            $this->_associateAboutAttachments($attachmentHash);
        }

        parent::_postSave();
    } /* END _postSave */

    /**
     * Associates attachments with this user's about section.
     *
     * @param string $attachmentHash
     */
    protected function _associateAboutAttachments($attachmentHash)
    {
        $rows = $this->_db->update('xf_attachment',
            array(
                'content_type' => 'about',
                'content_id' => $this->get('user_id'),
                'temp_hash' => '',
                'unassociated' => 0
            ), 'temp_hash = ' . $this->_db->quote($attachmentHash));
        if ($rows) {
            $this->set('about_attach_count', $this->get('about_attach_count') + $rows, '',
                array(
                    'setAfterPreSave' => true
                ));

            $this->_db->update('xf_user_profile',
                array(
                    'about_attach_count' => $this->get('about_attach_count')
                ), 'user_id = ' . $this->_db->quote($this->get('user_id')));
        }
    } /* END _associateAboutAttachments */

    /**
     * Pre-delete handling.
     */
    protected function _preDelete()
    {
        if ($this->get('about_attach_count')) {
            $this->_deleteAboutAttachments();
        }

        parent::_preDelete();
    } /* END _preDelete */

    /**
     * Deletes all attachments associated with this user's about section
     */
    protected function _deleteAboutAttachments()
    {
        $this->getModelFromCache('XenForo_Model_Attachment')->deleteAttachmentsFromContentIds('about',
            array(
                $this->get('user_id')
            ));
    } /* END _deleteAboutAttachments */
}