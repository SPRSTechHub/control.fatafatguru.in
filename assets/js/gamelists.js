var path = "https://" + window.location.hostname;
const fileInput = document.getElementById("file");
fileInput.addEventListener("change", function (e) {
	e.preventDefault();
	var file = fileInput.files[0];
	if (file != null) {
		(async () => {
			var resp = await fileInfo(fileInput);
			console.log(resp.size / 1024);
			if (resp.status == 1) {
				xsize = resp.size / 1024;
				if (xsize > 4096 || xsize < 2) {
					$(".toast-danger").toast("show");
					$(".toast-body").html("Image size should be 512KB to 4MB");
					fileInput.value = "";
					return;
				}
				if (resp.height < 200 || resp.width > 800) {
					$(".toast-danger").toast("show");
					$(".toast-body").html("Image Dimension should be appx 220 x 350");
					fileInput.value = "";
					return;
				}
			} else {
				$(".toast-danger").toast("show");
				$(".toast-body").html(resp.msg);
			}
		})();
	}
});
$(function () {
	"use strict";
	$("#add_gm_dgt_box").on("click", function () {
		$("#add_gm_dgt_mdl").modal("show");
	});
	$("#add_mkt_rt_box").on("click", function () {
		$("#mkt_rt_mdl").modal("show");
	});
	$("#add_gm_set_box").on("click", function () {
		$("#matchset_mdl").modal("show");
	});
	$("#add_gm_cat_box").on("click", function () {
		$("#add_cat_modal").modal("show");
	});

	$("#save_game_cat").on("click", function (e) {
		e.preventDefault();
		if ($("#file").val() == "") {
			$(".toast").toast("show");
			$(".toast-body").html("No Image detected!");
			$("#imgPreview").attr(
				"src",
				"https://codeigniter.spruko.com/sash/sash/assets/images/media/24.jpg"
			);
			return;
		}
		sendFile("add_cat_frm", path + "/admin/", callback);
	});

	$("#add_gm_item_box").on("click", function () {
		$("#gm_item_mdl").modal("show");
	});

	$("#save_game_item").on("click", function (e) {
		e.preventDefault();
		const form = document.getElementById("add_gm_item_frm");
		const formData = new FormData(form);
		formData.append("action", "addNewGameItem");
		sendData(formData, path + "/admin/", callback);
	});

	$("#add_gm_set_box").on("click", function () {
		$("#matchset_mdl").modal("show");
	});

	$("#table2").DataTable({
		processing: true,
		serverSide: true,
		search: {
			search: cday,
		},
		ajax: {
			url: path + "/datafunction/get_tbl_data/",
			dataType: "json",
			data: {
				action: "getuser",
				table: "tbl_gamelist",
			},
			type: "POST",
		},
		columns: [
			{
				title: "ID",
				data: "id",
				width: "5%",
			},
			{
				title: "MATCH TIME",
				data: "match_time",
				width: "10%",
			},
			{
				title: "DAY",
				data: "day",
				width: "15%",
			},
			{
				title: "GAME TITLE",
				data: "game_title",
				width: "20%",
			},
			{
				title: "GAME CAT",
				data: "cat_title",
				width: "15%",
			},
			{
				title: "STAT",
				data: "status",
				width: "5%",
				className: "dt-center editor-hider",
				render: function (data) {
					return data == 0
						? '<button type="button" class="btn btn-sm btn-info" data-tbl="tbl_gamelist" data-tblid="table2"><span class="fe fe-eye"></span></button>'
						: '<button type="button" class="btn btn-sm btn-dark" data-tbl="tbl_gamelist" data-tblid="table2"><span class="fe fe-eye-off"></span></button>';
				},
			},
			{
				title: "ACT1",
				width: "15%",
				className: "dt-center editor-gview",
				defaultContent:
					'<button id="gview" type="button" class="btn btn-sm btn-info" data-tblid="table2"><span class="fe fe-search"></span></button>',
				orderable: false,
			},
			{
				title: "DEL",
				width: "15%",
				className: "dt-center editor-delete",
				defaultContent:
					'<button data-tbl="tbl_gamelist" type="button" class="btn btn-sm btn-danger" data-tblid="table2"><span class="fe fe-trash-2"></span></button>',
				orderable: false,
			},
		],
		scrollY: 400,
	});

	$("#table3").DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: path + "/datafunction/get_tbl_data/",
			dataType: "json",
			data: {
				action: "getuser",
				table: "tbl_game_catagory",
			},
			type: "POST",
		},
		columns: [
			{
				title: "ID",
				data: "id",
				width: "10%",
			},
			{
				title: "IMAGE",
				data: "cat_iurl",
				width: "20%",
				className: "dt-center editor-adimg",
				render: function (data) {
					if (data != null) {
						return (
							'<img src="' +
							path +
							"/uploads/cat_img/" +
							data +
							'" width="40px">'
						);
					} else {
						return '<button id="adimg" type="button" class="btn btn-sm btn-info"><span class="fe fe-upload"></span></button>';
					}
				},
			},
			{
				title: "DAY",
				data: "cat_title",
				width: "15%",
			},
			{
				title: "GAME TITLE",
				data: "cat_id",
				width: "25%",
			},
			{
				title: "STAT",
				data: "status",
				width: "10%",
				className: "dt-center editor-hider",
				render: function (data) {
					return data == 0
						? '<button type="button" class="btn btn-sm btn-info" data-tbl="tbl_game_catagory" data-tblid="table3" ><span class="fe fe-eye"></span></button>'
						: '<button type="button" class="btn btn-sm btn-dark" data-tbl="tbl_game_catagory" data-tblid="table3"><span class="fe fe-eye-off"></span></button>';
				},
			},
			{
				title: "DEL",
				width: "10%",
				className: "dt-center editor-delete",
				defaultContent:
					'<button data-tbl="tbl_game_catagory" type="button" class="btn btn-sm btn-danger" data-tblid="table3"><span class="fe fe-trash-2"></span></button>',
				orderable: false,
			},
		],
		scrollY: 400,
	});

	$("#table4").DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: path + "/datafunction/get_tbl_data/",
			dataType: "json",
			data: {
				action: "getuser",
				table: "tbl_game_items",
			},
			type: "POST",
		},
		columns: [
			{
				title: "ID",
				width: "10%",
				data: "id",
			},
			{
				title: "NAME",
				width: "20%",
				data: "item_name",
			},
			{
				title: "GAME ID",
				width: "20%",
				data: "item_id",
			},
			{
				title: "CAT ID",
				width: "10%",
				data: "cat_id",
			},
			{
				title: "STAT",
				data: "status",
				width: "15%",
				orderable: false,
				className: "dt-center editor-hider",
				render: function (data) {
					return data == 0
						? '<button type="button" class="btn btn-sm btn-info" data-tbl="tbl_game_items" data-tblid="table4"><span class="fe fe-eye"></span></button>'
						: '<button type="button" class="btn btn-sm btn-dark" data-tbl="tbl_game_items" data-tblid="table4"><span class="fe fe-eye-off"></span></button>';
				},
			},
			{
				title: "DEL",
				width: "15%",
				className: "dt-center editor-delete",
				defaultContent:
					'<button data-tbl="tbl_game_items" type="button" class="btn btn-sm btn-danger" data-tblid="table4"><span class="fe fe-trash-2"></span></button>',
				orderable: false,
			},
		],
		scrollY: 400,
	});

	$("#table5").DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: path + "/datafunction/get_tbl_data/",
			dataType: "json",
			data: {
				action: "getuser",
				table: "tbl_market_ration",
			},
			type: "POST",
		},
		columns: [
			{
				title: "ID",
				width: "10%",
				data: "id",
			},
			{
				title: "CATAGORY_ID",
				width: "20%",
				data: "cat_id",
			},
			{
				title: "SD/10",
				width: "10%",
				data: "sd",
			},
			{
				title: "SP/10",
				width: "10%",
				data: "sp",
			},
			{
				title: "DP/10",
				width: "10%",
				data: "dp",
			},
			{
				title: "TP/10",
				width: "10%",
				data: "tp",
			},
			{
				title: "CP/10",
				width: "10%",
				data: "cp",
			},
			{
				title: "JODI/10",
				width: "10%",
				data: "jodi",
			},
			{
				title: "DEL",
				width: "15%",
				className: "dt-center editor-delete",
				defaultContent:
					'<button data-tbl="tbl_market_ration" type="button" class="btn btn-sm btn-danger" data-tblid="table5"><span class="fe fe-trash-2"></span></button>',
				orderable: false,
			},
		],
		scrollY: 400,
	});

	$("#table6").DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: path + "/datafunction/get_tbl_data/",
			dataType: "json",
			data: {
				action: "getuser",
				table: "tbl_digits",
			},
			type: "POST",
		},
		columns: [
			{
				title: "ID",
				width: "10%",
				data: "id",
			},
			{
				title: "TYPE",
				width: "30%",
				data: "digit_type",
			},
			{
				title: "DIGIT",
				width: "20%",
				data: "digits",
			},
			{
				title: "STAT",
				data: "status",
				width: "15%",
				orderable: false,
				className: "dt-center editor-hider",
				render: function (data) {
					return data == 0
						? '<button type="button" class="btn btn-sm btn-info" data-tbl="tbl_game_items" data-tblid="table4"><span class="fe fe-eye"></span></button>'
						: '<button type="button" class="btn btn-sm btn-dark" data-tbl="tbl_game_items" data-tblid="table4"><span class="fe fe-eye-off"></span></button>';
				},
			},
			{
				title: "DEL",
				width: "15%",
				className: "dt-center editor-delete",
				defaultContent:
					'<button data-tbl="tbl_digits" type="button" class="btn btn-sm btn-danger" data-tblid="table6"><span class="fe fe-trash-2"></span></button>',
				orderable: false,
			},
		],
		scrollY: 400,
	});

	$("#table2, #table3, #table4, #table6").on(
		"click",
		"td.editor-hider",
		function () {
			var tbl = $(this).find("button").data("tbl");
			var tblid = $(this).find("button").data("tblid");
			var table = $("#" + tblid).DataTable();
			var data = table.row(this).data();
			var status = data.status == 0 ? 1 : 0;
			const formData = new FormData();
			formData.append("action", "hideGame");
			formData.append("id", data.id);
			formData.append("status", status);
			formData.append("tbl", tbl);
			sendData(formData, path + "/admin/", callback);
		}
	);

	$("#table2").on("click", "td.editor-gview", function () {
		var table = $("#table2").DataTable();
		var data = table.row(this).data();
		location.replace(
			"https://control.fatafatguru.in/home/live?gid=" + data.match_id
		);
	});

	$("#table2, #table3, #table4, #table5, #table6").on(
		"click",
		"td.editor-delete",
		function () {
			var tbl = $(this).find("button").data("tbl");
			var tblid = $(this).find("button").data("tblid");
			var table = $("#" + tblid).DataTable();
			var data = table.row(this).data();
			const formData = new FormData();
			formData.append("action", "delGame");
			formData.append("id", data.id);
			formData.append("tbl", tbl);
			sendData(formData, path + "/admin/", callback);
		}
	);

	$("#file").change(function () {
		const file = this.files[0];
		if (file) {
			let reader = new FileReader();
			reader.onload = function (event) {
				$("#imgPreview").attr("src", event.target.result);
			};
			reader.readAsDataURL(file);
		}
	});
});

function callback(params) {
	$(".toast").toast("show");
	$(".toast-body").html(params.message);
	location.reload();
}
