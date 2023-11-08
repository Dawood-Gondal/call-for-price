/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_CallForPrice
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

require([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/url'
], function($, modal, urlBuilder) {
    var options = {
        type: 'popup',
        responsive: true,
        innerScroll: true,
        title: 'Call for Price',
        buttons: [{
            text: $.mage.__('Submit'),
            class: 'action submit primary submitrequest',
            click: function () {

                var valid_email = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var count = 0;
                if ($('#req_name').val() === '' && $('#req_phone').val() === '' && $('#req_email').val() === '') {
                    $('.modal-error').show();
                    count++;
                } else {
                    $('.modal-error').hide();
                    if ($('#req_name').val() === '') {
                        $('.name-error').show();
                        count++;
                    } else {
                        $('.name-error').hide();
                    }

                    if ($('#req_phone').val() === '') {
                        $('.phone-error').show();
                        count++;
                    } else {
                        $('.phone-error').hide();
                    }

                    if ($('#req_email').val() === '') {
                        $('.email-error').show();
                        count++;
                    } else {
                        $('.email-error').hide();
                    }
                }

                if (valid_email.test($('#req_email').val()) === false && $('#req_email').val() !== '') {
                    $('.modalemail-error').show();
                    count++;
                } else {
                    $('.modalemail-error').hide();
                }

                if(count === 0) {
                    $('.submitrequest').prop('disabled', true);
                    $.ajax({
                        url: urlBuilder.build('m2cop/index/postform'),
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            name: $('#req_name').val(),
                            phone: $('#req_phone').val(),
                            email: $('#req_email').val(),
                            product_id: $('#product_id').val(),
                        },
                        success: function (data) {
                            $('.alert-success').show();
                            setTimeout(function () {
                                $(".call-for-price-modal").modal("closeModal");
                                $('.submitrequest').prop('disabled', false);
                            }, 1500);
                        }
                    });
                }
            }
        }]
    };

    var popup = modal(options, $('.call-for-price-modal'));

    $(".call-for-price").on('click',function(){
        $("input").val('').end()
        $('.modal-error').hide();
        $('.modalemail-error').hide();
        $('.alert-success').hide();
        $(".call-for-price-modal").modal("openModal");
        $('.call-for-price-modal').find('#product_id').val($(this).data("product-id"));
    });

    $('.action-close').on('click', function (e) {
        $("input").val('').end()
        $('.alert-success').hide();
        $('.modal-error').hide();
    });
});
