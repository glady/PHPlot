<?php
# $Id$
# Testing phplot - DrawText font argument changes at phplot-6.0.0
require_once 'phplot.php';
require_once 'config.php'; // For TTF fonts

function my_draw($img, $plot)
{
    $black = imagecolorresolve($img, 0, 0, 0);
    $x = 100;
    $y = 50;
    $dx = 30;
    $plot->DrawText('', 0, $x, $y+=$dx, $black,
                    'Font="" (generic): sans italic 12pt');
    $plot->DrawText('generic', 0, $x, $y+=$dx, $black,
                    'Font="generic": sans italic 12pt');
    $plot->DrawText('legend', 0, $x, $y+=$dx, $black,
                    'Font="legend": serif bold 14pt');
    $plot->DrawText($plot->fonts['title'], 0, $x, $y+=$dx, $black,
                    'Font=fonts["title"]: sans 12pt');
    $plot->DrawText('x_title', 0, $x, $y+=$dx, $black,
                    'Font="x_title": mono bold 10pt');
}

$data = array(array('', 0, 0), array('', 10, 10));
$plot = new PHPlot(800, 600);
$plot->SetTitle("DrawText() Font Argument Test\nTitle is sans 12pt");
$plot->SetDataType('data-data');
$plot->SetDataValues($data);
$plot->SetPlotType('lines');
$plot->SetTTFPath($phplot_test_ttfdir);
$plot->SetFontTTF('title', $phplot_test_ttfonts['sans'], 12);
$plot->SetFontTTF('generic', $phplot_test_ttfonts['sansitalic'], 12);
$plot->SetFontTTF('legend', $phplot_test_ttfonts['serifbold'], 14);
$plot->SetFontTTF('x_title', $phplot_test_ttfonts['monobold'], 10);
$plot->SetCallback('draw_all', 'my_draw', $plot);
$plot->DrawGraph();