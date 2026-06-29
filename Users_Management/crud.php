<?php

include 'db.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if($action=="create")
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $dob=$_POST['dob'];
    $phone=$_POST['phone'];
    $country=$_POST['country'];
    $terms=$_POST['terms'];

    $sql="INSERT INTO users (name,email,password,dob,phone,country,terms)
    VALUES
    ('$name','$email','$password','$dob','$phone','$country','$terms')";

    mysqli_query($conn,$sql);

    header("Location: crud.php");
    exit();
}

if($action=="delete")
{
    $id=$_GET['id'];

    mysqli_query($conn,"DELETE FROM users WHERE id=$id");

    header("Location: crud.php");
    exit();
}

if($action=="update")
{
    $id=$_POST['id'];

    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $dob=$_POST['dob'];
    $phone=$_POST['phone'];
    $country=$_POST['country'];
    $terms="Accepted";

    $sql="UPDATE users
    SET
    name='$name',
    email='$email',
    password='$password',
    dob='$dob',
    phone='$phone',
    country='$country',
    terms='$terms'
    WHERE id=$id";

    mysqli_query($conn,$sql);

    header("Location: crud.php");
    exit();
}

if($action=="edit")
{
    $id=$_GET['id'];

    $result=mysqli_query($conn,"SELECT * FROM users WHERE id=$id");

    $row=mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>Edit User</h2>

<form id="userForm" action="crud.php?action=update" method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<label>Name</label>
<input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
<span class="error" id="nameError"></span>

<label>Email</label>
<input type="text" id="email" name="email" value="<?php echo $row['email']; ?>">
<span class="error" id="emailError"></span>

<label>Password</label>
<input type="password" id="password" name="password" value="<?php echo $row['password']; ?>">
<span class="error" id="passwordError"></span>

<label>Confirm Password</label>
<input type="password" id="confirm_password" name="confirm_password" value="<?php echo $row['password']; ?>">
<span class="error" id="confirmError"></span>

<label>Date of Birth</label>
<input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>">
<span class="error" id="dobError"></span>

<label>Phone Number</label>
<input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>">
<span class="error" id="phoneError"></span>

<label>Country</label>
<select id="country" name="country">
<option value="">Select Country</option>
<option value="Bangladesh" <?php if($row['country']=="Bangladesh") echo "selected"; ?>>Bangladesh</option>
<option value="India" <?php if($row['country']=="India") echo "selected"; ?>>India</option>
<option value="Pakistan" <?php if($row['country']=="Pakistan") echo "selected"; ?>>Pakistan</option>
<option value="Nepal" <?php if($row['country']=="Nepal") echo "selected"; ?>>Nepal</option>
<option value="USA" <?php if($row['country']=="USA") echo "selected"; ?>>USA</option>
</select>
<span class="error" id="countryError"></span>

<label class="terms">
<input type="checkbox" id="terms" name="terms" value="Accepted" checked>
I accept Terms & Conditions
</label>
<span class="error" id="termsError"></span>

<button type="submit">Update User</button>

<p id="successMsg"></p>

</form>

<a href="crud.php">Back to User List</a>

</div>

<script src="script.js"></script>

</body>
</html>

<?php
exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User List</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<h2>User List</h2>

<a href="index.html">Add New User</a>
<br><br>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Password</th>
<th>DOB</th>
<th>Phone</th>
<th>Country</th>
<th>Terms</th>
<th>Action</th>
</tr>

<?php

$result=mysqli_query($conn,"SELECT * FROM users");

while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['password']; ?></td>
<td><?php echo $row['dob']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['country']; ?></td>
<td><?php echo $row['terms']; ?></td>

<td>
<a href="crud.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>
|
<a href="crud.php?action=delete&id=<?php echo $row['id']; ?>">Delete</a>
</td>

</tr>

<?php
}
?>

</table>

</body>
</html>