// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.12.1/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.12.1/firebase-analytics.js";
import {
	getMessaging,
	getToken,
	onMessage,
} from "https://www.gstatic.com/firebasejs/9.12.1/firebase-messaging.js";

const firebaseConfig = {
	apiKey: "AIzaSyDTMZwFV69qEYTxB7cpwe4pKv9dtHlp5kY",
	authDomain: "bdfatafat-97f9e.firebaseapp.com",
	projectId: "bdfatafat-97f9e",
	storageBucket: "bdfatafat-97f9e.appspot.com",
	messagingSenderId: "785210249898",
	appId: "1:785210249898:web:9e9f4cf47622900b36b6d3",
	measurementId: "G-1W7HB93VHT",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

const messaging = getMessaging(app);
getToken(messaging, {
	vapidKey:
		"BKDH5nXV8Ah-15y3nvDZkiC-P38kqMynouuyV03ckwUk8t8DEBfEM6P4iPEdo69fvnYOwsOJLgf55h8V1_Vhagg",
})
	.then((currentToken) => {
		if (currentToken) {
			if (currentToken != null) {
				console.log(currentToken);
				//store in cookie set
				const cookieToken = getCookie("regKey");

				if (cookieToken != null) {
					if (cookieToken != currentToken) {
						setCookie("regKey", currentToken, 1);
					}
				} else {
					setCookie("regKey", currentToken, 1);
				}
				sendTokenToServer(currentToken);
				delCookie("permission");
			}
		} else {
			console.log(
				"No registration token available. Request permission to generate one."
			);
			updateUIForPushPermissionRequired();
		}
	})
	.catch((err) => {
		console.log("An error occurred while retrieving token. ", err);
		//setCookie("permission", 1, 24);
		//window.alert("Notification Permission Denied!");
	});

onMessage(messaging, (payload) => {
	console.log("Message received. ", payload);
	// ...
});
