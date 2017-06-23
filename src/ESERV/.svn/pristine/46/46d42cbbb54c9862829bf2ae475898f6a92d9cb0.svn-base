<?php

namespace ESERV\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use ESERV\MAIN\Services\DbCoreFunctions;

class StatisticsController extends Controller
{

    public function indexAction(Request $request)
    {
        $total_employers = $this->get('db_core_function_services')->count('ESERVTestBundle:GtcwVEmployer', array());
        $total_workplaces = $this->get('db_core_function_services')->count('ESERVTestBundle:GtcwVWorkplace', array());
        $total_teachers = $this->get('db_core_function_services')->count('ESERVTestBundle:GtcwVTeacher', array());
        $total_establishments = $this->get('db_core_function_services')->count('ESERVTestBundle:GtcwVEstablishment', array());
                
        $stats_array = array(
            'total_employers' => $total_employers,
            'total_workplaces' => $total_workplaces,
            'total_teachers' => $total_teachers,
            'total_establishments' => $total_establishments,
        );
        
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse($stats_array);
        } else {
            return $this->render('ESERVDashboardBundle:Default:index.html.twig', array());
        }
    }

}
