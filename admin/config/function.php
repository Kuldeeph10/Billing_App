<?php
session_start();

require 'dbconnect.php';

// input field validation
function validate($inputData)
{
    global $conn;
    $validatedData = mysqli_real_escape_string($conn, $inputData);
    return trim($validatedData);
}

// redirect from 1 page to another page with tha message (status)
function redirect($url, $status)
{
    $_SESSION['status'] = $status;
    header('location: ' . $url);
    exit(0);
}

// Display message or status after any process 
function alertmessage()
{
    if (isset($_SESSION['status'])) {
        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
             <h6>' . $_SESSION['status'] . '</h6>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['status']);
    }
}

// insert record using this function 
function insert($tableName, $data)
{
    global $conn;
    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'" . implode("','", $values) . "'";

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

// update data using this function 
function update($tableName, $id, $data)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = "";
    foreach ($data as $column => $value) {
        $updateDataString .= $column . '=' . "'$value',";
    }

    $finalUpdateData = substr(trim($updateDataString), 0, -1);

    $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

//  all data geting function
function getAll($tableName, $status = NULL)
{
    global $conn;

    $table = validate($tableName);
    $status = validate($status);
    if ($status == 'status') {
        $query = "SELECT * FROM $table WHERE status='0' ";
    } else {
        $query = "select * FROM $table";
    }
    return mysqli_query($conn, $query);
}

//  geting each data 
function getById($tableName, $id)
{
    global $conn;
    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $respons = [
                'status' => 403,
                'dta' => $row,
                'message' => 'Record Found!'
            ];
            return $respons;
        } else {
            $respons = [
                'status' => 404,
                'message' => 'No Data Found!!'
            ];
            return $respons;
        }
    } else {
        $respons = [
            'status' => 500,
            'message' => 'Something went Wrong!!'
        ];
        return $respons;
    }
}

// delete data  from data base using id 
function delete($tableName, $id)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

?>