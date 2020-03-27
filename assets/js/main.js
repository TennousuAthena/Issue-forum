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