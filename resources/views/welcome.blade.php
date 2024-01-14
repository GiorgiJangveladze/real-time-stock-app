<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Prices</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Stock Prices (Interval 1 min)</h2>
    <div id="stockData">
    </div>
</div>

<script>
    function fetchStockData() {
        const api = "{{ route('stock') }}";
        fetch(api)
            .then(response => response.json())
            .then(({data}) => {
                updateStockData(data);
            })
            .catch(error => console.error('Error fetching stock data:', error));
    }

    function updateStockData(data) {
        const stockDataDiv = document.getElementById('stockData');
        stockDataDiv.innerHTML = '';
        data?.forEach(item => {
            const companyName = item.report_date;
            const price = parseFloat(item.close);
            const percentage = parseFloat(item.percentage);
            const priceStatus = 'Down';
            const arrowClass = 'text-danger';
            const arrowIcon = '▼';

            if(percentage > 0) {
                arrowClass = 'text-success';
                arrowIcon = '▲';
                priceStatus = 'Up';
            }

            const stockItemHTML = `
                <div class="mb-3">
                    <strong>${companyName} - Price:</strong> ${price.toFixed(2)} 
                    <span class="${arrowClass}">${arrowIcon} ${priceStatus} (${percentage}%)</span>
                </div>
            `;

            stockDataDiv.innerHTML += stockItemHTML;
        });
    }

    fetchStockData();
    setInterval(fetchStockData, 60000);
</script>

</body>
</html>