var interval = 0;
var curOcr = 0;
var ctime = null;
var cday = null;
var device;
var browser;
var path = "https://" + window.location.hostname;
let domain = window.location.hostname.replace("www.", "");
const url = "https://" + domain;
const weekday = [
	"sunday",
	"monday",
	"tuesday",
	"wednesday",
	"thursday",
	"friday",
	"saturday",
];

sessionStorage.clear();
sessionStorage.setItem("call_counter", curOcr);

async function addImageProcess(src) {
	return new Promise((resolve, reject) => {
		let img = new Image();
		img.onload = () => resolve(img);
		img.onerror = reject;
		img.src = src;
	});
}

function readFile(file) {
	return new Promise((resolve, reject) => {
		const reader = new FileReader();
		reader.onload = async (e) => {
			try {
				const response = await addImageProcess(e.target.result);
				resolve(response);
			} catch (err) {
				reject(err);
			}
		};
		reader.onerror = (error) => {
			reject(error);
		};
		reader.readAsDataURL(file);
	});
}

async function fileInfo(filename) {
	var result = [];
	imgfile = filename.files[0];
	var regex = new RegExp("([sS:/|.|w|s|-])*.(?:jpg|gif|png)$");
	const fileInfos = await readFile(imgfile);
	if (regex.test(imgfile.name.toLowerCase())) {
		if (typeof filename.files != "undefined") {
			result["status"] = "1";
			const fileInfos = await readFile(imgfile);
			result["width"] = fileInfos.width;
			result["height"] = fileInfos.height;
			result["size"] = imgfile.size;
		} else {
			result["status"] = "0";
			result["msg"] = "Browser does not support!";
		}
	} else {
		result["status"] = "0";
		result["msg"] = "Invalid Image detected!";
	}
	return result;
}

function sendFile(formid, sUrl, callback) {
	const url = sUrl;
	const formElement = document.querySelector("#" + formid);
	const formData = new FormData(formElement);
	const xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callback(JSON.parse(this.responseText));
		}
	};
	xhttp.open("POST", url, true);
	xhttp.send(formData);
}

function sendData(arrdata, sUrl, callback) {
	const url = sUrl;
	const data = new URLSearchParams(arrdata).toString();
	const xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callback(JSON.parse(this.responseText));
		}
	};
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(data);
}

function currentTime() {
	let date = new Date();
	let day = weekday[date.getDay()];
	let hh = date.getHours();
	let mm = date.getMinutes();
	hh = hh < 10 ? "0" + hh : hh;
	mm = mm < 10 ? "0" + mm : mm;
	let time = hh + ":" + mm;
	ctime = time;
	cday = day;
	let t = setTimeout(function () {
		currentTime();
	}, 1000);
}

async function getResponse() {
	const response = await fetch(
		url + "/functions/live_games/?time=" + ctime + "&&day=" + cday,
		{
			method: "GET",
		}
	).catch((error) => {
		// console.log(error)
	});

	if (response.ok) {
		const data = await response.json();
		if (data.status == 0) {
			curOcr++;
			sessionStorage.setItem("live_id", data.result);
			sessionStorage.setItem("call_counter", curOcr);
			showLiveAlert();
		} else {
			console.log("clear interval");
			sessionStorage.removeItem("live_id");
			close_live();
		}
	} else {
		clearInterval(interval);
		sessionStorage.removeItem("call_counter");
		sessionStorage.removeItem("live_id");
	}
}

function showLiveAlert() {
	var s = localStorage.getItem("noliveshow");
	const live_id = sessionStorage.getItem("live_id");
	const call_counter = sessionStorage.getItem("call_counter");
	if (live_id !== "") {
		$("#live_gm_title").text(live_id);
	}
	if (call_counter > 0) {
		if (s == true) {
			$("#live_alert").toast("hide");
		}
	}
}

function close_live() {
	$("#live_alert").toast("hide");
}

function deleteLocal(param) {
	localStorage.removeItem(param);
}

function addLocal(param, value) {
	localStorage.setItem(param, value);
}

document.addEventListener("DOMContentLoaded", async () => {
	browser = getBrowserName(navigator.userAgent);
	let isMobile = window.matchMedia(
		"only screen and (max-width: 480px)"
	).matches;
	if (isMobile == true) {
		device = "Mobile";
	} else {
		device = "Desktop";
	}
});

function getBrowserName(userAgent) {
	if (userAgent.includes("Firefox")) {
		return "Mozilla Firefox";
	} else if (userAgent.includes("SamsungBrowser")) {
		return "Samsung Internet";
	} else if (userAgent.includes("Opera") || userAgent.includes("OPR")) {
		return "Opera";
	} else if (userAgent.includes("Trident")) {
		return "Microsoft Internet Explorer";
	} else if (userAgent.includes("Edge")) {
		return "Microsoft Edge (Legacy)";
	} else if (userAgent.includes("Edg")) {
		return "Microsoft Edge (Chromium)";
	} else if (userAgent.includes("Chrome")) {
		return "Google Chrome or Chromium";
	} else if (userAgent.includes("Safari")) {
		return "Apple Safari";
	} else {
		return "unknown";
	}
}

const srvChek = setInterval(async () => {
	const res = await fetch(path + "/login/livelog/")
		.then((response) => response.json())
		.then(function (data) {
			if (data == false) {
				location.replace(path + "/login/logout/");
				if (window.location.href == path + "/login") {
					clearInterval(srvChek);
				}
			}
		});
}, 300000);

function sendTokenToServer(currentToken) {
	const formData = new FormData();
	formData.append("regToken", currentToken);
	formData.append("device", device);
	formData.append("browser", browser);
	formData.append("action", "addRegKy");

	const cookieToken = getCookie("regKey");

	if (cookieToken != null) {
		if (cookieToken != currentToken) {
			setCookie("regKey", currentToken, 1);
			sendData(formData, "/push/", callbackPush);
		}
	} else {
		setCookie("regKey", currentToken, 1);
		sendData(formData, "/push/", callbackPush);
	}
}

function callbackPush(params) {
	console.log(params);
}

function setCookie(cname, cvalue, exdays) {
	const d = new Date();
	d.setTime(d.getTime() + exdays * 60 * 1000);
	let expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	let name = cname + "=";
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(";");
	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == " ") {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function delCookie(params) {
	document.cookie =
		params + "=; expires=Thu, 01 Jan 1900 00:00:00 UTC; path=/;";
}
