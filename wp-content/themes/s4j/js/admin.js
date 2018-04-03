(function($){
    $(document).ready(function(){
        if ($('body').hasClass('cp-guest')) {
            $('.wp-list-table td:empty').closest('tr').css('backgroundColor', 'rgb(255, 186, 186)');
        }
    })
})(jQuery);

new Vue({
    el: '#app',
});