<?php
include("connection.php");
include("header2.php");

$sql = "SELECT * FROM contact_messages";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Contact Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            th {
                position: sticky;
                top: 0;
            }
            td {
                padding-left: 50%;
                position: relative;
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 15px;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>

<h2>Contact Messages</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td data-label="ID"><?= $row['id']; ?></td>
                    <td data-label="Name"><?= htmlspecialchars($row['name']); ?></td>
                    <td data-label="Email"><?= htmlspecialchars($row['email']); ?></td>
                    <td data-label="Subject"><?= htmlspecialchars($row['subject']); ?></td>
                    <td data-label="Message"><?= nl2br(htmlspecialchars($row['message'])); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No messages found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>


