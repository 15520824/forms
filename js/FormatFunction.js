
var _ = absol._;

function guidGenerator() {
  var S4 = function() {
     return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
  };
  return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}

function FlipClock(el, config) {
    var _this = this;
    var updateTimeout;
    _this.el = el;
    _this.config = Object.assign({
      endDate: new Date((new Date().getFullYear() + 1),0,0),
      labels: {
        days: 'Days',
        hours: 'Hours',
        minutes: 'Minutes',
        seconds: 'Seconds'
      }
    }, config);

    _this.current = getTimeUntil(
        _this.config.endDate.getTime()- new Date().getTime()
    );

    _this.promiseEnd = new Promise(function(resolve,reject){
      _this.resolve = resolve;
      _this.reject = reject;
    })

    createView();
    updateView();
    addObserver();
 
    function start() {
      var timestamp = config.endDate.getTime()- new Date().getTime();
      _this.current = getTimeUntil(timestamp);
      if(timestamp<=0)
      {
        _this.resolve()
        _this.destroy();
      }
      updateView();
      clearTimeout(updateTimeout);
      updateTimeout = setTimeout(start, 500);
    }

    function stop() {
      clearTimeout(updateTimeout);
    }

    function destroy() {
      stop();
      _this.observer.disconnect();
      _this.el.innerHTML = "";
    }

    function getTimeUntil(dateFuture) {
      var delta = Math.abs(dateFuture) / 1000;
      var d = Math.floor(delta / 86400);
      delta -= d * 86400;
      var h = Math.floor(delta / 3600) % 24;
      delta -= h * 3600;
      var m = Math.floor(delta / 60) % 60;
      delta -= m * 60;
      var s = Math.floor(delta % 60);
 
      d = pad3(d);
      h = pad2(h);
      m = pad2(m);
      s = pad2(s);

      return {
        d: d + "",
        h: h + "",
        m: m + "",
        s: s + ""
      };
    }

    // Assumes a non-negative number.
    function pad2(number) {
      if (number < 10) return "0" + number;
      else return "" + number;
    }

    function pad3(number) {
      if (number < 10) return "00" + number;
      else if (number < 100) return "0" + number;
      else return "" + number;
    }

    function createView() {
      _this.daysLeaf = createLeaf(_this.config.labels.days, 3);
      _this.hoursLeaf = createLeaf(_this.config.labels.hours);
      _this.minutesLeaf = createLeaf(_this.config.labels.minutes);
      _this.secondsLeaf = createLeaf(_this.config.labels.seconds);
    }

    function createLeaf(label, digits) {
      var leaf = document.createElement("div");
      leaf.className = "leaf _" + (digits ? digits : "2") + "-digits";
      leaf.setAttribute("data-label", label);
      var top = document.createElement("div");
      var topLabel = document.createElement("span");
      top.className = "top";
      top.appendChild(topLabel);
      var frontLeaf = document.createElement("div");
      var frontLabel = document.createElement("span");
      frontLeaf.className = "leaf-front";
      frontLeaf.appendChild(frontLabel);
      var backLeaf = document.createElement("div");
      var backLabel = document.createElement("span");
      backLeaf.className = "leaf-back";
      backLeaf.appendChild(backLabel);
      var bottom = document.createElement("div");
      var bottomLabel = document.createElement("span");
      bottom.className = "bottomCountdown";
      bottom.appendChild(bottomLabel);

      leaf.appendChild(top);
      leaf.appendChild(frontLeaf);
      leaf.appendChild(backLeaf);
      leaf.appendChild(bottom);

      _this.el.appendChild(leaf);

      return {
        el: leaf,
        topLabel: topLabel,
        frontLabel: frontLabel,
        backLabel: backLabel,
        bottomLabel: bottomLabel
      };
    }

    function updateView() {
      updateLeaf(_this.daysLeaf, _this.current.d);
      updateLeaf(_this.hoursLeaf, _this.current.h);
      updateLeaf(_this.minutesLeaf, _this.current.m);
      updateLeaf(_this.secondsLeaf, _this.current.s);
    }

    function updateLeaf(leaf, value) {
      if (leaf.isFlipping) return;

      var currentValue = leaf.topLabel.innerText;
      if (value !== currentValue) {
        leaf.isFlipping = true;
        leaf.topLabel.innerText = value;
        leaf.backLabel.innerText = value;
        leaf.el.classList.add("flip");

        clearTimeout(leaf.timeout);
        leaf.timeout = setTimeout(function () {
          leaf.frontLabel.innerText = value;
          leaf.bottomLabel.innerText = value;
          leaf.el.classList.remove("flip");
        }, 600);

        clearTimeout(leaf.timeout2);
        leaf.timeout2 = setTimeout(function () {
          leaf.isFlipping = false;
        }, 1000);
      }
    }

    function addObserver() {
      _this.observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            start();
          } else {
            stop();
          }
        });
      });

      _this.observer.observe(_this.el);
    }

    _this.start = start;
    _this.stop = stop;
    _this.destroy = destroy;
    _this.getCurrent = function () {
      return _this.current;
    }; 
    
    return _this;
  }

function formatDate(date,isMinutes = false, isHours = false , isDay = true, isMonth = true, isYear = true) {
    if(typeof date == "object")
    var d = date;
    else
    var d = new Date(date); //time zone value from database
    //convert the offset to milliseconds, add to targetTime, and make a new Date
    d = new Date(d.getTime());

    var resultTime = [];
    var resultDayMonth =[];

    if(isHours)
    {
        var hour = '' + d.getHours();
        if (hour.length < 2) 
        hour = '0' + hour;
        resultTime.push(hour);
    }
    if(isMinutes)
    {
        var minute = '' + d.getMinutes();
        if (minute.length < 2) 
        minute = '0' + minute;
        resultTime.push(minute);

        var second = '' + d.getSeconds();
        if (second.length < 2) 
        second = '0' + second;
        resultTime.push(second);
    }

    if(isDay){
        var day = '' + d.getDate();
        if (day.length < 2) 
            day = '0' + day;
        resultDayMonth.push(day);
    }  
    if(isMonth)
    {
        var month = '' + (d.getMonth() + 1);
        if (month.length < 2) 
        month = '0' + month;
        resultDayMonth.push(month);
    }
        
    if(isYear)
        resultDayMonth.push('' + d.getFullYear());
    
    return resultTime.join(':')+" "+resultDayMonth.join('/');
}

function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function reFormatNumber(n)
{
    return parseFloat(n.split(",").join(""));
}

function formatFit(n)
{
    var arr = [];
    var per = 10;
    var check;
    while(n!=0)
    {
        check = n%per;
        arr.push(check);
        n = n - check;
        per*=10;
    }
    return arr;
}

function getGMT(date,timezone = 0,onlyDay = false) {
    if(date==undefined)
    var d = new Date();
    else
    var d = new Date(date);
    //time zone value from database

    var timeZoneFromDB = timezone; //time zone value from database
    //get the timezone offset from local time in minutes
    var tzDifference = timeZoneFromDB * 60 + d.getTimezoneOffset();
    //convert the offset to milliseconds, add to targetTime, and make a new Date
    d = new Date(d.getTime() + tzDifference * 60 * 1000);
    
    

    var resultTime = [];
    var resultDayMonth =[];
    if(onlyDay==false){
        var hour = '' + d.getHours();
        if (hour.length < 2) 
        hour = '0' + hour;
        resultTime.push(hour);
    
        var minute = '' + d.getMinutes();
        if (minute.length < 2) 
        minute = '0' + minute;
        resultTime.push(minute);
    
        var second = '' + d.getSeconds();
        if (second.length < 2) 
        second = '0' + second;
        resultTime.push(second);
    }
   
    resultDayMonth.push('' + d.getFullYear());
    
    var month = '' + (d.getMonth() + 1);
    if (month.length < 2) 
    month = '0' + month;
    resultDayMonth.push(month);

    var day = '' + d.getDate();
    if (day.length < 2) 
        day = '0' + day;
    resultDayMonth.push(day);      
    if(onlyDay===false)
    return resultDayMonth.join('-')+" "+resultTime.join(':');
    else
    return resultDayMonth.join('-');
}

function getIDCompair(string)
{
    if(string == 0)
    return 0;
    return parseInt(string.slice(string.lastIndexOf("_")+1));
}

function getNameCompair(string)
{
    if(string == 0)
    return "";
    return string.slice(0,string.lastIndexOf("_"));
}

function removeAccents(str) {
    return str.normalize('NFD')
              .replace(/[\u0300-\u036f]/g, '')
              .replace(/đ/g, 'd').replace(/Đ/g, 'D');
  }

function promiseState(promise, callback) {
    // Symbols and RegExps are never content-equal
    var uniqueValue = window['Symbol'] ? Symbol('unique') : /unique/
  
    function notifyPendingOrResolved(value) {
      if (value === uniqueValue) {
        return callback('pending')
      } else {
        return callback('fulfilled')
      }
    }
  
    function notifyRejected(reason) {
      return callback('rejected')
    }
    
    var race = [promise, Promise.resolve(uniqueValue)]
    Promise.race(race).then(notifyPendingOrResolved, notifyRejected)
}

function consoleArea(areas) {
    var result = []
    var multipolygon = {
        type: "FeatureCollection",
        features:[]
    }

    areas.forEach(function(f) {
            if(f._area>(1.1368683772161603e-13)){
                var vertices = f.vertexlist;
                if(vertices!==undefined)
                {
                    var temp = [];
                    for(var i=0;i<vertices.length;i++)
                    {
                        temp.push([vertices[i].x,vertices[i].y]);
                    }
                    temp.push([vertices[0].x,vertices[0].y]);
                    temp = checkRule(temp);
                    multipolygon.features.push({
                        type: "Feature",
                        properties:{},
                        geometry: {
                            type: 'Polygon',
                            coordinates: [temp],
                        }
                    })
                }
            } 
    });
    return result;
}

function grayscale(src)
{
    return new Promise(function(resolve,reject){
    var image = new Image();
    image.src = src;
    image.style.visibility = "hidden";
    image.style.position = "absolute";
    image.style.top = 0;
    image.onload = function()
    {
        document.body.appendChild(image);
        var myCanvas=document.createElement("canvas");
        var myCanvasContext=myCanvas.getContext("2d");

        var imgWidth=image.width;
        var imgHeight=image.height;
        // You'll get some string error if you fail to specify the dimensions
        myCanvas.width = imgWidth;
        myCanvas.height = imgHeight;
        //  alert(imgWidth);
        myCanvasContext.drawImage(image,0,0);

        // This function cannot be called if the image is not rom the same domain.
        // You'll get security error if you do.
        var imgPixels=myCanvasContext.getImageData(0,0, imgWidth, imgHeight);
        document.body.removeChild(image);
        // This loop gets every pixels on the image and
        for(var y = 0; y < imgPixels.height; y++){
            for(var x = 0; x < imgPixels.width; x++){
                var i = (y * 4) * imgPixels.width + x * 4;
                var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
                imgPixels.data[i] = avg;
                imgPixels.data[i + 1] = avg;
                imgPixels.data[i + 2] = avg;
            }
        }
        myCanvasContext.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
        resolve(myCanvas.toDataURL());
    }
    })
  }

function toBase64(arr) {
    //arr = new Uint8Array(arr) if it's an ArrayBuffer
    return btoa(
       arr.reduce((data, byte) => data + String.fromCharCode(byte), '')
    );
 }

function consoleWKT(areas){
    var multipolygon = "MULTIPOLYGON("
    var polygon,isFirst,coordinates,isFirstPolygon="";
    areas.forEach(function(f) {
            if(f._area>(1.1368683772161603e-13)){
                var vertices = f.vertexlist;
                if(vertices!==undefined)
                {
                    polygon = "";
                    coordinates = ""
                    isFirst = "";
                    for(var i=0;i<vertices.length;i++)
                    {
                        coordinates +=isFirst+vertices[i].x+" "+vertices[i].y;
                        isFirst = ","
                    }
                    coordinates +=isFirst+vertices[0].x+" "+vertices[0].y;
                    coordinates = checkRuleWKT(coordinates);
                    polygon += "(("+coordinates+"))";
                }
                multipolygon+=isFirstPolygon+polygon;
                isFirstPolygon = ",";
            } 
    });
    multipolygon+=")";
    return multipolygon;
}
function checkRule(poly)
{
    var sum = 0
    for (var i=0; i<poly.length-1; i++) {
        var cur = poly[i],
            next = poly[i+1]
        sum += (next[0] - cur[0]) * (next[1] + cur[1])
    }
    if(sum>0)
    return poly.reverse();
    return poly;
}

function checkRuleWKT(poly)
{
    var sum = 0;
    var polygon = poly.split(",");
    for (var i=0; i<polygon.length-1; i++) {
        var cur = polygon[i].split(" "),
            next = polygon[i+1].split(" ");
        sum += (next[0] - cur[0]) * (parseFloat(next[1]) + parseFloat(cur[1]));
    }
    if(sum>0)
    return polygon.reverse().join();
    return poly;
}

function loaddingWheel()
{
   var temp = _({
        tag:"div",
        class:"container-wheel",
        child:[
            {
                tag:"div",
                class:"lds-roller",
                child:[
                    {
                        tag:"div"
                    },
                    {
                        tag:"div"
                    },
                    {
                        tag:"div"
                    },
                    {
                        tag:"div"
                    },
                    {
                        tag:"div"
                    },
                    {
                        tag:"div"
                    },
                    {
                        tag:"div"
                    },
                    {
                        tag:"div"
                    },
                ]
            }
        ]
        
    })
    Object.assign(temp,loaddingWheel.prototype);
    document.body.appendChild(temp);
    document.body.style.pointerEvents = "none";
    return temp;
}

loaddingWheel.prototype.disable = function()
{
    document.body.style.pointerEvents = "";
    this.selfRemove();
}

function insertAfter(newNode, existingNode) {
    existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
}


function isEqual(value, other) {

	// Get the value type
	var type = Object.prototype.toString.call(value);

	// If the two objects are not the same type, return false
	if (type !== Object.prototype.toString.call(other)) return false;

	// If items are not an object or array, return false
	if (['[object Array]', '[object Object]'].indexOf(type) < 0) return false;

	// Compare the length of the length of the two items
	var valueLen = type === '[object Array]' ? value.length : Object.keys(value).length;
	var otherLen = type === '[object Array]' ? other.length : Object.keys(other).length;
	if (valueLen !== otherLen) return false;

	// Compare two items
	var compare = function (item1, item2) {

		// Get the object type
		var itemType = Object.prototype.toString.call(item1);

		// If an object or array, compare recursively
		if (['[object Array]', '[object Object]'].indexOf(itemType) >= 0) {
			if (!isEqual(item1, item2)) return false;
		}

		// Otherwise, do a simple comparison
		else {

			// If the two items are not the same type, return false
			if (itemType !== Object.prototype.toString.call(item2)) return false;

			// Else if it's a function, convert to a string and compare
			// Otherwise, just compare
			if (itemType === '[object Function]') {
				if (item1.toString() !== item2.toString()) return false;
			} else {
				if (item1 !== item2) return false;
			}

		}
	};

	// Compare properties
	if (type === '[object Array]') {
		for (var i = 0; i < valueLen; i++) {
			if (compare(value[i], other[i]) === false) return false;
		}
	} else {
		for (var key in value) {
			if (value.hasOwnProperty(key)) {
				if (compare(value[key], other[key]) === false) return false;
			}
		}
	}

	// If nothing failed, return true
	return true;

};


function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
  }

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
} 
function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}