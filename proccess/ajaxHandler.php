<?php
include_once "../bootstrap/init.php";

if (!isAjaxRequest()) {
    echo "invalid request!";
    die();
}

if (!isset($_POST['action']) || empty($_POST['action'])) {
    echo "invalid action!";
    die();
}

switch ($_POST['action']) {

    case "doneSwitch":

        $task_id = $_POST['taskId'];
        if (!isset($task_id) || !is_numeric($task_id)) {
            echo "Task id is not valid.";
            die();
        }

        doneSwitch($task_id);

        break;

    case "addFolder":
        if (!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3) {
            echo "folder name must bigger than 2 character.";
            die();
        }

        addFolder($_POST['folderName']);

        break;

    case "addTask":
        $folderId = $_POST['folderId'];
        $taskTitle = $_POST['taskTitle'];
        if (!isset($folderId) || empty($folderId)) {
            echo "select a folder please.";
            die();
        }
        if (!isset($taskTitle) || strlen($taskTitle) < 2) {
            echo "Task title must be bigger than 2 character.";
            die();
        }

        addTask($taskTitle, $folderId);
        break;

    default:
        echo "invalid action!";
        die();
}
