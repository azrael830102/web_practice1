<?php

   require (dirname(dirname(__FILE__))."/config.php");
    $host = 'localhost:3308';
    $user = 'root';
    $passwd = '';
    $database = 'summerpractice';
    $conn = mysqli_connect($host, $user, $passwd);
    echo $host." connected.<br>";
    $tb_members = 'members';
    $tb_members_files = 'members_files';

    $sql_query="SELECT SCHEMA_NAME
                FROM INFORMATION_SCHEMA.SCHEMATA
                WHERE SCHEMA_NAME = '$database'";
    $result = $conn->query($sql_query);
    if(!mysqli_num_rows ($result)){  
        $sql_create_db="CREATE DATABASE $database";
        $conn->query($sql_create_db);
    }
    mysqli_select_db ($conn,$database);
    echo $database." connected.<br>";
        
    $sql_query = "SELECT * 
                  FROM information_schema.tables
                  WHERE table_schema = '$database' 
                  AND table_name = '$tb_members'";
    $result = $conn->query($sql_query);
    if(!mysqli_num_rows ($result)){  
        $sql_create_members = "CREATE TABLE $tb_members (
                                $tb_username varchar(100),
                                $tb_account varchar(50),
                                $tb_password varchar(50),
                                $tb_gender int(11),
                                $tb_color varchar(50)
                                )";
        $result = $conn->query($sql_create_members);
    }

    $sql_query = "SELECT * 
                  FROM information_schema.tables
                  WHERE table_schema = '$database' 
                  AND table_name = '$tb_members_files'";
    $result = $conn->query($sql_query);
    if(!mysqli_num_rows ($result)){  
        $sql_create_members = "CREATE TABLE $tb_members_files (
                                $tb_file_id varchar(20),
                                $tb_file_name varchar(200),
                                $tb_file_size varchar(50),
                                $tb_upload_time timestamp,
                                $tb_owner varchar(50)
                                )";
        $result = $conn->query($sql_create_members);
    }
    $conn ->close();
?>
