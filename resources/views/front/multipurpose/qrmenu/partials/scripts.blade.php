<script>
    
    // apply coupon functionality starts
    function applyCoupon() {
        $.post(
            "{{route('front.coupon')}}",
            {
                coupon: $("input[name='coupon']").val()
            },
            function(data) {
                console.log(data);
                if (data.status == 'success') {
                    toastr["success"](data.message);
                    $("input[name='coupon']").val('');
                    $("#cartTotal").load(location.href + " #cartTotal", function() {
                        calcTotal();
                    });
                } else {
                    toastr["error"](data.message);
                }
            }
        );
    }
    $("input[name='coupon']").on('keypress', function(e) {
        let code = e.which;
        if (code == 13) {
            e.preventDefault();
            applyCoupon();
        }
    });
    // apply coupon functionality ends


    // No need for showForm function since only pick_up is available
    // function showForm(val) {
    //     $(".form-container").removeClass('d-block');
    //     $(".form-container").addClass('d-none');
    //     $(".form-container input").attr('disabled', true);

    //     $("#" + val).removeClass('d-none');
    //     $("#" + val).addClass('d-block');
    //     $("#" + val + " input").attr('disabled', false);
    // }

    // function to show forms depending for selected 'gateway'
    function showDetails(tabid) {

       
        // hide all inputs of unselected gateway
        $(".gateway-details").removeClass("d-flex");
        $(".gateway-details").addClass("d-none");
        // disable all input fields of unselected gateway
        $(".gateway-details input").attr('disabled', true);

        if ($("#tab-" + tabid).length > 0) {
            $("#tab-" + tabid).addClass("d-flex");
            // enable all input fields of selected gateway
            $("#tab-" + tabid + " input").removeAttr("disabled");
        }

    }

    function toggleBillingAddress() {
        let val = $("input[name='same_as_shipping']").is(':checked');
        if (!val) {
            $("#billingAddress").show();
        } else {
            $("#billingAddress").hide();
        }
    }

    function calcTotal() {
        let $servingIn = $("input[name='serving_method']:checked");
        // let $shippingIn = $("input[name='shipping_charge']:checked");

        let subTotal = parseFloat($("#subtotal").attr('data'));
        let total = subTotal;
        let scharge = 0;
        let tax = $("#tax").data('tax');

        // No home delivery, only pickup from restaurant
        // Shipping charges are not applicable for pickup orders

        total += parseFloat(scharge) + parseFloat(tax);
        total = total.toFixed(2);
        console.log(total);
        $(".grandTotal").attr('data', total);
        $(".grandTotal").text(total);
    }

    // No need for loadTimeFrames function since home delivery is removed
    // function loadTimeFrames(date, time) {
    //     if (date.length > 0) {
    //         $.get(
    //             "{{route('front.timeframes')}}",
    //             {
    //                 date: date
    //             },
    //             function(data) {
    //                 console.log('time frames', data);
    //                 let options = `<option value="" selected disabled>Select a Time Frame</option>`;
    //                 if (data.status == 'success') {
    //                     $("#deliveryTime").removeAttr('disabled');
    //                     let timeframes = data.timeframes;
    //                     for (let i = 0; i < timeframes.length; i++) {
    //                         options += `<option value="${timeframes[i].id}" ${time == timeframes[i].id ? 'selected' : ''}>${timeframes[i].start} - ${timeframes[i].end}</option>`
    //                         }
    //                 } else {
    //                     $("#deliveryTime").attr('disabled', true);
    //                     toastr["error"](data.message);
    //                 }
    //                 $("#deliveryTime").html(options);
    //             }
    //         )
    //     }
    // }

    // document load first time
    $(document).ready(function() {
        // show offline gateways according to selected serving method
        // showOfflineGateways(); // This line is removed

        // Set pick_up as default serving method if none is selected
        if (!$("input[name='serving_method']:checked").length) {
            $("input[name='serving_method'][value='pick_up']").prop('checked', true);
        }

        // No need to show form since only pick_up is available
        // let val = $("input[name='serving_method']:checked").val();
        // showForm(val); // This line is removed

        // calculate total
        calcTotal();

        // toggle billing address
        toggleBillingAddress();

        // No need to load time frames since home delivery is removed
        // loadTimeFrames("{{old('delivery_date')}}", "{{old('delivery_time')}}");


        // always check the first payment gateway
        $(".input-check").first().attr('checked', true);
        // change form action, show form for checked 'gateway'
        let tabid = $(".input-check:checked").data('tabid');
        $('#payment').attr('action', $(".input-check:checked").data('action'));
      
     
        showDetails(tabid);

        // No need for delivery datepicker since home delivery is removed
        // $(".delivery-datepicker").each(function() {
        //     let $this = $(this);
        //     $this.datepicker({
        //         beforeShowDay: function(date) {
        //             let day = date.getDay();
        //             if(disDays.indexOf(day) !== -1){
        //                 return [false,'na_dates'];
        //             } else {
        //                 return [true,'	'];
        //             }
        //         },
        //         onSelect: function(date, instance) {
        //             $this.parents('.field-input').addClass('cross-show');
        //             loadTimeFrames(date);
        //         }
        //     });
        // });
    });

    // No need for cross click handler since home delivery is removed
    // $(".field-input.cross i.fa-times-circle").on('click', function() {
    //     $(this).parents('.field-input').find('input').val('');
    //     $(this).parents('.field-input').removeClass('cross-show');
    //     $("#deliveryTime").html(`<option value="" selected disabled>Select a Time Frame</option>`);
    //     $("#deliveryTime").attr('disabled', true);
    // })


    // on change of 'same as shipping' checkbox
    $("input[name='same_as_shipping']").on('change', function() {
        toggleBillingAddress();
    });

    // on gateway change...
    $(document).on('change', '.input-check', function() {

        // change form action
        let tabid = $(this).data('tabid');
        $('#payment').attr('action', $(this).data('action'));
        $('#paymentGatewaysForm').attr('action', $(".input-check:checked").data('action'));
        // show relevant form (if any)
        showDetails(tabid);
    });

</script>
