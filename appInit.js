var device;
var browser;
var loct;

function updateUIForPushPermissionRequired() {
	Notification.requestPermission().then(function (permission) {
		if (permission === "denied") {
			console.log("Permission wasn't granted. Allow a retry.");
			return;
		}
		if (permission === "default") {
			console.log("The permission request was dismissed.");
			return;
		}
		if (permission === "granted") {
			var notification = new Notification("NIB GROUP", {
				icon: "./src/img/notif_ico.png",
				body: "Welcome to visit us!",
				tag: "Welcome Message",
				data: "Hello User",
			});
			return;
		}
	});
}
