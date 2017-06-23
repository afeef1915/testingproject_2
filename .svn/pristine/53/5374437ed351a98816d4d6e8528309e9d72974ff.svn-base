<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    public function registerBundles() {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new \FOS\UserBundle\FOSUserBundle(),
            new Security\UserBundle\SecurityUserBundle(),
            new ESERV\MAIN\ErrorHandlingBundle\ESERVMAINErrorHandlingBundle(),
            new ESERV\MAIN\HelpersBundle\ESERVMAINHelpersBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new ESERV\MAIN\SecurityBundle\ESERVMAINSecurityBundle(),            
            new ESERV\MAIN\CommunicationsBundle\ESERVMAINCommunicationsBundle(),
            new WEBLOGS\DashboardBundle\WEBLOGSDashboardBundle(),
            new ESERV\HomeBundle\ESERVHomeBundle(),
            new WEBLOGS\HomeBundle\WEBLOGSHomeBundle(),
            new WEBLOGS\CORE\MAIN\ProfileBundle\WEBLOGSCOREMAINProfileBundle(),
            new WEBLOGS\CORE\MAIN\MediaBundle\WEBLOGSCOREMAINMediaBundle(),
            
            
##############################   PLEASE ENABLE FOLLOWING BUNDLES ONLY WHEN YOU NEED IT  ##############################

//            new Security\SessionBundle\SecuritySessionBundle(),
//            new ESERV\MAIN\ActivityBundle\ESERVMAINActivityBundle(),
//            new ESERV\MAIN\ApplicationCodeBundle\ESERVMAINApplicationCodeBundle(),
//            new ESERV\MAIN\ContactBundle\ESERVMAINContactBundle(),
           new ESERV\MAIN\MediaBundle\ESERVMAINMediaBundle(),
              new ESERV\MAIN\ProfileBundle\ESERVMAINProfileBundle(),
              new ESERV\MAIN\SystemConfigBundle\ESERVMAINSystemConfigBundle(),
//            new ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\ESERVMAINContactBundleComponentsContactDetailsBundle(),
//            new ESERV\HelpBundle\ESERVHelpBundle(),
//            new ESERV\DashboardBundle\ESERVDashboardBundle(),
//            new ESERV\MAIN\WizardBundle\ESERVMAINWizardBundle(),
//            new ESERV\MAIN\ProductBundle\ESERVMAINProductBundle(),
//            new ESERV\MAIN\HistoryBundle\ESERVMAINHistoryBundle(),
            new ESERV\MAIN\ExternalBundle\ESERVMAINExternalBundle(),
//            new ESERV\MAIN\MediaBundle\Components\pChartBundle\ESERVMAINMediaBundleComponentspChartBundle(),
//            new ESERV\MAIN\SoapBundle\ESERVMAINSoapBundle(),
//            new ESERV\TestBundle\ESERVTestBundle(),
//            new ESERV\ConsoleCommandBundle\ESERVConsoleCommandBundle(),
//            new ESERV\MAIN\TemplateBundle\ESERVMAINTemplateBundle(),
//            new ESERV\ClientBundle\ESERVClientBundle(),
//            new ESERV\MAIN\AdministrationBundle\ESERVMAINAdministrationBundle(),
//            new ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\ESERVMAINAdministrationBundleComponentsClientAdministrationBundle(),
//            new ESERV\MAIN\MembershipBundle\ESERVMAINMembershipBundle(),
//            new ESERV\MAIN\QualificationBundle\ESERVMAINQualificationBundle(),
//            new ESERV\ReleaseBundle\ESERVReleaseBundle(),

//            new WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\WEBLOGSMAINMTLCodeMaintainanceBundle(),
//            new WEBLOGS\MAIN\MTL\MyLogsBundle\WEBLOGSMAINMTLMyLogsBundle(),
//            new WEBLOGS\MAIN\MTL\ShowUsersBundle\WEBLOGSMAINMTLShowUsersBundle(),
//            new WEBLOGS\MAIN\MTL\DashboardBundle\WEBLOGSMAINMTLDashboardBundle(),

            new WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\WEBLOGSMAINMTLCodeMaintainanceBundle(),
            new WEBLOGS\MAIN\MTL\MyLogsBundle\WEBLOGSMAINMTLMyLogsBundle(),
            new WEBLOGS\MAIN\MTL\ShowUsersBundle\WEBLOGSMAINMTLShowUsersBundle(),
            new WEBLOGS\MAIN\MTL\DashboardBundle\WEBLOGSMAINMTLDashboardBundle(),
            new WEBLOGS\MAIN\MTL\MyemailBundle\WEBLOGSMAINMTLMyemailBundle(),
            new WEBLOGS\MAIN\COMMON\CommonBundle\WEBLOGSMAINCOMMONCommonBundle(),

            new WEBLOGS\MAIN\MTL\MylogsassignBundle\WEBLOGSMAINMTLMylogsassignBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test', 'mtl', 'weblogs_dev'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
