//<div id="box" style="height:150px; width:150px; background-color:orange; margin:25px"></div>
/*
    <button id="button1">Grow</button>
    <button id="button2">Blue</button>
    <button id="button3">Fade</button>
    <button id="button4">Reset</button>
*/

var startHeight = 150;
var currHeight = 150;
var maxHeight = 300;
var heightIncr = 10;

var startWidth = 150;
var currWidth = 150;
var maxWidth = 300;
var widthIncr = 10;

document.getElementById("button1").addEventListener(
    "click",
    function() {
        if (currHeight < maxHeight) {
            currHeight += heightIncr;
            currWidth += widthIncr;
            document.getElementById("box").style.height = currHeight + "px";
            document.getElementById("box").style.width = currWidth + "px";
        } else {
            document.getElementById("box").style.height = maxHeight + "px";
            document.getElementById("box").style.width = maxWidth + "px";
        }
    }
);

document.getElementById("button11").addEventListener(
    "click",
    function() {
        if (currHeight > startHeight) {
            currHeight -= heightIncr;
            currWidth -= widthIncr;
            document.getElementById("box").style.height = currHeight + "px";
            document.getElementById("box").style.width = currWidth + "px";
        } else {
            document.getElementById("box").style.height = startHeight + "px";
            document.getElementById("box").style.width = startWidth + "px";
        }
    }
);

//<div id="box" style="height:150px; width:150px; background-color:orange; margin:25px"></div>
document.getElementById("button2").addEventListener(
    "click",
    function() {
        document.getElementById("box").style.background = "blue";
    }
);

var startOpac = 1.0;
var currOpac = 1.0;
var minOpac = 0.1;
var opacDecr = 0.1;

//<div id="box" style="height:150px; width:150px; background-color:orange; margin:25px"></div>
//element.style.opacity = "0.9";
document.getElementById("button3").addEventListener(
    "click",
    function() {
        if (currOpac > minOpac) {
            currOpac -= opacDecr;
            document.getElementById("box").style.opacity = "" + currOpac + "";
        } else {
            document.getElementById("box").style.opacity = "" + minOpac + "";
        }
    }
);

//<div id="box" style="height:150px; width:150px; background-color:orange; margin:25px"></div>
document.getElementById("button4").addEventListener(
    "click",
    function() {
        document.getElementById("box").style.height = startHeight + "px";
        document.getElementById("box").style.width = startWidth + "px";
        document.getElementById("box").style.background = "orange";
        document.getElementById("box").style.opacity = "" + startOpac + "";
    }
);