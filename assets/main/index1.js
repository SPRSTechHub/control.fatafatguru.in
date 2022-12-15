var curOcr = 0;
var ctime, cday;
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

window.onload = (event) => {
	sessionStorage.clear();
	sessionStorage.setItem("call_counter", curOcr);
	currentTime();
	getResponse();
};

async function getResponse() {
	console.log(ctime);
	/* const response = await fetch(
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
		}
	} else {
		clearInterval(interval);
		sessionStorage.removeItem("call_counter");
		sessionStorage.removeItem("live_id");
	} */
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

const interval = setInterval(function () {
	getResponse();
}, 20000);
