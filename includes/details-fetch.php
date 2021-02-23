<?php
    $id=intval('1');
    $query=mysqli_query($conn, "select * from details where id='$id'");
    while ($row=mysqli_fetch_array($query)) { 
        $emailData = $row['email'];
        $phoneData = $row['phone'];
        $mobileData = $row['mobile'];
        $addressData = $row['address'];
        $designed_byData = $row['designed_by'];
        $designed_by_urlData = $row['designed_by_url'];
        $developed_byData = $row['developed_by'];
        $developed_by_urlData = $row['developed_by_url'];
        $imageData = $row['image'];
    }
?>

<?php
    $id=intval('1');
    $query=mysqli_query($conn, "select * from home_page where id='$id'");
    while ($row=mysqli_fetch_array($query)) { 
        $homeImage = $row['image'];
        $homeName = $row['name'];
        $homeSkill = $row['short_skill'];
    }
?>
