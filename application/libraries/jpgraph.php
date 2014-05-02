<?php
class Jpgraph {
    
	function barchart($ydata, $title='Line Chart',$datax)
    {
        
		require_once("jpgraph/jpgraph.php");
        require_once("jpgraph/jpgraph_bar.php");    
		        
		// Create the graph. These two calls are always required
        $graph = new Graph(670,600,"auto",60);
         $graph->theme = null;
		
		$graph->img->SetMargin(65,65,65,200);
		$graph->SetScale("textlin",0,100);
		$graph->xaxis->SetTickLabels($datax);
		$graph->xaxis->SetLabelAngle(90);

        // Setup title
        $graph->title->Set($title);
        
        // Create the linear plot
        $barplot=new BarPlot($ydata);
        $barplot->SetColor("blue");
        
        // Add the plot to the graph
        $graph->Add($barplot);
        
        return $graph; // does PHP5 return a reference automatically?
    }
}