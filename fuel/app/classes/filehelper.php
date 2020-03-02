<?php

class Filehelper
{
    public static function upload()
    {
        // Custom config for file upload
        $config = [
            'path' => DOCROOT.'uploads',
            'randomize' => true,
            'ext_whitelist' => ['jpg', 'jpeg',
                                'doc', 'docx',
                                'xls', 'xlsx',
                                'ppt', 'pptx',
                                'pdf',
                                'bmp',
                                'gif',
                                'png'
            ],
        ];

        try {
            // process the uploaded files in $_FILES
            Upload::process($config);
            // if there are any valid files
            if (Upload::is_valid())
            {
                // try {
                    // save them according to the config
                    Upload::save();
                    // get uploaded file info
                    $file = Upload::get_files(0);
                    // Kint::dump($file); exit;
                    File::rename(DOCROOT.'uploads'.DS.$file['saved_as'], DOCROOT.'uploads'.DS.$file['name']);
                    return $file;
                // }
                // catch (DomainException $e) {
                //     return $e->getMessage();
                // }
            }
            // else
            return Upload::get_errors(0);
        }
        catch (Fuel\Upload\NoFilesException $e)
        {
			Session::set_flash('error', $e->getMessage());
        }
    }

    public static function save_upload_files($file_name, $file_path = null, $user_id = null)
    {
        $res = self::forge([
            'name' => $file_name,
            'published' => 0,
            'description' => '',
            'res_path' => $file_path,
            'res_type' => $file_type,
            'user_id' => $user_id,
        ]);

        if ($res and $res->save())
        {
            Session::set_flash('success', 'Added resource #'.$res->id.'.');
            return $res->id;
        }
        else
        {
            Session::set_flash('error', 'Could not save resource.');
        }
        return null;
    }
}
