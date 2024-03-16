<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Applied Jobs</title>
    <link rel="stylesheet" href="appliedJob.css">
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
                echo "<button class='accept-button btn' onclick='acceptApplication(event, " . $row["id"] . ")'>Accept</button>";
                echo "<button class='delete-button btn' onclick='rejectApplication(event, " . $row["id"] . ")'>Reject</button>";
                echo "</td>";
                echo "<td><a href='applicantDetail.php?id=" . $row["id"] . "'>See more</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No applied jobs found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<script>
    function acceptApplication(event, applicantId) {
        var row = event.target.closest('tr');
        var statusCell = row.querySelector('.status');
        if (statusCell.innerText === "Pending") {
            // Make AJAX request to accept the application
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        statusCell.innerText = "Accepted";
                        statusCell.classList.add("accepted");
                        disableButtons(row);
                    } else {
                        alert('Error: Unable to accept application.');
                    }
                }
            };
            xhr.open('GET', 'accept_applicant.php?id=' + applicantId, true);
            xhr.send();
        }
    }

    function rejectApplication(event, applicantId) {
        var row = event.target.closest('tr');
        var statusCell = row.querySelector('.status');
        if (statusCell.innerText === "Pending") {
            // Make AJAX request to reject the application
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        statusCell.innerText = "Rejected";
                        statusCell.classList.add("rejected");
                        disableButtons(row);
                    } else {
                        alert('Error: Unable to reject application.');
                    }
                }
            };
            xhr.open('GET', 'reject_applicant.php?id=' + applicantId, true);
            xhr.send();
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
