<!DOCTYPE html>
<html>

<head>
    <title>Insert New Doctor Data</title>

</head>

<body>
    <form action="process_insert_doctor.php" method="POST">
        <h1>Technical details</h1>
        <!-- foto -->
        <label for="foto">Foto</label>
        <input type="text" name="foto" id="foto" required>
        <!-- spesialis -->
        <label for="spesialis">Spesialis</label>
        <input type="text" name="spesialis" id="spesialis" required>

        <h1>Biodata</h1>
        <!-- name -->
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        <!-- gender -->
        <p>Gender</p>
        <input type="radio" id="male" name="male" value="male">
        <label for="male">male</label><br>
        <input type="radio" id="female" name="female" value="female">
        <label for="female">female</label><br>
        <!-- DOB -->
        <label for="dob">DOB</label>
        <input type="date" name="dob" id="dob" required>
        <br>
        <!-- email -->
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <br>
        <!-- phone -->
        <label for="phone">Phone</label>
        <input type="tel" name="phone" id="phone" required>
        <br>
        <!-- address -->
        <label for="address">Address</label>
        <input type="text" name="address" id="address" required>

        <h1>Jadwal</h1>
        <!-- Hari -->
        <p>Available days</p>
        <input type="checkbox" id="sunday" name="days[]" value="0">
        <label for="sunday">Sunday</label><br>
        <input type="checkbox" id="monday" name="days[]" value="1">
        <label for="monday">Monday</label><br>
        <input type="checkbox" id="tuesday" name="days[]" value="2">
        <label for="tuesday">Tuesday</label><br>
        <input type="checkbox" id="wednesday" name="days[]" value="3">
        <label for="wednesday">Wednesday</label><br>
        <input type="checkbox" id="thursday" name="days[]" value="4">
        <label for="thursday">Thursday</label><br>
        <input type="checkbox" id="friday" name="days[]" value="5">
        <label for="friday">Friday</label><br>
        <input type="checkbox" id="saturday" name="days[]" value="6">
        <label for="saturday">Saturday</label><br>
        <!-- Jam -->
        <p>Available hours</p>
        <label for='start_time'>Start : </label>
        <input type="time" id="start_time" name="start_time" required>
        <label for='end_time'>End : </label>
        <input type="time" id="end_time" name="end_time" required>

        <button type="submit">Insert</button>
    </form>
</body>

</html>