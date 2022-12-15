const addResourcesToCache = async (resources) => {
	const cache = await caches.open("v1");
	await cache.addAll(resources);
};
// This code executes in its own worker or thread
self.addEventListener("install", (event) => {
	event.waitUntil(
		addResourcesToCache([
			"/",
			/* "/index.html", */
			"/assets/css/style.css",
			"/assets/js/main.js",
			"/assets/css/dark-style.css",
			"/assets/css/transparent-style.css",
			"/assets/css/skin-modes.css",
			"/assets/plugins/bootstrap/css/bootstrap.min.css",
			"/assets/css/icons.css",
			"/assets/colors/color1.css",
			"/assets/iconfonts/linearicons/Linearicons.css",
			"/assets/iconfonts/ionicons/ionicons.css",
			"/assets/iconfonts/glyphicons/glyphicon.css",
			"/assets/plugins/bootstrap/js/bootstrap.min.js",
			"/assets/plugins/multipleselect/_multiple-select.scss",
			"/assets/js/jquery.min.js",
			"/assets/plugins/multipleselect/multiple-select.js",
			"/assets/plugins/multipleselect/multi-select.js",
			"/assets/plugins/bootstrap/js/popper.min.js",
			"/assets/images/brand/logo-2.png",
			"/assets/images/brand/logo-1.png",
			"/assets/images/media/bg-img3.jpg",
			"/assets/images/media/bg-img2.jpg",
			"/assets/images/media/bg-img1.jpg",
		])
	);
	//console.log("Service worker installed");
});
self.addEventListener("activate", (event) => {
	//console.log("Service worker activated");
});
