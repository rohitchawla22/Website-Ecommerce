// JavaScript Document
function displayPopup(params)
{
	var pageid=1;
	var pageObj = Runner.pages.PageManager.getById(pageid);
	args = {
		bodyContent: "<iframe frameborder='0' id='popupIframe" + pageid + "' style='width: 100%; height: 100%; border: 0;'></iframe>",
		footerContent: "<span>&nbsp;</span>",
		headerContent: params.headerContent,
		centered: true,
		render: true,
		width: params.width ? params.width : 450,
		height: params.height ? params.height : 315
	},
	afterCreateHandler = function(win) {
		var bodyNode = $(win.bodyNode.getDOMNode()),
		iframeNode = $("iframe#popupIframe" + pageid, bodyNode);
 
		iframeNode.load(function() {
			if (Runner.isChrome) {
				bodyNode.addClass("noScrollBar");
			}
		win.show();	
 
		}).attr("src", params.url);
	},
	afterCloseHandler = params.afterClose;
 
if (Runner.isChrome) {
$("< style type='text/css'> .yui3-widget-bd::-webkit-scrollbar {display:none;} < /style>").appendTo("head");
}
 
Runner.pages.PageManager.createFlyWin.call(pageObj, args, true,
afterCreateHandler, afterCloseHandler);
}
 
function login()
{
 
params = {
		url: 'login.php',
		afterClose: function(win) {
			win.destroy(true);
			},
		headerContent: 'Login'
};
displayPopup(params);
}