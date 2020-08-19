<?php

//msg config
	$account_create_failed_msg = 'Account create failed!';
    $account_create_successed_msg = 'New account create successfully!';
    $account_is_exist_msg = 'Account is already registered!';
	$account_update_failed_msg = 'Update failed!';
	$account_update_successed_msg = 'Update successfully!';

    $confirm_to_delete_msg = 'Are you sure you want to delete this record?';
	
	$file_delete_failed_msg = "Can not delete the file.";
	$file_delete_successed_msg = "File is deleted.";
	
	$file_rename_failed_msg = "File rename failed.";
	$file_rename_successed_msg = "File rename successed.";
	
	$file_upload_failed_msg = 'File upload failed!';
	$file_upload_successed_msg = 'File upload successfully!';
	$file_upload_exisits_msg = 'The file exists!';
	
	$file_missing_msg = 'File is missing';
	
    $loginfailed_msg = 'Login failed!';
	
    $password_inconsistent_msg = 'Password inconsistent!';
    $password_incorrect = 'Password is incorrect!';

    $topic_create_successed_msg = "New topic posted successfully!";
    $topic_create_failed_msg = "New topic posted failed.";
    $topic_update_failed_msg = 'Topic update failed!';
	$topic_update_successed_msg = 'Update successfully!';
    $topic_delete_failed_msg = 'Topic delete failed!';
	$topic_delete_successed_msg = 'Topic is deleted.!';

    $topic_reply_create_successed_msg = "New reply posted successfully!";
    $topic_reply_create_failed_msg = "New reply failed.";
    $topic_reply_update_failed_msg = 'Reply update failed!';
	$topic_reply_update_successed_msg = 'Update successfully!';
    $topic_reply_delete_failed_msg = 'Reply delete failed!';
	$topic_reply_delete_successed_msg = 'Topic is deleted.!';


//general parameter
	$upload_file_folder_path = "../../files/";
    
    $opertion_create = "Create";
    $opertion_modify = "Modify";
    $opertion_delete = "Delete";
    $opertion_download = "Download";
    $opertion_reply = "Reply";

//table name
	//$members
	$tb_members = 'members';
        $col_account = "account";
		$col_password = "password";
		$col_username = "username";
		$col_gender = "gender";
		$col_color = "color";
        $col_is_subscribe = "is_subscribe";

	//members_files
	$tb_members_files = "members_files";
		$col_file_id = "file_id";
		$col_file_name = "file_name";
		$col_file_size = "file_size";
		$col_upload_time = "upload_time";
		$col_owner = "owner";
            
    //members_topic
    $tb_members_topic = "members_topic";
        $col_topic_id = "topic_id";
        $col_topic_poster_id = "topic_poster_id";        
        $col_topic_poster = "topic_poster";
        $col_topic_title = "topic_title";
        $col_topic_content = "topic_content";
        $col_last_reply_id = "last_reply_id";
        $col_topic_update_time = "topic_update_time";
        $col_topic_create_time = "topic_create_time";

    //members_topic_reply
    $tb_members_topic_reply = "members_topic_reply";
        $col_topic_reply_id = "topic_reply_id"; 
        $col_pertain_topic_id = "pertain_topic_id";
        $col_replier_id = "replier_id";
        $col_replier = "replier";
        $col_reply_content = "reply_content";
        $col_reply_update_time = "reply_update_time";
        $col_reply_create_time = "reply_create_time";
?>