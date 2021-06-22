<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Range Slider With AJAX</title>

    <!-- css  -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/jquery-ui.min.css">

    <!-- js -->
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery.js"></script>
    <script src="./js/jquery-ui.js"></script>

</head>

<body>

    <!-- header -->
    <div class="alert alert-">

    </div>


    <!-- Range Slider -->
    <div class="container">

        <p style="display:inline;">
            <label for="amount">Price range:</label>
            <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
        </p>

        <div id="slider-range"></div>

        <!-- Dynamic Data -->
        <table class="table table-info table-striped mt-5" id="tbl">
            <thead>
                <tr class="text-center">
                    <th>Product ID</th>
                    <th>Product</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>

    <!-- javascript Codes -->
    <script>
        $(document).ready(function() {
            var val1;
            var val2;

            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 10000,
                values: [999, 3999],
                slide: function(event, ui) {
                    $("#amount").val("Rs" + ui.values[0] + " - Rs" + ui.values[1]);
                    val1 = ui.values[0];
                    val2 = ui.values[1];

                    load(val1, val2);

                }
            });
            $("#amount").val("Rs." + $("#slider-range").slider("values", 0) +
                " - Rs." + $("#slider-range").slider("values", 1));

            function load(r1, r2) {

                $.ajax({
                    url: "load.php",
                    type: "POST",
                    data: {
                        r1: r1,
                        r2: r2
                    },
                    success: function(data) {
                        $("#tbl tbody ").html(data);
                        console.log(data);
                    }
                });
            }
            load(val1, val2);

        });
    </script>

</body>

</html>