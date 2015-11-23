<?php

class ThemeHouse_AboutMe_Listener_FileHealthCheck
{

    public static function fileHealthCheck(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
    {
        $hashes = array_merge($hashes,
            array(
                'library/ThemeHouse/AboutMe/AttachmentHandler/About.php' => '9195844270b160c498bf81a7da15334a',
                'library/ThemeHouse/AboutMe/Extend/XenForo/ControllerPublic/Account.php' => '4166b9906a563217378c2ffcbc3cca12',
                'library/ThemeHouse/AboutMe/Extend/XenForo/DataWriter/User.php' => '8f8eb7a0598f78dede589b823c0af624',
                'library/ThemeHouse/AboutMe/Extend/XenForo/Model/UserProfile.php' => '20f5dd6577f8e01506a25b5d7baf88d1',
                'library/ThemeHouse/AboutMe/Extend/XenForo/ViewPublic/Member/View.php' => 'e642589bde15ed6574d0bc6d66bb7305',
                'library/ThemeHouse/AboutMe/Install/Controller.php' => '18b98f6dcd90f351931e7c9c170468c0',
                'library/ThemeHouse/AboutMe/Listener/LoadClass.php' => 'c52ddb0f597071f8be94386839336c0b',
                'library/ThemeHouse/Install.php' => '18f1441e00e3742460174ab197bec0b7',
                'library/ThemeHouse/Install/20151109.php' => '2e3f16d685652ea2fa82ba11b69204f4',
                'library/ThemeHouse/Deferred.php' => 'ebab3e432fe2f42520de0e36f7f45d88',
                'library/ThemeHouse/Deferred/20150106.php' => 'a311d9aa6f9a0412eeba878417ba7ede',
                'library/ThemeHouse/Listener/ControllerPreDispatch.php' => 'fdebb2d5347398d3974a6f27eb11a3cd',
                'library/ThemeHouse/Listener/ControllerPreDispatch/20150911.php' => 'f2aadc0bd188ad127e363f417b4d23a9',
                'library/ThemeHouse/Listener/InitDependencies.php' => '8f59aaa8ffe56231c4aa47cf2c65f2b0',
                'library/ThemeHouse/Listener/InitDependencies/20150212.php' => 'f04c9dc8fa289895c06c1bcba5d27293',
                'library/ThemeHouse/Listener/LoadClass.php' => '5cad77e1862641ddc2dd693b1aa68a50',
                'library/ThemeHouse/Listener/LoadClass/20150518.php' => 'f4d0d30ba5e5dc51cda07141c39939e3',
            ));
    }
}