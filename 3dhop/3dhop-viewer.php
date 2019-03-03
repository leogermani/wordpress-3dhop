<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta content="charset=UTF-8"/>
<title>3DHOP - 3D Heritage Online Presenter</title>
<!--STYLESHEET-->
<link type="text/css" rel="stylesheet" href="stylesheet/3dhop.css"/>
<!--SPIDERGL-->
<script type="text/javascript" src="js/spidergl.js"></script>
<!--JQUERY-->
<script type="text/javascript" src="js/jquery.js"></script>
<!--PRESENTER-->
<script type="text/javascript" src="js/presenter.js"></script>
<!--3D MODELS LOADING AND RENDERING-->
<script type="text/javascript" src="js/nexus.js"></script>
<script type="text/javascript" src="js/ply.js"></script>
<!--TRACKBALLS-->
<script type="text/javascript" src="js/trackball_turntable.js"></script>
<script type="text/javascript" src="js/trackball_turntable_pan.js"></script>
<script type="text/javascript" src="js/trackball_pantilt.js"></script>
<script type="text/javascript" src="js/trackball_sphere.js"></script>
<!--UTILITY-->
<script type="text/javascript" src="js/init.js"></script>
</head>
<body style="background-image: none;">
<div id="3dhop" class="tdhop" onmousedown="if (event.preventDefault) event.preventDefault()"><div id="tdhlg"></div>
 <div id="toolbar">
  <img id="home"        title="Home"                   src="skins/light/home.png"/><br/>
<!--ZOOM-->
  <img id="zoomin"      title="Zoom In"                src="skins/light/zoomin.png"/><br/>
  <img id="zoomout"     title="Zoom Out"               src="skins/light/zoomout.png"/><br/>
<!--ZOOM-->
<!--LIGHTING-->
  <img id="lighting_off" title="Enable Lighting"       src="skins/light/lighting_off.png" style="position:absolute; visibility:hidden;"/>
  <img id="lighting"     title="Disable Lighting"      src="skins/light/lighting.png"/><br/>
<!--LIGHTING-->
<!--LIGHT-->
  <img id="light_on"    title="Disable Light Control"  src="skins/light/lightcontrol_on.png" style="position:absolute; visibility:hidden;"/>
  <img id="light"       title="Enable Light Control"   src="skins/light/lightcontrol.png"/><br/>
<!--LIGHT-->
<!--MEASURE-->
  <img id="measure_on"  title="Disable Measure Tool"   src="skins/light/measure_on.png" style="position:absolute; visibility:hidden;"/>
  <img id="measure"     title="Enable Measure Tool"    src="skins/light/measure.png"/><br/>
<!--MEASURE-->
<!--POINT PICKING-->
  <img id="pick_on"     title="Disable PickPoint Mode" src="skins/light/pick_on.png" style="position:absolute; visibility:hidden;"/>
  <img id="pick"        title="Enable PickPoint Mode"  src="skins/light/pick.png"/><br/>
<!--POINT PICKING-->
<!--SECTIONS-->
  <img id="sections_on" title="Disable Plane Sections" src="skins/light/sections_on.png" style="position:absolute; visibility:hidden;"/>
  <img id="sections"    title="Enable Plane Sections"  src="skins/light/sections.png"/><br/>
<!--SECTIONS-->
<!--COLOR-->
  <img id="color_on"    title="Disable Solid Color"    src="skins/light/color_on.png" style="position:absolute; visibility:hidden;"/>
  <img id="color"       title="Enable Solid Color"     src="skins/light/color.png"/><br/>
<!--COLOR-->
<!--CAMERA-->
  <img id="perspective"  title="Perspective Camera"    src="skins/light/perspective.png" style="position:absolute; visibility:hidden;"/>
  <img id="orthographic" title="Orthographic Camera"   src="skins/light/orthographic.png"/><br/>
<!--CAMERA-->
<!--FULLSCREEN-->
  <img id="full_on"     title="Exit Full Screen"       src="skins/light/full_on.png" style="position:absolute; visibility:hidden;"/>
  <img id="full"        title="Full Screen"            src="skins/light/full.png"/>
<!--FULLSCREEN-->
 </div>

<!--MEASURE-->
 <div id="measure-box" class="output-box">Measured length<hr/><span id="measure-output" class="output-text" onmousedown="event.stopPropagation()">0.0</span></div>
<!--MEASURE-->

<!--POINT PICKING-->
 <div id="pickpoint-box" class="output-box">XYZ picked point<hr/><span id="pickpoint-output" class="output-text" onmousedown="event.stopPropagation()">[ 0 , 0 , 0 ]</span></div>
<!--POINT PICKING-->

<!--SECTIONS-->
 <div id="sections-box" class="output-box">
  <table class="output-table" onmousedown="event.stopPropagation()">
	<tr><td>Plane</td><td>Position</td><td>Flip</td></tr>
	<tr>
		<td><img   id="xplane_on"    title="Disable X Axis Section" src="skins/icons/sectionX_on.png" onclick="sectionxSwitch()" style="position:absolute; visibility:hidden; border:1px inset;"/>
			<img   id="xplane"       title="Enable X Axis Section"  src="skins/icons/sectionX.png"  onclick="sectionxSwitch()"/><br/></td>
		<td><input id="xplaneSlider" class="output-input"  type="range"    title="Move X Axis Section Position"/></td>
		<td><input id="xplaneFlip"   class="output-input"  type="checkbox" title="Flip X Axis Section Direction"/></td></tr>
	<tr>
		<td><img   id="yplane_on"    title="Disable Y Axis Section" src="skins/icons/sectionY_on.png" onclick="sectionySwitch()" style="position:absolute; visibility:hidden; border:1px inset;"/>
			<img   id="yplane"       title="Enable Y Axis Section"  src="skins/icons/sectionY.png"  onclick="sectionySwitch()"/><br/></td>
		<td><input id="yplaneSlider" class="output-input"  type="range"    title="Move Y Axis Section Position"/></td>
		<td><input id="yplaneFlip"   class="output-input"  type="checkbox" title="Flip Y Axis Section Direction"/></td></tr>
	<tr>
		<td><img   id="zplane_on"    title="Disable Z Axis Section" src="skins/icons/sectionZ_on.png" onclick="sectionzSwitch()" style="position:absolute; visibility:hidden; border:1px inset;"/>
			<img   id="zplane"       title="Enable Z Axis Section"  src="skins/icons/sectionZ.png"  onclick="sectionzSwitch()"/><br/></td>
		<td><input id="zplaneSlider" class="output-input"  type="range"    title="Move Y Axis Section Position"/></td>
		<td><input id="zplaneFlip"   class="output-input"  type="checkbox" title="Flip Z Axis Section Direction"/></td></tr></table>
  <table class="output-table" onmousedown="event.stopPropagation()" style="text-align:right;">
	<tr>
	 <td>Show planes<input id="showPlane" class="output-input" type="checkbox" title="Show Section Planes" style="bottom:-3px;"/></td>
	 <td>Show edges<input  id="showBorder" class="output-input" type="checkbox" title="Show Section Edges" style="bottom:-3px;"/></td></tr></table>
 </div>
<!--SECTIONS-->

 <canvas id="draw-canvas" style="background-image: url(skins/backgrounds/light.jpg)"/>
</div>
</body>

<script type="text/javascript">
var presenter = null;

function setup3dhop() {
	presenter = new Presenter("draw-canvas");

	presenter.setScene({
		meshes: {
			"mesh_1" : { url: "<?php echo $_GET['model_url']; ?>" }
		},
		modelInstances : {
			"model_1" : { 
				mesh  : "mesh_1",
				color : [0.8, 0.7, 0.75]
			}
		},
		trackball: {
			type : TurntablePanTrackball,
			trackOptions : {
				startPhi: 35.0,
				startTheta: 15.0,
				startDistance: 2.5,
				minMaxPhi: [-180, 180],
				minMaxTheta: [-30.0, 70.0],
				minMaxDist: [0.5, 3.0]
			}
		}
	});

//--MEASURE--
	presenter._onEndMeasurement = onEndMeasure;
//--MEASURE--

//--POINT PICKING--
	presenter._onEndPickingPoint = onEndPick;
//--POINT PICKING--

//--SECTIONS--
	sectiontoolInit();
//--SECTIONS--
}

function actionsToolbar(action) {
	if(action=='home') presenter.resetTrackball();
//--FULLSCREEN--
	else if(action=='full'  || action=='full_on') fullscreenSwitch();
//--FULLSCREEN--
//--ZOOM--
	else if(action=='zoomin') presenter.zoomIn();
	else if(action=='zoomout') presenter.zoomOut();
//--ZOOM--
//--LIGHTING--
	else if(action=='lighting' || action=='lighting_off') { presenter.enableSceneLighting(!presenter.isSceneLightingEnabled()); lightingSwitch(); }
//--LIGHTING--
//--LIGHT--
	else if(action=='light' || action=='light_on') { presenter.enableLightTrackball(!presenter.isLightTrackballEnabled()); lightSwitch(); }
//--LIGHT--
//--CAMERA--
	else if(action=='perspective' || action=='orthographic') { presenter.toggleCameraType(); cameraSwitch(); }
//--CAMERA--
//--COLOR--
	else if(action=='color' || action=='color_on') { presenter.toggleInstanceSolidColor(HOP_ALL, true); colorSwitch(); }
//--COLOR--
//--MEASURE--
	else if(action=='measure' || action=='measure_on') { presenter.enableMeasurementTool(!presenter.isMeasurementToolEnabled()); measureSwitch(); }
//--MEASURE--
//--POINT PICKING--
	else if(action=='pick' || action=='pick_on') { presenter.enablePickpointMode(!presenter.isPickpointModeEnabled()); pickpointSwitch(); }
//--POINT PICKING--
//--SECTIONS--
	else if(action=='sections' || action=='sections_on') { sectiontoolReset(); sectiontoolSwitch(); }
//--SECTIONS--
}

//--MEASURE--
function onEndMeasure(measure) {
	// measure.toFixed(2) sets the number of decimals when displaying the measure
	// depending on the model measure units, use "mm","m","km" or whatever you have
	$('#measure-output').html(measure.toFixed(2) + "mm"); 
}
//--MEASURE--

//--PICKPOINT--
function onEndPick(point) {
	// .toFixed(2) sets the number of decimals when displaying the picked point	
	var x = point[0].toFixed(2);
	var y = point[1].toFixed(2);
	var z = point[2].toFixed(2);
    $('#pickpoint-output').html("[ "+x+" , "+y+" , "+z+" ]");
} 
//--PICKPOINT--	

$(document).ready(function(){
	init3dhop();

	setup3dhop();
});
</script>
</html>
