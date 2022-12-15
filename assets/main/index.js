var curOcr = 0;
var ctime = null;
var cday = null;
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

currentTime();
showLiveAlert();

function showLiveAlert() {
	var s = localStorage.getItem("noliveshow");
	const live_id = sessionStorage.getItem("live_id");
	const call_counter = sessionStorage.getItem("call_counter");
	if (live_id !== "") {
		$("#live_gm_title").text(live_id);
	}
	if (call_counter > 0) {
		if (s == null) {
			var live_alert = document.getElementById("live_alert");
			live_alert.hide();
		}
	}
}

const interval = setInterval(function () {
	getResponse();
	showLiveAlert();
}, 300000);

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
		} else {
			console.log("clear interval");
			sessionStorage.removeItem("live_id");
		}
	} else {
		clearInterval(interval);
		sessionStorage.removeItem("call_counter");
		sessionStorage.removeItem("live_id");
	}
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
