<{{ $data['wildcard'] }}php

// Specify the folders to be zipped in an array.
$foldersToZip = "{{ implode(',',$local_folders) }}";

// Define the name of the zip file and the backup folder.
$zipFileName = 'backup-'.time().'.zip';
$backupFolder = 'zbackup/';

// Create a new zip archive.
$zip = new ZipArchive();
if ($zip->open($zipFileName, ZipArchive::CREATE) !== TRUE) {
    exit("Cannot open <$zipFileName>\n");
}

// Function to recursively add files and folders to the zip archive.
function addFolderToZip($folder, &$zip, $zipFolderPath) {
    if (is_dir($folder)) {
        $dirHandle = opendir($folder);
        while (false !== ($file = readdir($dirHandle))) {
            if ($file != '.' && $file != '..') {
                $filePath = $folder . '/' . $file;
                $localPath = $zipFolderPath . '/' . $file;
                if (is_file($filePath)) {
                    $zip->addFile($filePath, $localPath);
                } elseif (is_dir($filePath)) {
                    $zip->addEmptyDir($localPath);
                    addFolderToZip($filePath, $zip, $localPath);
                }
            }
        }
        closedir($dirHandle);
    }
}

// Add the folders and their contents to the zip archive.
foreach (explode(',',$foldersToZip) as $folder) {
    if (is_dir($folder)) {
        $zip->addEmptyDir($folder);
        addFolderToZip($folder, $zip, $folder);
    }
}

// Close the zip archive.
$zip->close();

// Move the zip file to the backup folder.
if (!file_exists($backupFolder)) {
    mkdir($backupFolder, 0755, true);
}
rename($zipFileName, $backupFolder . $zipFileName);

echo "Backup created successfully!";




?>
