<main>
    <div class="d-flex align-items-center mb-3 input-currency">
        <input type="text" class="form-control currency" value="GBP" placeholder="GBP">
        <button onclick="ExchangeRate.LoadExchangeData()" type="button" class="btn btn-primary w-25 ms-2">Search</button>
        <button onclick="ExchangeRate.LoadExchangeData()" type="button" class="btn btn-primary w-25 ms-2">Refresh</button>
    </div>
    <div class="currency-chart">
        <div class="currency-chart-header">
            <span>Currency (<span class="currency-text">GBP</span>) Exchange Rates</span>
        </div>
        <div class="currency-chart-list">
            <p class="text-right bold mt-3">1 <span class="currency-text">GBP</span> = </p>
            <ul class="exchange-data">
                <li>Please click on search/refresh button to load latest exchange rates.</li>
            </ul>
            <p class="text-right mt-3">Rates <span class="current-time"><?php echo date("d M Y") ?></span></p>
        </div>
    </div>
</main>