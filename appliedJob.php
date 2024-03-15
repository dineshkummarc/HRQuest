<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Applied Jobs</title>
    <link rel="stylesheet" href="appliedJob.css">
    <style>
        .accept-button {
            background-color: green;
            color: #fff;
        }
        .delete-button {
            background-color: red;
            color: #fff;
        }

        .download-button{
            background: #4C5FD5;
            color: #fff;
            text-decoration: none;
        }
        a{
            text-decoration: none;
        }
    </style>
  </head>
  <body>
    <div id="container">
        <h2>Applied Jobs</h2>
        <table>
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Applicant Name</th>
                    <th>Status</th>
                    <th style="text-align: center;">Action</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php require 'database.php';
                 $sql = "SELECT * FROM appliedjobs";
                 $result = $conn->query($sql);
         
                 if ($result->num_rows > 0) {
                     // Output data of each row
                     while($row = $result->fetch_assoc()) {
                         echo "<tr>";
                         echo "<td>" . $row["jobtitle"] . "</td>";
                         echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
                         echo "<td class='status'>Pending</td>";
                         echo "<td>";
                         echo "<button class='download-button btn'><a style='color: #fff;' href='" . $row["resume_path"] . "' download>Download CV</a></button>";
                         echo "<button class='accept-button btn' onclick='acceptApplication(event)'>Accept</button>";
                         echo "<button class='delete-button btn' onclick='deleteApplication(event)'>Delete</button>";
                         echo "</td>";
                         echo "<td><a href='applicantDetail.php?id=" . $row["id"] . "'>See more</a></td>";
                         echo "</tr>";
                     }
                 } else {
                     echo "<tr><td colspan='4'>No applied jobs found</td></tr>";
                 }
                 ?>
            </tbody>
        </table>
    </div>
    <script>
        function acceptApplication(event) {
        var row = event.target.closest('tr');
        var statusCell = row.querySelector('.status');
        if (statusCell.innerText === "Pending") {
            statusCell.innerText = "Accepted";
            disableButtons(row);
        }
    }

    function deleteApplication(event) {
        var row = event.target.closest('tr');
        var statusCell = row.querySelector('.status');
        if (statusCell.innerText === "Pending") {
            statusCell.innerText = "Rejected";
            disableButtons(row);
        }
    }

    function disableButtons(row) {
        row.querySelectorAll('button').forEach(function(button) {
            button.disabled = true;
        });
    }
    </script>
  </body>
</html>