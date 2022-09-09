<?php init_head(); ?>
<style>.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php
            echo form_open($this->uri->uri_string(), array('id' => 'estimate-form', 'class' => '_transaction_form'));
            if (isset($estimate)) {
                echo form_hidden('isedit');
            }
            ?>
            <div class="col-md-12">
                <?php $this->load->view('admin/estimates/estimate_template'); ?>
            </div>
            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
    </div>
</div>
</div>
<?php init_tail(); ?>
<script>
    $(function () {
        validate_estimate_form();
        // Init accountacy currency symbol
        init_currency_symbol();
        // Project ajax search
        init_ajax_project_search_by_customer_id();
        // Maybe items ajax search
        init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');
    });
</script>
<script>
    $(function () {
        init_currency_symbol();
        // Maybe items ajax search
        init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');
        validate_proposal_form();

        $('.rel_id_label').html(_rel_type.find('option:selected').text());
        _rel_type.on('change', function () {
            var clonedSelect = _rel_id.html('').clone();
            _rel_id.selectpicker('destroy').remove();
            _rel_id = clonedSelect;
            $('#rel_id_select').append(clonedSelect);
            proposal_rel_id_select();
            if ($(this).val() != '') {
                _rel_id_wrapper.removeClass('hide');
            } else {
                _rel_id_wrapper.addClass('hide');
            }
            $('.rel_id_label').html(_rel_type.find('option:selected').text());
        });
        proposal_rel_id_select();
<?php if (!isset($proposal) && $rel_id != '') { ?>
            _rel_id.change();
<?php } ?>

    });
    /* function proposal_rel_id_select() {
     var serverData = {};
     serverData.rel_id = _rel_id.val();
     data.type = _rel_type.val();
<?php if (isset($proposal)) { ?>
         serverData.connection_type = 'proposal';
         serverData.connection_id = '<?php echo $proposal->id; ?>';
<?php } ?>
     init_ajax_search(_rel_type.val(), _rel_id, serverData);
     }*/
    function validate_proposal_form() {
        _validate_form($('#proposal-form'), {
            subject: 'required',
            proposal_to: 'required',
            rel_type: 'required',
            rel_id: 'required',
            date: 'required',
            email: {
                email: true,
                required: true
            },
            currency: 'required',
        });
    }
    function get_total_price_per_qty_rent(value)
    {
        var price = $('#rentmainprice_' + value).val();
        var qty = $('#rentqty_' + value).val();
        var months = $('#rentmonths_' + value).val();
        var days = $('#rentdays_' + value).val();
        var totalmonths = (parseInt(months) + (parseInt(days) / 30)).toFixed(2);
        //alert(totalmonths);
        var total_price = (price * qty * totalmonths);
        // var total_price = (price * qty);
        var disc = $('#rentdisc_' + value).val();
        $('#rentprice_' + value).val(total_price);
        var disc_amt = ((total_price * disc) / 100);
        var disc_price = (parseInt(total_price) - parseInt((total_price * disc) / 100));
        $('#rentdisc_amt_' + value).val(disc_amt);
        $('#rentdisc_price_' + value).val(disc_price);
        $('#renttax_amt_' + value).val((disc_price * 18) / 100);
        //var disc_price = $('#rentdisc_price_' + value).val();
        var tax_amt = $('#renttax_amt_' + value).val();
        //var grand_total=parseInt(disc_price)+parseInt(tax_amt);
        var grand_total = parseInt(disc_price);
        $('#grand_total_' + value).text(grand_total);
        var totalamt = 0;
        $('table.renttable').find('td.totalamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.rent_total_amt').val(totalamt);
        //$('.rent_total_quotation_amt').val(totalamt);
        var rent_total_amt = $('.rent_total_amt').val();
        var rent_discount_percentage = $('.rent_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.rent_discount_amt').val(disamt);
        $('.rent_total_quotation_amt').val(distotalamt);
        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));

        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        // var totalpro = $('#totalrentpro').attr('value');
        var totalpro = $('.addmorerentpro').attr('value');
        for (i = 0; i <= totalpro; i++) {
            arry[j++] = parseInt($('#renttax_amt_' + i).val());
            minarry[j++] = ((parseInt($('#averageprice' + i).val()) * parseInt($('#rentqty_' + i).val())) * parseInt(totalmonths));
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++) {
            totaltax += arry[i] << 0;
        }
        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++) {
            totalminprice += minarry[k] << 0;
        }
        $('.rent_total_quotation_tax_amt_in_words').html(toWords(totaltax));
        var rentamt = $('#averageprice' + value).val();
        var rentamt = (rentamt * qty * totalmonths);
        var marginprofit = (100 * (disc_price - rentamt) / rentamt);
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        //$('.rent_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');
        $('.rent_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');
        $('.rent_total_quotation_margin_profit').css("width", totalmarginprofit + '%');

        if (marginprofit >= 0 && marginprofit <= 9.99) {
            var color = 'red';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 10 && marginprofit <= 14.99) {
            var color = 'yellow';
            $('#rentprofit_amt' + value).removeClass('red');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 15 && marginprofit <= 19.99) {
            var color = 'blue';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('red');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 20 && marginprofit <= 29.99) {
            var color = 'green';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('red');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 30) {
            var color = 'orange';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('red');
        } else if (marginprofit <= 0) {
            var color = 'red';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        }

        $('#rentprofit_amt' + value).val(marginprofit);
        $('#rentprofit_amt' + value).addClass(color);
        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99) {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99) {
            var margincolor = 'yellow';
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99) {
            var margincolor = 'blue';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99) {
            var margincolor = 'green';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30) {
            var margincolor = 'orange';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0) {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        }
        $('.rent_total_quotation_margin_profit').addClass(margincolor);
    }

    function get_total_disc_rent() {
        var rent_total_amt = $('.rent_total_amt').val();
        var rent_discount_percentage = $('.rent_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.rent_discount_amt').val(disamt);
        $('.rent_total_quotation_amt').val(distotalamt);
        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));
    }

    function get_total_price_per_qty_sale(value) {
        var price = $('#salemainprice_' + value).val();
        var qty = $('#saleqty_' + value).val();
        var total_price = (price * qty);
        var disc = $('#saledisc_' + value).val();
        $('#saleprice_' + value).val(total_price);
        var disc_amt = ((total_price * disc) / 100);
        var disc_price = (parseInt(total_price) - parseInt((total_price * disc) / 100));
        $('#saledisc_amt_' + value).val(disc_amt);
        $('#saledisc_price_' + value).val(disc_price);
        $('#saletax_amt_' + value).val((disc_price * 18) / 100);
        //var disc_price=$('#saledisc_price_'+value).val();
        var tax_amt = $('#saletax_amt_' + value).val();
        var grand_total = parseInt(disc_price);
        $('#grand_total_sale' + value).text(grand_total);
        var totalamt = 0;
        $('table.saletable').find('td.totalsaleamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.sale_total_amt').val(totalamt);
        //$('.sale_total_quotation_amt').val(totalamt);
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));

        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        //var totalpro = $('#totalsalepro').attr('value');
        var totalpro = $('.addmoresalepro').attr('value');
        for (i = 0; i <= totalpro; i++) {
            arry[j++] = parseInt($('#saletax_amt_' + i).val());
            minarry[j++] = parseInt($('#averagesaleprice' + i).val()) * parseInt($('#saleqty_' + i).val());
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++) {
            totaltax += arry[i] << 0;
        }
        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++) {
            totalminprice += minarry[k] << 0;
        }

        $('.sale_total_quotation_tax_amt_in_words').html(toWords(totaltax));
        var rentamt = $('#averagesaleprice' + value).val();
        var rentamt = (rentamt * qty);
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        //$('.sale_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');
        $('.sale_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');
        $('.sale_total_quotation_margin_profit').css("width", totalmarginprofit + '%');
        var marginprofit = (100 * (disc_price - rentamt) / rentamt);
        if (marginprofit >= 0.00 && marginprofit <= 9.99)
        {
            var color = 'red';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 10 && marginprofit <= 14.99)
        {
            var color = 'yellow';
            $('#saleprofit_amt' + value).removeClass('red');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 15 && marginprofit <= 19.99)
        {
            var color = 'blue';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('red');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 20 && marginprofit <= 29.99)
        {
            var color = 'green';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('red');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 30)
        {
            var color = 'orange';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('red');
        }
        if (marginprofit <= 0)
        {
            var color = 'red';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        }
        $('#saleprofit_amt' + value).val(marginprofit);
        $('#saleprofit_amt' + value).addClass(color);


        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)
        {
            var margincolor = 'yellow';
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)
        {
            var margincolor = 'blue';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)
        {
            var margincolor = 'green';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30)
        {
            var margincolor = 'orange';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        }
        $('.sale_total_quotation_margin_profit').addClass(margincolor);
    }
    function get_total_disc_sale()
    {
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));
    }
    $(document).ready(function () {
        var totalamt = 0;
        $('table.renttable').find('td.totalamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.rent_total_amt').val(totalamt);
        //$('.rent_total_quotation_amt').val(totalamt);

        var rent_total_amt = $('.rent_total_amt').val();
        var rent_discount_percentage = $('.rent_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.rent_discount_amt').val(disamt);
        $('.rent_total_quotation_amt').val(distotalamt);
        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));
        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        var totalpro = $('#totalrentpro').attr('value');
        for (i = 0; i <= totalpro; i++)
        {
            arry[j++] = parseInt($('#renttax_amt_' + i).val());
            minarry[j++] = parseInt($('#averageprice' + i).val()) * parseInt($('#rentqty_' + i).val());
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++)
        {
            totaltax += arry[i] << 0;
        }
        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++)
        {
            totalminprice += minarry[k] << 0;
        }
        $('.rent_total_quotation_tax_amt_in_words').html(toWords(totaltax));
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        $('.rent_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');
        $('.rent_total_quotation_margin_profit').css("width", totalmarginprofit + '%');
        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)
        {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)
        {
            var margincolor = 'yellow';
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)
        {
            var margincolor = 'blue';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)
        {
            var margincolor = 'green';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30)
        {
            var margincolor = 'orange';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0)
        {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        }
        $('.rent_total_quotation_margin_profit').addClass(margincolor);

        var i;
        var arr = [];
        j = 0;
        var addmore = $('.addsalemore').attr('value');
        for (i = 0; i <= addmore; i++)
        {
            arr[j++] = parseInt($('#sale_total_maount' + i).val());
        }
        var total = 0;
        for (var i = 0; i < arr.length; i++)
        {
            total += arr[i] << 0;
        }
        $('.sale_other_charges_subtotal').html(total);
    });
    $(document).ready(function () {


        var totalamt = 0;
        $('table.saletable').find('td.totalsaleamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.sale_total_amt').val(totalamt);
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));

        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        var totalpro = $('#totalsalepro').attr('value');
        for (i = 0; i <= totalpro; i++)
        {
            arry[j++] = parseInt($('#saletax_amt_' + i).val());
            minarry[j++] = parseInt($('#averagesaleprice' + i).val()) * parseInt($('#saleqty_' + i).val());
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++)
        {
            totaltax += arry[i] << 0;
        }
        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++)
        {
            totalminprice += minarry[k] << 0;
        }

        $('.sale_total_quotation_tax_amt_in_words').html(toWords(totaltax));
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        //$('.sale_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');
        $('.sale_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');
        $('.sale_total_quotation_margin_profit').css("width", totalmarginprofit + '%');
        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)
        {
            var margincolor = 'yellow';
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)
        {
            var margincolor = 'blue';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)
        {
            var margincolor = 'green';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30)
        {
            var margincolor = 'orange';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        }
        $('.sale_total_quotation_margin_profit').addClass(margincolor);

        var i;
        var arr = [];
        j = 0;
        var addmore = $('.addmore').attr('value');
        for (i = 0; i <= addmore; i++)
        {
            arr[j++] = parseInt($('#total_maount' + i).val());
        }
        var total = 0;
        for (var i = 0; i < arr.length; i++)
        {
            total += arr[i] << 0;
        }
        $('.rent_other_charges_subtotal').html(total);
    });
</script>
<script type="text/javascript">
// American Numbering System
    var th = ['', 'thousand', 'million', 'billion', 'trillion'];

    var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

    var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];

    var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    function toWords(s) {
        s = s.toString();
        s = s.replace(/[\, ]/g, '');
        if (s != parseFloat(s))
            return 'not a number';
        var x = s.indexOf('.');
        if (x == -1)
            x = s.length;
        if (x > 15)
            return 'too big';
        var n = s.split('');
        var str = '';
        var sk = 0;
        for (var i = 0; i < x; i++) {
            if ((x - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += dg[n[i]] + ' ';
                if ((x - i) % 3 == 0)
                    str += 'hundred ';
                sk = 1;
            }
            if ((x - i) % 3 == 1) {
                if (sk)
                    str += th[(x - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
        if (x != s.length) {
            var y = s.length;
            str += 'point ';
            for (var i = x + 1; i < y; i++)
                str += dg[n[i]] + ' ';
        }
        return str.replace(/\s+/g, ' ');

    }
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
<?php
if (isset($proposal->is_gst)) {
    if ($proposal->is_gst == 1) {
        ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }
        } ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="amount' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][gst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="text" id="sgst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }
        } ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" onchange="getothercharges(' + newaddmore + ')" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="igst' + newaddmore + '" value="0" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php
    }
} else {
    if ($clientsate == get_staff_state()) {
        ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }
        } ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst' + newaddmore + '" value="0" name="othercharges[' + newaddmore + '][gst]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sgst' + newaddmore + '" value="0" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][sgst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }
        } ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="igst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][igst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php }
}
?>
                                $('.selectpicker').selectpicker('refresh');
                            });

                            $('.addmorerentpro').click(function ()
                            {
                                var addmorerentpro = parseInt($(this).attr('value'));
                                var check_gst = parseInt($('#check_gst').val());
                                var newaddmorerentpro = addmorerentpro + 1;
                                $(this).attr('value', newaddmorerentpro);
                                if (check_gst == 0)
                                {
                                    $('.renttable tbody').append('<tr class="trrentpro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getprodata(' + newaddmorerentpro + ')" data-live-search="true" id="prodid' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php if (isset($product_data) && count($product_data) > 0) {
    foreach ($product_data as $product_key => $product_value) { ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php }
} ?></select><input class="form-control" type="hidden" id="rentpro_name' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="renpro_id' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="150" name="rentproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averageprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" readonly class="form-control" id="rentpro_remark_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" readonly id="rentpro_pro_id_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" id="rentpro_pro_hsncode_' + newaddmorerentpro + '" class="form-control" readonly name="rentproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="number" class="form-control" id="rentqty_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="rentmonths_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][months]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1"></td><td><input type="number" class="form-control" id="rentdays_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][days]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="0" value="0"></td><td><input type="text" class="form-control" id="rentmainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" name="rentproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="rentprice_' + newaddmorerentpro + '" ></td><td><input type="text" class="form-control" id="rentdisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" value="0" name="rentproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="rentdisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="rentdisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="rentprofit_amt' + newaddmorerentpro + '" value="20"></td><td><input type="hidden" name="rentproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" value="18"></td><td><input readonly="" type="text" class="form-control" id="renttax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_' + newaddmorerentpro + '"></td></tr>');
                                } else
                                {
                                    $('.renttable tbody').append('<tr class="trrentpro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getprodata(' + newaddmorerentpro + ')" data-live-search="true" id="prodid' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php if (isset($product_data) && count($product_data) > 0) {
    foreach ($product_data as $product_key => $product_value) { ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php }
} ?></select><input class="form-control" id="rentpro_name' + newaddmorerentpro + '" type="hidden" name="rentproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="renpro_id' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="150" name="rentproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averageprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" readonly id="rentpro_remark_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" id="rentpro_pro_id_' + newaddmorerentpro + '" readonly name="rentproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" class="form-control" id="rentpro_pro_hsncode_' + newaddmorerentpro + '" readonly name="rentproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="number" class="form-control" id="rentqty_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="rentmonths_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][months]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1"></td><td><input type="number" class="form-control" id="rentdays_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][days]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="0" value="0"></td><td><input type="text" class="form-control" id="rentmainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" name="rentproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="rentprice_' + newaddmorerentpro + '" ></td><td><input type="text" class="form-control" id="rentdisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" value="0" name="rentproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="rentdisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="rentdisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="rentprofit_amt' + newaddmorerentpro + '" value="20"></td><td><input type="hidden" name="rentproposal[' + newaddmorerentpro + '][isgst]" value="1"><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" id="renttax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_' + newaddmorerentpro + '"></td></tr>');
                                }
                                $('.selectpicker').selectpicker('refresh');
                            });

                            $('.addmoresalepro').click(function ()
                            {
                                var addmorerentpro = parseInt($(this).attr('value'));
                                var check_gst = parseInt($('#check_gst').val());
                                var newaddmorerentpro = addmorerentpro + 1;
                                $(this).attr('value', newaddmorerentpro);
                                if (check_gst == 0)
                                {
                                    $('.saletable tbody').append('<tr><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ')" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php if (isset($product_data) && count($product_data) > 0) {
    foreach ($product_data as $product_key => $product_value) { ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php }
} ?></select><input class="form-control" type="hidden" id="salepro_name' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" readonly class="form-control" id="salepro_remark_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" id="salepro_pro_hsncode_' + newaddmorerentpro + '" class="form-control" readonly name="saleproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="number" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" ></td><td><input type="text" class="form-control" id="saledisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" value="0" name="saleproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="saledisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="saledisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="saleprofit_amt' + newaddmorerentpro + '"></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" value="18"></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');
                                } else
                                {
                                    $('.saletable tbody').append('<tr><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ')" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php if (isset($product_data) && count($product_data) > 0) {
    foreach ($product_data as $product_key => $product_value) { ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php }
} ?></select><input class="form-control" id="salepro_name' + newaddmorerentpro + '" type="hidden" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" readonly id="salepro_remark_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" id="salepro_pro_id_' + newaddmorerentpro + '" readonly name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" class="form-control" id="salepro_pro_hsncode_' + newaddmorerentpro + '" readonly name="saleproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="number" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" ></td><td><input type="text" class="form-control" id="saledisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" value="0" name="saleproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="saledisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="saledisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="saleprofit_amt' + newaddmorerentpro + '"></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="1"><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');
                                }
                                $('.selectpicker').selectpicker('refresh');
                            });
                            $('.addsalemore').click(function ()
                            {
                                var addmore = parseInt($(this).attr('value'));
                                var newaddmore = addmore + 1;
                                $(this).attr('value', newaddmore);
<?php
if (isset($proposal->is_gst)) {
    if ($proposal->is_gst == 1) {
        ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }
        } ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" onchange="getothersalecharges(' + newaddmore + ')"  class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][gst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>  $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }
        } ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_amount' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_igst' + newaddmore + '" value="0" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" value="0" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php
    }
} else {
    if ($clientsate == get_staff_state()) {
        ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '"  name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }
        } ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" onchange="getothersalecharges(' + newaddmore + ')" ></div></td><td><div class="form-group"><input type="text" id="sale_gst' + newaddmore + '" value="0" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][gst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }
        } ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" onchange="getothersalecharges(' + newaddmore + ')" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_igst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][igst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php }
}
?>
                                $('.selectpicker').selectpicker('refresh');
                            });
                            function removeothercharges(othercharg) {
                                $('#tr' + othercharg).remove();
                                var i;
                                var arr = [];
                                j = 0;
                                var addmore = $('.addmore').attr('value');
                                for (i = 0; i <= addmore; i++) {
                                    arr[j++] = parseInt($('#total_maount' + i).val());
                                }
                                var total = 0;
                                for (var i = 0; i < arr.length; i++) {
                                    total += arr[i] << 0;
                                }
                                $('.rent_other_charges_subtotal').html(total);
                            }


                            function removerentpro(value)
                            {
                                $('.trrentpro' + value).remove();
                                get_total_price_per_qty_rent(value);
                            }
                            function removesalepro(value)
                            {
                                $('.trsalepro' + value).remove();
                                get_total_price_per_qty_sale(value);
                            }
                            function removesaleothercharges(othercharg) {
                                $('#trsale' + othercharg).remove();
                                var i;
                                var arr = [];
                                j = 0;
                                var addmore = $('.addsalemore').attr('value');
                                for (i = 0; i <= addmore; i++) {
                                    arr[j++] = parseInt($('#sale_total_maount' + i).val());
                                }
                                var total = 0;
                                for (var i = 0; i < arr.length; i++) {
                                    total += arr[i] << 0;
                                }
                                $('.sale_other_charges_subtotal').html(total);
                            }
                            function get_rel_list(value)
                            {
                                var rel_type = value;
                                var url = '<?php echo base_url(); ?>admin/Proposals/get_rel_list';
                                var html = '<option value=""></option>';
                                $.post(url,
                                        {
                                            rel_type: rel_type,
                                        },
                                        function (data, status)
                                        {
                                            if (data != "")
                                            {
                                                var resArr = $.parseJSON(data);
                                                if (rel_type == 'proposal')
                                                {
                                                    $.each(resArr, function (k, v) {
                                                        html += '<option value="' + v.id + '">' + v.leadno + '</option>';
                                                    });
                                                    $('.rel_id_label').text('Lead');
                                                }
                                                if (rel_type == 'customer')
                                                {
                                                    $.each(resArr, function (k, v) {
                                                        html += '<option value="' + v.userid + '">' + v.client_branch_name + ' - ' + v.email_id + '</option>';
                                                    });
                                                    $('.rel_id_label').text('client');
                                                }
                                            }
                                            $("#rel_id").val('');
                                            $("#rel_id").html('').html(html);
<?php if ((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')) { ?> $("#rel_id").val('<?php echo $proposal->rel_id; ?>');<?php } ?>
<?php if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')) { ?> $("#rel_id").val('<?php echo $proposal->rel_id; ?>');<?php } ?>
<?php if (isset($_GET['rel_id'])) { ?> $("#rel_id").val('<?php echo $_GET['rel_id']; ?>');<?php } ?>
                                            $('.selectpicker').selectpicker('refresh');
                                        });
                            }
                            $(function () {
<?php if (isset($_GET['rel_id'])) { ?>
                                    var rel_id = '<?php echo $_GET['rel_id']; ?>';
                                    get_rel_list('proposal');

                                    $.get(admin_url + 'proposals/get_relation_data_values/' + rel_id + '/proposal', function (response) {
                                        $('input[name="proposal_to"]').val(response.to);
                                        $('textarea[name="address"]').val(response.address);
                                        $('input[name="email"]').val(response.email);
                                        $('input[name="phone"]').val(response.phone);
                                        $('input[name="city"]').val(response.city);
                                        $('input[name="state"]').val(response.state);
                                        $('#state').val(response.state);
                                        $('#city').val(response.city);
                                        $('#source').val(response.source);
                                        $('input[name="zip"]').val(response.zip);
                                        $('select[name="country"]').selectpicker('val', response.country);
                                        $('.selectpicker').selectpicker('refresh');
                                        var currency_selector = $('#currency');
                                        if (_rel_type.val() == 'customer') {
                                            if (typeof (currency_selector.attr('multi-currency')) == 'undefined') {
                                                currency_selector.attr('disabled', true);
                                            }

                                        } else {
                                            currency_selector.attr('disabled', false);
                                        }
                                        var proposal_to_wrapper = $('[app-field-wrapper="proposal_to"]');
                                        if (response.is_using_company == false && !empty(response.company)) {
                                            proposal_to_wrapper.find('#use_company_name').remove();
                                            proposal_to_wrapper.find('#use_company_help').remove();
                                            proposal_to_wrapper.append('<div id="use_company_help" class="hide">' + response.company + '</div>');
                                            proposal_to_wrapper.find('label')
                                                    .prepend("<a href=\"#\" id=\"use_company_name\" data-toggle=\"tooltip\" data-title=\"<?php echo _l('use_company_name_instead'); ?>\" onclick='document.getElementById(\"proposal_to\").value = document.getElementById(\"use_company_help\").innerHTML.trim(); this.remove();'><i class=\"fa fa-building-o\"></i></a> ");
                                        } else {
                                            proposal_to_wrapper.find('label #use_company_name').remove();
                                            proposal_to_wrapper.find('label #use_company_help').remove();
                                        }
                                        /* Check if customer default currency is passed */
                                        if (response.currency) {
                                            currency_selector.selectpicker('val', response.currency);
                                        } else {
                                            /* Revert back to base currency */
                                            currency_selector.selectpicker('val', currency_selector.data('base'));
                                        }
                                        currency_selector.selectpicker('refresh');
                                        currency_selector.change();
                                    }, 'json');
<?php
}
if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')) {
    ?>
                                    get_rel_list('customer');
<?php
}
if ((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')) {
    ?>
                                    get_rel_list('proposal');
<?php } ?>
                            });

                            function getothercharges(value)
                            {
                                var amount = $('#amount' + value).val();
                                var igst = $('#igst' + value).val();
                                if (typeof igst === "undefined") {
                                    var gst = $('#gst' + value).val();
                                    var sgst = $('#sgst' + value).val();
                                    var igst = parseInt(gst) + parseInt(sgst); }
                                var totalgstamt = parseInt((igst * amount) / 100);
                                var totalamt = parseInt(amount) + parseInt(totalgstamt);
                                $('#gst_sgst_amt' + value).val(totalgstamt);
                                $('#total_maount' + value).val(totalamt);
                                var i;
                                var arr = [];
                                j = 0;
                                var addmore = $('.addmore').attr('value');
                                for (i = 0; i <= addmore; i++)
                                {
                                    arr[j++] = parseInt($('#total_maount' + i).val());
                                }
                                var total = 0;
                                for (var i = 0; i < arr.length; i++)
                                {
                                    total += arr[i] << 0;
                                }
                                $('.rent_other_charges_subtotal').html(total);
                            }

                            function getothersalecharges(value)
                            {
                                var sale_amount = $('#sale_amount' + value).val();
                                var igst = $('#sale_igst' + value).val();
                                if (typeof igst === "undefined") {
                                    var gst = $('#sale_gst' + value).val();
                                    var sgst = $('#sale_sgst' + value).val();
                                    var igst = parseInt(gst) + parseInt(sgst);
                                }
                                var totalgstamt = parseInt((igst * sale_amount) / 100);
                                var totalamt = parseInt(sale_amount) + parseInt(totalgstamt);
                                $('#sale_gst_sgst_amt' + value).val(totalgstamt);
                                $('#sale_total_maount' + value).val(totalamt);
                                var i;
                                var arr = [];
                                j = 0;
                                var addmore = $('.addsalemore').attr('value');
                                for (i = 0; i <= addmore; i++) {
                                    arr[j++] = parseInt($('#sale_total_maount' + i).val());
                                }
                                var total = 0;
                                for (var i = 0; i < arr.length; i++) {
                                    total += arr[i] << 0;
                                }
                                $('.sale_other_charges_subtotal').html(total);
                            }
                            function staffdropdown()
                            {
                                $.each($("#assign option:selected"), function () {
                                    var select = $(this).val();
                                    $("optgroup." + select).children().attr('selected', 'selected');
                                });
                                $('.selectpicker').selectpicker('refresh');
                                $.each($("#assign option:not(:selected)"), function () {
                                    var select = $(this).val();
                                    $("optgroup." + select).children().removeAttr('selected');
                                });
                                $('.selectpicker').selectpicker('refresh');
                            }
                            function getprodata(value)
                            {
                                var prodid = $('#prodid' + value).val();
                                var check_gst = parseInt($('#check_gst').val());
                                var rent_company_category = $('#rent_company_category').val();
                                var url = '<?php echo base_url(); ?>admin/Site_manager/getproddetails';
                                $.post(url,
                                        {
                                            prodid: prodid,
                                            rent_company_category: rent_company_category,
                                        },
                                        function (data, status) {
                                            var res = JSON.parse(data);
                                            $('#renpro_id' + value).val(prodid);
                                            $('#rentpro_remark_' + value).val(res.product_remarks);
                                            $('#rentpro_name' + value).val(res.name);
                                            $('#rentpro_pro_id_' + value).val(res.pro_id);
                                            $('#rentpro_pro_hsncode_' + value).val(res.hsn_code);
                                            $('#averageprice' + value).val(res.min_rentprice);
                                            $('#rentmainprice_' + value).val(res.proprice);
                                            $('#rentprice_' + value).val(res.proprice);
                                            $('#rentdisc_price_' + value).val(res.proprice);
                                            $('#renttax_amt_' + value).val(res.gstamt);
                                            $('#grand_total_' + value).text(res.proprice);
                                            $('.selectpicker').selectpicker('refresh');
                                            get_total_price_per_qty_rent(value);
                                        });
                            }

                            function getsaleprodata(value)
                            {
                                var prodid = $('#saleprodid' + value).val();
                                var check_gst = parseInt($('#check_gst').val());
                                var rent_company_category = $('#rent_company_category').val();
                                var url = '<?php echo base_url(); ?>admin/Site_manager/getsaleproddetails';
                                $.post(url,
                                        {
                                            prodid: prodid,
                                            rent_company_category: rent_company_category,
                                        },
                                        function (data, status) {
                                            var res = JSON.parse(data);
                                            $('#salepro_id' + value).val(prodid);
                                            $('#salepro_remark_' + value).val(res.product_remarks);
                                            $('#salepro_name' + value).val(res.name);
                                            $('#salepro_pro_id_' + value).val(res.pro_id);
                                            $('#salepro_pro_hsncode_' + value).val(res.hsn_code);
                                            $('#averagesaleprice' + value).val(res.min_rentprice);
                                            $('#salemainprice_' + value).val(res.proprice);
                                            $('#saleprice_' + value).val(res.proprice);
                                            $('#saledisc_price_' + value).val(res.proprice);
                                            $('#saletax_amt_' + value).val(res.gstamt);
                                            $('#grand_total_sale' + value).text(res.proprice);
                                            get_total_price_per_qty_sale(value);
                                            $('.selectpicker').selectpicker('refresh');
                                        });
                            }
</script>
</body>
</html>
