<?php

/**
 *
 * @see XenForo_ControllerPublic_Account
 */
class ThemeHouse_AboutMe_Extend_XenForo_ControllerPublic_Account extends XFCP_ThemeHouse_AboutMe_Extend_XenForo_ControllerPublic_Account
{

    /**
     *
     * @see XenForo_ControllerPublic_Account::actionPersonalDetails()
     */
    public function actionPersonalDetails()
    {
        $response = parent::actionPersonalDetails();

        if ($response instanceof XenForo_ControllerResponse_View) {
            $visitor = XenForo_Visitor::getInstance()->toArray();

            $attachmentParams = $this->_getUserProfileModel()->getAboutAttachmentParams($visitor,
                array(
                    'user_id' => $visitor['user_id']
                ));

            $attachmentModel = $this->getModelFromCache('XenForo_Model_Attachment');

            $attachments = $attachmentModel->getAttachmentsByContentId('about', $visitor['user_id']);

            if ($attachmentParams) {
                $aboutAttachmentHash = $this->_input->filterSingle('attachment_hash', XenForo_Input::STRING);

                $newAttachments = $attachmentModel->prepareAttachments(
                    $attachmentModel->getAttachmentsByTempHash($aboutAttachmentHash));

                if ($newAttachments) {
                    $attachments = array_merge($attachments, $newAttachments);
                    $attachmentParams['hash'] = $aboutAttachmentHash;
                }
            }

            $response->subView->params = array_merge($response->subView->params, array(
                'attachmentParams' => $attachmentParams,
                'attachments' => $attachmentModel->prepareAttachments($attachments),
                'attachmentConstraints' => $attachmentModel->getAttachmentConstraints()
            ));
        }

        return $response;
    } /* END actionPersonalDetails */

    /**
     *
     * @see XenForo_ControllerPublic_Account::actionPersonalDetailsSave()
     */
    public function actionPersonalDetailsSave()
    {
        $GLOBALS['XenForo_ControllerPublic_Account'] = $this;

        return parent::actionPersonalDetailsSave();
    } /* END actionPersonalDetailsSave */
}