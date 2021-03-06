<!-- View invoices page for invocies stored in database -->
<html>
    <head>
        <title>Invoices From Database</title>
        <link rel='stylesheet' type='text/css' href='../css/main.css' />
    </head>

    <body>
        <div id="wrapper-center-children" >

            <div id="header">Invoices Stored In Database</div>

            <h1> Invoices </h1>

            <?php
            //Server info encapsulated for security
            include("../../.-/.+.php");

            $conn = mysqli_connect($server, $user, $pwd, $db);
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $sqlSelect="SELECT * FROM invoices ORDER BY submission_date";

            if ($result=mysqli_query($conn, $sqlSelect, MYSQLI_USE_RESULT)) {
                $rows = mysqli_fetch_all($result, MYSQLI_NUM);
                mysqli_free_result($result);
            }
            $numberOfRows = count($rows);
            if ($numberOfRows == 0) {
                echo '<div id="wrapper-center-children"> <h2> No Invoices
              Stored In Database </h2> </div>';
            }
            for ($i = 0; $i < $numberOfRows; $i++) {
                echo '<div id="thank-you-buttons">
              <span>
          <form method="post" action="viewinvoice.php">
                 <input type="hidden" name="invoice-number" value="'
              . $rows[$i][0] . '" />
                <input type="hidden" name="invoice-name" value="'
              . $rows[$i][1] . '" />
                <input type="hidden" name="invoice-author" value="'
              . $rows[$i][2] . '" />
                 <input type="hidden" name="creation-date" value="'
              . $rows[$i][3] . '" />
                  <input type="hidden" name="invoice-contents" value="'
              . $rows[$i][4] . '" />
                 <input style="float:left; margin: 5px;" class="select-button"
                 type="submit" value="View: ' . $rows[$i][1] . '" />
         </form>
         _
         <form method="post" action="deleteinvoice.php">
              <input type="hidden" name="invoice-number" value="'
                . $rows[$i][0] . '" />
              <input id="delete-bt" class="select-button"
               type="submit" value="Delete: ' . $rows[$i][1] . '" />
         </form>
         </span>
      </div>';
            }

            mysqli_close($conn);


             ?>
             <div id="wrapper-center-children">
             <input class="yes-bt" style="min-width:200px; border-color:black;"
             type="button"
                    onclick="openWindow2()"
                    value="Clear Database Invoices" />
             </div>


                <div id="wrapper-center-children">
                <input class="thanks-button"
                style="min-width:200px; margin: 5px;" type="button"
                       onclick="location.href = '../index.html';"
                       value="Go Back To New Invoice Page" />
                </div>
        </div>

        <!-- Confirmation Window for Database Deletion-->
        <div id="window-populateDB" class="window" style="height:150px;">
            <h2 style="color: red; margin-top: -10px;"> WARNING </h2>
              <p> Confirming will remove all of you current database invoices. </p>
                <p> Proceed with deletion? </p>
                <div>
              <button onclick="location.href = '../cleartable.php'" class="yes-bt">
                 Yes </button>
              <button id="close-win-populateDB" class="no-bt" onclick="closeWindow2()">
                No </button>
              </div>
        </div>

        <script type="text/javascript" src="../js/window.js"></script>
    </body>


</html>
