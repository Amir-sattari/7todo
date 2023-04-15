<?php

# *** FOLDERS FUNCTION***

function getFolders()
{
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "SELECT * FROM folders where user_id = $current_user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

function addFolder($folder_name)
{
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "INSERT INTO folders (name,user_id) VALUES (:name, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name' => $folder_name,':user_id' =>  $current_user_id]);
    return $stmt->rowCount();
}

function deleteFolder($folder_id)
{
    global $pdo;
    $sql = "DELETE from folders WHERE id = $folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

# *** TASKS FUNCTION***

function getTasks()
{
    global $pdo;
    $folder = $_GET['folder_id'] ?? null;
    $folderCondition = '';
    if(isset($folder) and is_numeric($folder)){
        $folderCondition = "and folder_id=$folder";
    }

    $current_user_id = getCurrentUserId();
    $sql = "select * from tasks where user_id = $current_user_id $folderCondition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

function addTask($taskTitle, $folderId)
{
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "INSERT INTO tasks (title, user_id, folder_id) VALUES (:title, :user_id, :folder_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':title' => $taskTitle,':user_id' =>  $current_user_id,':folder_id' =>  $folderId]);
    return $stmt->rowCount();
}

function deleteTask($task_id)
{
    global $pdo;
    $sql = "DELETE from tasks WHERE id = $task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function doneSwitch($task_id){
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "UPDATE tasks SET is_done = 1-is_done WHERE user_id = :userID AND id = :taskID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':userID' => $current_user_id, ':taskID' => $task_id]);
    return $stmt->rowCount();
}

function dd($var)
{
    echo "<pre style='color: #9c4100; background: beige; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border-left: 3px solid #c9870e'>";
    var_dump($var);
    echo "</pre>";
}