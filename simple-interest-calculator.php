<?php
function simple_interest_calculator() {
    ob_start();
    ?>
    <div class="si-calculator-container">
        <h2>Simple Interest Calculator</h2>
        <label for="principal">Principal Amount (₹):</label>
        <input type="number" id="principal" placeholder="Enter principal amount">

        <label for="rate">Rate of Interest (% per annum):</label>
        <input type="number" id="rate" placeholder="Enter annual interest rate">

        <label for="time">Time Period (years):</label>
        <input type="number" id="time" placeholder="Enter time in years">

        <label for="frequency">Interest Frequency:</label>
        <select id="frequency">
            <option value="annual">Annually</option>
            <option value="quarterly">Quarterly</option>
            <option value="monthly">Monthly</option>
            <option value="weekly">Weekly</option>
        </select>

        <button onclick="calculateSimpleInterest()">Calculate</button>

        <h3 id="result"></h3>
    </div>

    <script>
        function calculateSimpleInterest() {
            let principal = document.getElementById("principal").value;
            let rate = document.getElementById("rate").value;
            let time = document.getElementById("time").value;
            let frequency = document.getElementById("frequency").value;

            if (principal && rate && time) {
                // Convert annual rate to the selected frequency
                let frequencyFactor;
                switch (frequency) {
                    case "weekly":
                        frequencyFactor = 52;  // 52 weeks in a year
                        break;
                    case "monthly":
                        frequencyFactor = 12;  // 12 months in a year
                        break;
                    case "quarterly":
                        frequencyFactor = 4;   // 4 quarters in a year
                        break;
                    case "annual":
                    default:
                        frequencyFactor = 1;   // Annual frequency
                        break;
                }

                // Calculate simple interest based on frequency
                let effectiveRate = (rate / frequencyFactor); 
                let totalPeriods = time * frequencyFactor;
                let interest = (principal * effectiveRate * totalPeriods) / 100;
                let totalAmount = parseFloat(principal) + interest;

                document.getElementById("result").innerHTML = 
                    `Simple Interest: ₹${interest.toFixed(2)} <br> Total Amount: ₹${totalAmount.toFixed(2)}`;
            } else {
                document.getElementById("result").innerHTML = "Please fill in all fields.";
            }
        }
    </script>

    <style>
        .si-calculator-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }
        .si-calculator-container input, .si-calculator-container select, .si-calculator-container button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .si-calculator-container button {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('simple_interest_calculator', 'simple_interest_calculator');

?>
