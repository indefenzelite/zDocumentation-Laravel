<{{ $data['wildcard'] }}php

// Specify the folders to be deleted in an array.
$foldersToDelete = "{{ implode(',',$local_folders) }}";

// Function to recursively delete folders and their contents.
function deleteFolder($folder) {
    if (is_dir($folder)) {
        $dirHandle = opendir($folder);
        while (false !== ($file = readdir($dirHandle))) {
            if ($file != '.' && $file != '..') {
                $filePath = $folder . '/' . $file;
                if (is_file($filePath)) {
                    unlink($filePath);
                } elseif (is_dir($filePath)) {
                    deleteFolder($filePath);
                }
            }
        }
        closedir($dirHandle);
        rmdir($folder);
    }
}

// Delete the specified folders.
foreach (explode(',',$foldersToDelete) as $folder) {
    deleteFolder($folder);
}

// Define the path to the backup file.
// $backupFilePath = 'deploy_backup_20230401_095454.zip';
$backupFilePath = "{{ $remote_zip_path }}";
// Unzip the backup file maintaining the structure.
if (file_exists($backupFilePath)) {
    $zip = new ZipArchive();
    if ($zip->open($backupFilePath) === TRUE) {
      
        
        
         $numFiles = $zip->numFiles;
    
        // Loop through each file in the zip
        for ($i = 0; $i < $numFiles; $i++) {
    
            // Get the name of the file
            $fileName = $zip->getNameIndex($i);
            $path = str_replace(basename(str_replace('\\','/',$fileName)),'',str_replace('\\','/',$fileName));
       
                $zip->extractTo($path, $fileName);
        
            // Get the full path of the extracted file
            $extractedFilePath = $path . $fileName;
    
            // Rename the extracted file
            $newName = basename(str_replace('\\','/',$fileName));
            $newPath = $path . $newName;
            rename($extractedFilePath, $newPath);
    
        }
        
        
        
        $zip->close();
        echo "Backup file has been extracted!";
    } else {
        echo "Cannot open the backup file!";
    }
} else {
    echo "Backup file not found!";
}
?>
