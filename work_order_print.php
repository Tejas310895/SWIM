<?php

include("includes/db.php");

?>
<?php

if (isset($_GET['work_order_print'])) {

    $print_id = $_GET['work_order_print'];

    $get_work_order = "select * from work_order_task where work_order_entry_id='$print_id'";
    $run_work_order = mysqli_query($con, $get_work_order);
    $row_work_order = mysqli_fetch_array($run_work_order);

    $work_order_ref_no = $row_work_order['work_order_ref_no'];
    $work_order_date = $row_work_order['work_order_date'];
    $work_order_note = $row_work_order['work_order_note'];

    $work_order_pro_det = unserialize($row_work_order['work_order_pro_det']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Silver Wrap</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39 Extended Text' rel='stylesheet'>
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <script src="barcode/js/JsBarcode.all.min.js"></script>
    <style>
        #date {
            height: 100px;
            width: 230px;
        }

        #pro {
            height: 100px;
            width: 180px;
        }

        @media print {
            @page {
                size: 100mm 100mm;
                /* size: portrait; */
                margin: 2mm 0mm 0mm 0mm;
            }

            .pagebreak {
                page-break-before: always;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }

        window.onafterprint = function() {
            window.history.go(-1);
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            JsBarcode(".barcode").init();
        });
    </script>
</head>

<body>

    <div class="pagebreak mt-1 ml-1">
        <table class="text-dark">
            <tbody>
                <tr class="text-left">
                    <th>Ref number</th>
                    <td><?php echo $work_order_ref_no; ?></td>
                    <th>Grams/Metre</th>
                    <td><?php echo $work_order_pro_det[0]; ?></td>

                </tr>
                <tr class="text-left">
                    <th>Micron</th>
                    <td><?php echo $work_order_pro_det[1]; ?></td>
                    <th>Paper Tube</th>
                    <td><?php echo $work_order_pro_det[2]; ?></td>
                </tr>
                <tr class="text-left">
                    <th>Inner Box</th>
                    <td><?php echo $work_order_pro_det[3]; ?></td>
                    <th>MRP</th>
                    <td><?php echo $work_order_pro_det[4]; ?></td>
                </tr>
                <tr class="text-left">
                    <th>Total Box</th>
                    <td><?php echo $work_order_pro_det[5]; ?></td>
                    <th>Customer</th>
                    <td><?php echo $work_order_pro_det[6]; ?></td>
                </tr>
                <tr class="text-left">
                    <th>Date</th>
                    <td><?php echo $work_order_date; ?></td>
                    <th>Note</th>
                    <td><?php echo $work_order_note; ?></td>
                </tr>

            </tbody>
        </table>
    </div>
    <?php

    include("includes/footer.php");

    ?>

    <script type="text/javascript">
        google.load("elements", "1", {
            packages: "transliteration"
        });
        var control;

        function onLoad() {
            var options = {
                //Source Language
                sourceLanguage: google.elements.transliteration.LanguageCode.ENGLISH,
                // Destination language to Transliterate
                destinationLanguage: [google.elements.transliteration.LanguageCode.HINDI],
                shortcutKey: 'ctrl+g',
                transliterationEnabled: true
            };
            control = new google.elements.transliteration.TransliterationControl(options);
            control.makeTransliteratable(['txtMessage']);
        }
        google.setOnLoadCallback(onLoad);
    </script>
    <script type="text/javascript" src="https://fellowtuts.com/tryit/uploads/js/gtransapi.js"></script>