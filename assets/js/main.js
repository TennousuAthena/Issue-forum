//pjax
$(document).pjax('a[target!=_blank][data-pjax!=false]', '#pjax-content', {
    fragment: '#pjax-content',
    timeout: 2500
});
$(document).on('pjax:start', function () {
    NProgress.start()
});
$(document).on('pjax:end', function () {
    NProgress.done();
});
function getParameter(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");
    var r = location.search.substr(1).match(reg);
    if (r!=null) return (r[2]); return null;
}
