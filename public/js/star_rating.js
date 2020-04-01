/**
 * jQuery Star Rating plugin
 * Joost van Velzen - http://joost.in
 *
 * v 1.0.3
 *
 * cc - attribution + share alike
 * http://creativecommons.org/licenses/by-sa/4.0/
 */

(function($) {
    $.fn.addRating = function(options) {
        var obj = this;
        var settings = $.extend({
            max: 5,
            half: true,
            fieldName: 'rating',
            fieldId: 'rating',
            icon: 'star'

        }, options);
        this.settings = settings;

        // create the stars
        for (var i = 1; i <= settings.max; i++) {
            var star = $('<i/>').addClass('material-icons w3-xxlarge').html(this.settings.icon + '_border').data('rating', i).appendTo(this).click(
                function() {
                    obj.setRating($(this).data('rating'));
                }
            ).hover(
                function(e) {
                    obj.showRating($(this).data('rating'), false);
                },
                function() {
                    obj.showRating(0, false);
                }
            );
        }
        $(this).append('<input type="hidden" name="' + settings.fieldName + '" id="' + settings.fieldId + '" />');
    };

    $.fn.setRating = function(numRating) {
        var obj = this;
        $('#' + obj.settings.fieldId).val(numRating);
        obj.showRating(numRating, true);
        sendRating(numRating)


    };

    function sendRating(numRating) {

        var user_id = document.getElementById("user_id").value;


        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "./addRating",
            data: {
                'service_id': user_id,
                'rating': numRating,
                'type': 0, //means service provider

            },

            success: function(results) {
                $("#lol").show();
                showAlert();
                console.log(results);
            },
            error: function(result, status, err) {
                alert("Problem Reaching server." + err);
            }
        });
    }


    $.fn.showRating = function(numRating, force) {
        var obj = this;
        if ($('#' + obj.settings.fieldId).val() == '' || force) {
            $(obj).find('i').each(function() {
                var icon = obj.settings.icon + '_border';
                if ($(this).data('rating') <= numRating) {
                    icon = obj.settings.icon;
                }
                $(this).html(icon);
            })
        }
    }

}(jQuery));
