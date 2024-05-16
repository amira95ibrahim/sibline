var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',

    // These options are needed to round to whole numbers if that's what you want.
    //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
    //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});


$(".asset-checkout").on("input change", function (event) {
    var investment_value = investment_value_range = parseInt($("#"+event.target.id).val(), 10);
    var minValue= $('#range-shares').prop('min');
    var maxValue = $('#range-shares').prop('max');
    var price = parseInt($("#inp-price").val(), 10);
    var commission = parseInt($("#inp-commission").val(), 10);

    var totalCommission = (commission * investment_value_range) / 100
    if(investment_value < minValue )
        investment_value_range = minValue;
    else if(investment_value > maxValue )
        investment_value_range = maxValue;
    
    $("#money-input").val(investment_value?investment_value:0);
    $("#range-shares").val(investment_value_range);
    $("#money-total").html(formatter.format(investment_value_range));

    $("#percentage").html(parseFloat((investment_value_range - totalCommission) / price * 100).toFixed(3));
  
  });

$(".asset-bid").on("input change", function (event) {
    var investment_value = Number($("#inp-percentage").val());
    
    var minValue = Number(0);
    var maxValue = Number(parseFloat($('#inp-max_shares').val()).toFixed(3));

    
    if(investment_value < minValue )
        $("#inp-percentage").val(minValue);
    else if(investment_value > maxValue )
        $("#inp-percentage").val(maxValue);
    
});


$(".asset-money-transfer").on("input change", function (event) {
    var investment_value = Number($("#inp-amount").val());
    
    var minValue = Number(0);
    var maxValue = Number(parseInt($('#inp-wallet').val()));

    
    if(investment_value < minValue )
        $("#inp-amount").val(minValue);
    else if(investment_value > maxValue )
        $("#inp-amount").val(maxValue);
    
});
  

  