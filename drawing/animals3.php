<!DOCTYPE html>
<html lang="en-us" ng-app="andybarefoot">
    <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	    <meta name="viewport" content="initial-scale=1.0, width=device-width" />    
	    <title>Andy Barefoot | Data Visualisation</title>
	    <meta charset="utf-8" />
	    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	    <link rel="stylesheet" href="/css/reset.css">
	    <script src="/jscript/d3v4+jetpack.js"></script>
	    <script src="/jscript/graph-scroll.js"></script>
	    <script src="/jscript/analyticstracking.js"></script>
		<style>
			#hiddenSVGs {
				display: none;
			}
			path {
			  fill: none;
			  stroke: #3F80B4;
			  stroke-width: 3;
			}
		</style>
	</head>
    <body>
		<a href="javascript:generateSVG();">NEXT</a>
	   	<div id="displaySVG">
    	</div>
    	<div id="hiddenSVGs">
			<?php echo file_get_contents("elephant2.svg"); ?>
			<?php echo file_get_contents("fox2.svg"); ?>
			<?php echo file_get_contents("kangaroo2.svg"); ?>
			<?php echo file_get_contents("cow2.svg"); ?>
    	</div>


<script>

var nextSVG = 0;

var pathArray = ["m 605.64948,125.70792 c 0,0 -99.54078,100.71185 -188.2772,49.24174 -38.6712,-22.43058 1.08103,-74.38787 -15.93116,-102.104157 -51.63406,-84.12232 -225.75063,-50.74452 -296.89856,0.72414 C 36.473079,122.81133 -20.824851,206.15978 29.955799,345.12314 73.711059,217.51389 163.42188,235.59082 150.8877,341.50244 c -169.412101,-96.8068 171.5025,-242.868497 147.72517,5.7933 19.96922,-63.393 77.89203,-176.49959 131.79402,-94.8627 8.23724,12.4755 -41.45493,30.9999 -73.8626,37.6553 113.63623,-122.60497 60.31426,-123.6243 -14.48287,-112.24214 -99.93171,15.207 -81.99064,-147.860107 66.6212,-149.897557 92.66541,-1.27045 164.67007,177.299127 141.20782,257.070697 -14.48285,49.2417 -74.5341,35.6544 -72.41425,19.5519 4.54647,-34.5349 29.68985,-19.5519 29.68985,-19.5519",
	"m 556.7838,238.51151 c 33.18851,-32.43422 -21.40033,-34.28753 -68.63981,-49.02841 -63.15567,-19.70746 -99.7075,-77.73967 -29.41712,-89.759797 97.69182,-16.70596 56.57136,-42.23992 99.56551,-65.62272 2.26287,64.11408 52.79985,68.639867 65.62272,77.691227 1.13146,19.98853 -42.12989,8.75907 -70.7141,19.3285 C 511.88717,146.39684 479.84686,190.23739 428.55553,285.2771 460.9898,95.197563 252.80738,266.42004 221.88174,289.04855 409.45785,107.27659 77.338484,106.48347 31.047854,240.02009 222.75371,249.68678 288.9165,123.02037 320.6929,133.66603 c 101.82461,34.11316 13.57709,103.3369 6.03432,112.38837 14.55909,13.16742 38.46846,37.71418 38.46846,37.71418",
	"m 430.60822,268.57152 c 35.28547,48.11658 36.38128,-74.70801 28.86995,-104.2525 -12.02916,-47.31457 53.29904,-37.39948 76.18451,-56.93788 123.01658,-105.0249829 -65.9024,-121.475623 64.15535,-14.434943 10.76657,8.861123 25.81546,35.715943 10.42526,41.700993 -14.43494,5.61357 -13.23427,-16.90093 -35.28547,-12.02916 -68.96704,15.23689 -57.68267,140.89456 -274.26426,64.95736 C 257.10485,172.29245 158.74974,404.09982 22.419561,243.71132 174.95257,337.73983 181.16231,198.85697 249.36926,133.04329 c 182.84286,-176.427333 301.53031,89.8175 -5.61358,152.36902 49.72041,76.18457 0,127.50888 0,127.50888",
	"m 490.86327,397.88718 c 79.31002,-84.6368 10.2922,-59.0806 -82.86125,-102.9847 -138.47547,-65.2647 69.24824,-165.7225 60.37034,-47.3493 -3.89945,51.992 -12.5698,109.4941 -52.08425,223.7255 24.93656,-244.0155 -314.80498,-157.0837 -392.999193,-4.735 29.78198,-238.542 159.166773,-342.562 165.722523,-119.2102 2.00636,68.356 49.35986,99.0868 60.3704,113.2915 5.15134,-40.2018 -63.08451,-94.6739 -126.65941,-98.2497 -63.535533,-3.5737 -68.389633,-177.5155 21.30724,-176.3762 308.05321,3.9128 284.83579,-89.766301 333.81253,-93.514801 69.6437,-5.3302 112.16737,53.411601 117.18951,60.370301 51.40196,27.5989 -2.06828,59.4353 -22.49092,37.8795 -45.44346,-3.4739 -169.00709,0.04 -81.67752,-80.4938 50.33707,-46.419401 67.72027,-35.399901 95.88228,-36.695701 23.17764,-1.0665 15.3885,-44.9819 15.3885,-44.9819"
	];



var svgs = d3.selectAll("#hiddenSVGs > svg");

//console.log(svgs);

svgs.each(function(p, j) {
//	console.log(this);
	paths = d3.select(this).selectAll("path");
//	console.log(paths);
});

var displaySVG = d3
	.select("#displaySVG")
	.append("svg")
	.attr('width', '700px')
	.attr('height', '600px')
;

// displaySVG
// 	.append('path')
// 	.attr('d', pathArray[0])
// ;

function generateSVG(){
	paths0 = displaySVG.selectAll("path");
	pathCount1 = svgs.filter(function(d, i) { return i==nextSVG; }).selectAll("path").size();
	paths1 = svgs.filter(function(d, i) { return i==nextSVG; }).selectAll("path");
	console.log(paths0.size());
	console.log(paths1.size());
	var delayTally = 0;
	var speed = 0.5;
	var transitionTime = 1000;
	// if new shape has less paths
	if(paths0.size()>paths1.size()){
		// delete extra lines first
		for(x=paths0.size()-1;x>=0;x--){
			if(x>=paths1.size()){
				// delete path
				console.log("delete path");
				paths0.filter(function(d, i) { return i==x; })
					.attr("stroke-dasharray", function(d,i) {
						return this.getTotalLength()+",0";
					})
					.transition()
					.delay(function(d,i) {
						delay = delayTally;
						delayTally+=this.getTotalLength()/speed;
						return delay;
					})
					.attr("stroke-dasharray", function(d,i) {
						return "0,"+this.getTotalLength();
					})
					.duration(function(d,i) {
						return this.getTotalLength()/speed;
					})
					.remove()
				;
			}else{
				// transform path
				console.log("transform path");
				newD = paths1.filter(function(d, i) { return i==x; }).attr("d");
				paths0.filter(function(d, i) { return i==x; }).transition().duration(transitionTime).delay(function(d,i) {
			          delay = delayTally;
			          delayTally+=transitionTime;
			          return delay;
			        }).attrTween("d", pathTween(newD, 4));
			}
		}
	}else{
		for(x=0;x<paths1.size();x++){
			if(x>=paths0.size()){
				// add new path
				console.log("add new path");
				newD = paths1.filter(function(d, i) { return i==x; }).attr("d");
				displaySVG
					.append('path')
					.attr('d', newD)
					.attr("stroke-dasharray", function(d,i) {
	          			return "0,"+this.getTotalLength();
	        		})
			        .transition()
			        .delay(function(d,i) {
			          delay = delayTally;
			          delayTally+=this.getTotalLength()/speed;
			          return delay;
			        })
			        .attr("stroke-dasharray", function(d,i) {
			          return this.getTotalLength()+",0";
			        })
			        .duration(function(d,i) {
			          return this.getTotalLength()/speed;
			        })
				;
			}else{
				// transform path
				console.log("transform path");
				newD = paths1.filter(function(d, i) { return i==x; }).attr("d");
				paths0.filter(function(d, i) { return i==x; }).transition().duration(transitionTime).delay(function(d,i) {
			          delay = delayTally;
			          delayTally+=transitionTime;
			          return delay;
			        }).attrTween("d", pathTween(newD, 4));
			}
		}
	}
	console.log("---");
	nextSVG++;
	if(nextSVG>=svgs.size())nextSVG=0;




	// displaySVG
	// 	.selectAll("path")
	// 	.each(function (d, i) {
	// 		nextSVG = svgs
	// 			.filter(function(d, j) { return j==2; })
	// 			.selectAll("path")
	// 			.filter(function(d, k) { return k==0; })
	// 		;
	// 		d3.select(this).attr("newD",nextSVG.attr("d"));
	// 	})
	// ;

	// displaySVG
	//  	.selectAll("path")
	//  	.transition()
	//  	.duration(3500)
	//  	.delay(function(d,i){
	//  		console.log(d3.select(this).attr("newD"));
	//  		return 1000;
	//  	})
	//  	.attrTween("d", function(d,i){
	//  		console.log(d3.select(this).attr("newD"));
	//  		return pathTween(d3.select(this).attr("newD"));
	//  	}, 4)
	// ;
}

generateSVG();

// var currentPath = 0;

// var svg = d3.select("body")
//           .append('svg')
//           .attr('width', '700px')
//           .attr('height', '600px');


// var path = svg.append('path')
//   .attr('d', pathArray[0])
// ;

// nextTransition();

// function nextTransition(){
// 	console.log("next transition");
// 	currentPath++;
// 	if(currentPath>=pathArray.length)currentPath=0;
// 	path
// 	  .transition().duration(3500).delay(1000)
// 	  .attrTween("d", pathTween(pathArray[currentPath], 4))
// 	  .on("end", nextTransition)
// 	;
// }

/* =========================================
  path tween function by Mike Bostock 
  https://gist.github.com/mbostock/3916621
==========================================*/
function pathTween(d1, precision) {
  return function() {
    var path0 = this,
        path1 = path0.cloneNode(),
        n0 = path0.getTotalLength(),
        n1 = (path1.setAttribute("d", d1), path1).getTotalLength();
 
    // Uniform sampling of distance based on specified precision.
    var distances = [0], i = 0, dt = precision / Math.max(n0, n1);
    while ((i += dt) < 1) distances.push(i);
    distances.push(1);
 
    // Compute point-interpolators at each distance.
    var points = distances.map(function(t) {
      var p0 = path0.getPointAtLength(t * n0),
          p1 = path1.getPointAtLength(t * n1);
      return d3.interpolate([p0.x, p0.y], [p1.x, p1.y]);
    });
 
    return function(t) {
      return t < 1 ? "M" + points.map(function(p) { return p(t); }).join("L") : d1;
    };
  };
}</script>


  </body>
</html>

