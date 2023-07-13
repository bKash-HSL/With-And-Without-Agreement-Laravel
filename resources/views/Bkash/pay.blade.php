<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>bKash Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .payment-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .payment-form label {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .payment-form input {
            width: 300px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .payment-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: white;
            margin: 20% auto;
            padding: 20px;
            width: 80%;
            border-radius: 4px;
            text-align: center;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-container button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="center">
        <div class="payment-form">
            <label for="amount">Enter Payment Amount</label>
            <input type="text" id="amount" name="amount" placeholder="Amount">
            <label for="amount">Enter bKash Agreement ID</label>
            <input type="text" id="agreementID" name="agreementID" placeholder="bKash Agreement ID">
            <button type="submit" id="payWithbKash">Confirm</button>
        </div>
    </div>

    <!-- Modal -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <div class="button-container">
                <button id="withoutAgreement">Pay With bKash (Without Agreement)</button>
                <button id="withAgreement">Pay With bKash (With Agreement)</button>
                <button id="createAgreement">Create bKash Agreement</button>
                <button id="cancelAgreement">Cancel bKash Agreement</button>
            </div>
        </div>
    </div>

    <div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>


    <script>
        $(document).ready(function() {
            $('#payWithbKash').click(function() {
                $('#confirmationModal').css('display', 'block');
            });

            $('#createAgreement').click(function() {
                // Get the entered amount
                //var amount = $('#amount').val();
                var form = $('<form>', {
                    'action': "{{ route('url-agreement-create') }}",
                    'method': 'POST'
                });

                // // Add the amount as a hidden input field
                // var amountInput = $('<input>', {
                //     'type': 'hidden',
                //     'name': 'amount',
                //     'value': amount
                // });

                // Append the inputs to the form
                // form.append(amountInput);

                // Append the form to the body and submit it
                $('body').append(form);
                form.submit();
            });

            $('#cancelAgreement').click(function() {
                // Get the entered amount
                var agreementID = $('#agreementID').val();

                if (!agreementID) {
                    // Store error message in session
                    var errorMessage = 'Agreement ID is required.';
                    sessionStorage.setItem('error', errorMessage);

                    // Redirect back to the original page
                    window.history.back();
                    return; // Stop execution if agreementID is not provided
                }

                var form = $('<form>', {
                    'action': "{{ route('url-agreement-cancel') }}",
                    'method': 'POST'
                });

               // Add the agreementID as a hidden input field
               var agreementIDInput = $('<input>', {
                    'type': 'hidden',
                    'name': 'agreementID',
                    'value': agreementID
                });

                // Append the inputs to the form
                form.append(agreementIDInput);

                // Append the form to the body and submit it
                $('body').append(form);
                form.submit();
            });

            $('#withoutAgreement').click(function() {
                // Get the entered amount
                var amount = $('#amount').val();

                if(!amount){
                     // Store error message in session
                     var errorMessage = 'Amount is required.';
                    sessionStorage.setItem('error', errorMessage);

                    // Redirect back to the original page
                    window.history.back();
                    return; // Stop execution if amount is not provided

                }

                // Create a form dynamically
                var form = $('<form>', {
                    'action': "{{ route('url-payment-create') }}",
                    'method': 'POST'
                });

                // Add the amount as a hidden input field
                var amountInput = $('<input>', {
                    'type': 'hidden',
                    'name': 'amount',
                    'value': amount
                });

                // Append the inputs to the form
                form.append(amountInput);

                // Append the form to the body and submit it
                $('body').append(form);
                form.submit();
            });

            $('#withAgreement').click(function() {
                // Get the entered amount
                var amount = $('#amount').val();
                var agreementID = $('#agreementID').val();

                if (!amount || !agreementID) {
                    // Store error message in session
                    var errorMessage = 'Amount & Agreement ID is required.';
                    sessionStorage.setItem('error', errorMessage);

                    // Redirect back to the original page
                    window.history.back();
                    return; // Stop execution if amount is not provided

                }

                // Create a form dynamically
                var form = $('<form>', {
                    'action': "{{ route('url-payment-create') }}",
                    'method': 'POST'
                });

                // Add the amount as a hidden input field
                var amountInput = $('<input>', {
                    'type': 'hidden',
                    'name': 'amount',
                    'value': amount
                });

                // Add the agreementID as a hidden input field
                var agreementIDInput = $('<input>', {
                    'type': 'hidden',
                    'name': 'agreementID',
                    'value': agreementID
                });

                // Append the inputs to the form
                form.append(amountInput);
                form.append(agreementIDInput);

                // Append the form to the body and submit it
                $('body').append(form);
                form.submit();
            });
        });
    </script>
</body>

</html>
