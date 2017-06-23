<?php

namespace ESERV\MAIN\MediaBundle\Components\pChartBundle\Services;

use ESERV\MAIN\MediaBundle\Components\pChartBundle\PChart\pData;
use ESERV\MAIN\MediaBundle\Components\pChartBundle\PChart\pImage;
use ESERV\MAIN\MediaBundle\Components\pChartBundle\PChart\pDraw;
use ESERV\MAIN\MediaBundle\Components\pChartBundle\PChart\pPie;
use ESERV\MAIN\MediaBundle\Components\pChartBundle\PChart\pCache;
use ESERV\MAIN\MediaBundle\Components\pChartBundle\PChart\pStock;
use ESERV\MAIN\MediaBundle\Components\pChartBundle\PChart\pBarcode39;
use ESERV\MAIN\MediaBundle\Components\pChartBundle\PChart\pBarcode128;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PChart extends Controller {

    private $c;

    public function __construct(Container $container = null) {
        $this->c = $container;
    }

    public function Draw3DPieChart($chart_data) {

        /* Create and populate the pData object */
        $MyData = new pData();
        $MyData->addPoints($chart_data['data'], "ScoreA");
        $MyData->setSerieDescription("ScoreA", "Application A");

        /* Define the absissa serie */
        $MyData->addPoints($chart_data['labels'], "Labels");
        $MyData->setAbscissa("Labels");
        
        $chart_width = isset($chart_data['width']) ? $chart_data['width'] : 700;
        $chart_height = isset($chart_data['height']) ? $chart_data['height'] : 210;

        /* Create the pChart object */
        $myPicture = new pImage($chart_width, $chart_height, $MyData, TRUE);

        /* Draw a solid background */
//        $Settings = array("R" => 255, "G" => 100, "B" => 255, "Dash" => 0, "DashR" => 210, "DashG" => 210, "DashB" => 210);
//        $myPicture->drawFilledRectangle(0, 0, $chart_width, $chart_height, $Settings);

        /* Set the default font properties */
        $myPicture->setFontProperties(array(
            "FontName" => __DIR__ . "/../Resources/fonts/verdana.ttf",
            "FontSize" => 8,
            "R" => 80,
            "G" => 80,
            "B" => 80
        ));

        /* Create the pPie object */
        $PieChart = new pPie($myPicture, $MyData);

        $i = 0;
        foreach ($chart_data['colors'] as $key => $value) {
            $PieChart->setSliceColor($i, $this->GetColor($value));
            $i++;
        }

        /* Enable shadow computing */
        $myPicture->setShadow(TRUE, array(
            "X" => 3,
            "Y" => 3,
            "R" => 0,
            "G" => 0,
            "B" => 0,
            "Alpha" => 10
        ));

        /* Draw a splitted pie chart */
        $PieChart->draw3DPie(430, 130, array(
            "DrawLabels" => TRUE,
            "WriteValues" => TRUE,
            "ValuePosition" => PIE_VALUE_INSIDE,
            "ValueR" => 0,
            "ValueG" => 0,
            "ValueB" => 0,
            "Radius" => 100,
            "LabelStacked" => TRUE,
            "DataGapAngle" => 12,
            "DataGapRadius" => 10,
            "Border" => TRUE,
            "Precision" => TRUE
        ));

        /* Write the legend box */
        $myPicture->setFontProperties(array(
            "FontName" => __DIR__ . "/../Resources/fonts/verdana.ttf",
            "FontSize" => 10,
            "R" => 0,
            "G" => 0,
            "B" => 0
        ));

        $PieChart->drawPieLegend(20, 30, array(
            "Style" => LEGEND_NOBORDER,
            "Margin" => 20
        ));
        

        /* Render the picture (choose the best way) */
        #$myPicture->stroke();
        $myPicture->render($chart_data['chart_name']);
    }

    public function GetColor($color) {

        // THIS IS A to apply different colors to pie chart slices 
        // depending on the selected category (i.e Pass, Fail, Merit... etc)
        $color_array = array();
        $chart_colors = $this->c->getParameter('chart_colors');
        
        if (array_key_exists($color, $chart_colors)){
            $color_array = array(
                "R" => $chart_colors[$color]['R'], 
                "G" => $chart_colors[$color]['G'], 
                "B" => $chart_colors[$color]['B'],
                "Alpha" => $chart_colors[$color]['Alpha']);
        } else {
            $color_array = array(
                "R" => $chart_colors['light_grey']['R'], 
                "G" => $chart_colors['light_grey']['G'], 
                "B" => $chart_colors['light_grey']['B'],
                "Alpha" => $chart_colors['light_grey']['Alpha']);
        }
        
        return $color_array;
    }

}
