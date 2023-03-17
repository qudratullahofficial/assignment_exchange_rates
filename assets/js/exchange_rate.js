var ExchangeRate = function () {

    var getResponseHtml = function (apiResponse) {
        var html = "";
        if (apiResponse.success) {
            $.each(apiResponse.rates, function (key, value) {
                html += '<li><div class="currency-names"><span>' + key + '</span></div><div class="currency-rate">' + value.toFixed(3) + '</div></li>';
            });
            return html;
        }
        html = "No data found to display.";
        return html;
    };


    var LoadExchangeData = function () {
        var base = $(".currency").val();
        $(".currency-text").html(base);
        $.ajax({
            url: baseUrl + 'home/getExchangeRates/',
            dataType: 'json',
            method: 'POST',
            data: {base: base},
            cache: false,
            beforeSend: function () {
                $.blockUI({target: 'body', animate: true});
            },
            complete: function () {
                $.unblockUI();
            },
            success: function (data) {
                if (!data.error) {
                    var apiResponse = JSON.parse(data.description);
                    var htmlResponse = getResponseHtml(apiResponse);
                    $(".exchange-data").html(htmlResponse);
                    var baseCacheData = {
                        initTime: new Date(),
                        data: apiResponse
                    };
                    localStorage.setItem("base-" + base, JSON.stringify(baseCacheData));
                    setDate();
                } else {
                    alert("Error: " + data.description);
                }
            },
            error: function (xhr, desc, err) {
                alert("Error: " + desc);
            }
        });
    };

    var RefreshExchangeData = function () {
        var currencyBase = $(".currency").val();
        $(".currency-text").html(currencyBase);
        var key = "base-" + currencyBase;
        var cached = localStorage.getItem(key);
        if (cached !== null) {
            var cachedObj = JSON.parse(cached);
            var currentTime = new Date();
            var storedTime = new Date(cachedObj.initTime);
            var diffSec = (currentTime.getTime() - storedTime.getTime()) / 1000;
            if (diffSec <= 120) {
                $.blockUI({target: 'body', animate: true});
                var htmlResponse = getResponseHtml(cachedObj.data);
                $(".exchange-data").html(htmlResponse);
                setDate();
                setTimeout(function () {
                    $.unblockUI();
                }, 500);
            } else {
                LoadExchangeData();
            }
        } else {
            LoadExchangeData();
        }
    };

    var setDate = function () {
        var date = new Date();
        var month = date.toLocaleString('en-US', {month: 'long'});
        $(".current-time").html(date.getDate() + " " + month + " " + date.getFullYear());
    };

    return {
        LoadExchangeData: function () {
            RefreshExchangeData();
        },
        RefreshExchangeData: function () {
            RefreshExchangeData();
        }
    };
}();