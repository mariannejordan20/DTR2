<?php include 'connection.php';    

$sql = "SELECT * FROM `admin_accounts` ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $output .= '
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Fullname</th>
                </tr>
            </thead>';
    while($row = mysqli_fetch_array($result)){
        $output .= '
            <tr>
            <td>'.$row["username"].'</td>
            <td>'.$row["password"].'</td>
            <td>'.$row["fullname"].'</td>
            </tr>
        ';
    }
    $output .= '</table>';
    header("content-type: application/xls");
    header("content-disposition: attachment, filename:AdminAccoutLists.xls");
    echo $output;
}

mysqli_close($conn);
?> 