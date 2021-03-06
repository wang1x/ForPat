<?php
$options = array(
    'delete_type' => 'POST',
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => '12345',
    'db_name' => 'cms',
    'db_table' => 'files'
);

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
require_once("../class.mysql.php");

class CustomUploadHandler extends UploadHandler {

	protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
			$index = null, $content_range = null) {
		$file = parent::handle_file_upload(
				$uploaded_file, $name, $size, $type, $error, $index, $content_range
				);
		if (empty($file->error)) {
			/*
			   $sql = 'INSERT INTO `'.$this->options['db_table']
			   .'` (`name`, `size`, `type`, `title`, `description`)'
			   .' VALUES (?, ?, ?, ?, ?)';
			   $query = $this->db->prepare($sql);
			   $query->bind_param(
			   'sisss',
			   $file->name,
			   $file->size,
			   $file->type,
			   $file->title,
			   $file->description
			   );
			   $query->execute();
			   $file->id = $this->db->insert_id;
			   }
			 */
		global $mydb;
		$sql = "INSERT INTO files(name, size, type)
			VALUES('".$file->name."','".$file->size."','".$file->type."');";
		$query = $mydb->query($sql);
	}
	return $file;
}
/*
    protected function set_additional_file_properties($file) {
        parent::set_additional_file_properties($file);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $sql = 'SELECT `id`, `type`, `title`, `description` FROM `'
                .$this->options['db_table'].'` WHERE `name`=?';
            $query = $this->db->prepare($sql);
            $query->bind_param('s', $file->name);
            $query->execute();
            $query->bind_result(
                $id,
                $type,
                $title,
                $description
            );
            while ($query->fetch()) {
                $file->id = $id;
                $file->type = $type;
                $file->title = $title;
                $file->description = $description;
            }
        }
    }
*/

    public function delete($print_response = true) {
        $response = parent::delete(false);
        foreach ($response as $name => $deleted) {
            if ($deleted) {
                $sql = 'DELETE FROM `'
                    .$this->options['db_table'].'` WHERE `name`=?';
                $query = $this->db->prepare($sql);
                $query->bind_param('s', $name);
                $query->execute();
            }
        } 
        return $this->generate_response($response, $print_response);
    }

}

$upload_handler = new CustomUploadHandler($options);
