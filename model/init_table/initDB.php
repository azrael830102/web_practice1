<?php

   require (dirname(dirname(__FILE__))."/config.php");
    $host = 'localhost:3308';
    $user = 'root';
    $passwd = '';
    $database = 'summerpractice';
    $conn = mysqli_connect($host, $user, $passwd);
//    echo $host." connected.<br>";
    $sql_query="SELECT SCHEMA_NAME
                FROM INFORMATION_SCHEMA.SCHEMATA
                WHERE SCHEMA_NAME = '$database'";
    $result = $conn->query($sql_query);
    if(!mysqli_num_rows ($result)){  
        $sql_create_db="CREATE DATABASE $database";
        $conn->query($sql_create_db);
    }
    mysqli_select_db ($conn,$database);
//    echo $database." connected.<br>";

    //check table members
    $sql_query = "SELECT * 
                  FROM information_schema.tables
                  WHERE table_schema = '$database' 
                  AND table_name = '$tb_members'";
    $result = $conn->query($sql_query);
    if(!mysqli_num_rows ($result)){  
        $sql_create_members = "CREATE TABLE $tb_members (
                                $col_account varchar(50) NOT NULL UNIQUE,
                                $col_username varchar(100),
                                $col_password varchar(50),
                                $col_gender int(11),
                                $col_color varchar(50)
                                )";
        $result = $conn->query($sql_create_members);
    }
//    echo $tb_members." created.<br>";

    //check table members_files
    $sql_query = "SELECT * 
                  FROM information_schema.tables
                  WHERE table_schema = '$database' 
                  AND table_name = '$tb_members_files'";
    $result = $conn->query($sql_query);
    if(!mysqli_num_rows ($result)){  
        $sql_create_members = "CREATE TABLE $tb_members_files (
                                $col_file_id varchar(20) NOT NULL UNIQUE,
                                $col_file_name varchar(200),
                                $col_file_size varchar(50),
                                $col_upload_time timestamp,
                                $col_owner varchar(50)
                                )";
        $result = $conn->query($sql_create_members);
    }
//    echo $tb_members_files." created.<br>";

    //check table members_topic
    $sql_query = "SELECT * 
                  FROM information_schema.tables
                  WHERE table_schema = '$database' 
                  AND table_name = '$tb_members_topic'";
    $result = $conn->query($sql_query);
    if(!mysqli_num_rows ($result)){
        $sql_tb_members_topic = "CREATE TABLE $tb_members_topic (
                                $col_topic_id VARCHAR(20) NOT NULL UNIQUE, 
                                $col_topic_poster_id VARCHAR(50) NOT NULL ,
                                $col_topic_poster VARCHAR(50) NOT NULL , 
                                $col_topic_title VARCHAR(200) NOT NULL ,
                                $col_topic_content VARCHAR(500) NOT NULL,
                                $col_last_reply_id VARCHAR(20), 
                                $col_topic_update_time TIMESTAMP NOT NULL , 
                                $col_topic_create_time TIMESTAMP NOT NULL
                                )";
        $result = $conn->query($sql_tb_members_topic);
    }
//    echo $tb_members_topic." created.<br>";

 //check table members_topic
    $sql_query = "SELECT * 
                  FROM information_schema.tables
                  WHERE table_schema = '$database' 
                  AND table_name = '$tb_members_topic_reply'";
    $result = $conn->query($sql_query);
    if(!mysqli_num_rows ($result)){
        $sql = "CREATE TABLE $tb_members_topic_reply (
              $col_topic_reply_id VARCHAR(20) NOT NULL UNIQUE, 
              $col_topic_id VARCHAR(50) NOT NULL ,
              $col_replier_id VARCHAR(50) NOT NULL , 
              $col_replier VARCHAR(200) NOT NULL ,
              $col_reply_content VARCHAR(500) NOT NULL , 
              $col_reply_update_time TIMESTAMP NOT NULL , 
              $col_reply_create_time TIMESTAMP NOT NULL
              )";
        $result = $conn->query($sql);
    }
//    echo $tb_members_topic_reply." created.<br>";

    $conn ->close();
?>
