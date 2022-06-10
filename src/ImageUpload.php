<?php

class ImageUpload
{

    /**
     * The base directory for uploaded files to reside
     */
    const UPLOAD_DIRECTORY = __DIR__ . '/../public/images/';

    /**
     * An array of allowed file types
     *
     * @var array
     */
    private $allowed_types = array(
        'image/jpeg',
        'image/png',
        'image/gif'
    );

    /**
     * name of the file being uploaded
     *
     * @var string
     */
    private $filename;

    /**
     * temporary name / path of the file being uploaded
     *
     * @var string
     */
    private $tmp_name;

    /**
     * Type of the file being uploaded
     *
     * @var string
     */
    private $file_type;

    /**
     * Size of file being uploaded
     *
     * @var int
     */
    private $size = 0;

    /**
     * True if file has been successfully uploaded
     *
     * @var bool
     */
    private $uploaded = false;


    /**
     * ImageUpload constructor ♥
     *
     * @param array $file
     * @throws Exception
     */
    public function __construct($file)
    {
        if (false === isset($file['name'], $file['tmp_name'], $file['type'], $file['size'], $file['error'])) {
            throw new Exception('Missing file data. Does parameter come from the $_FILES super global?');
        }

        if (false === in_array($file['type'], $this->getAllowedTypes())) {
            throw new Exception('File type not allowed.');
        }

        $this->filename = $file['name'];
        $this->tmp_name = $file['tmp_name'];
        $this->file_type = $file['type'];
        $this->size = $file['size'];
    }

    /**
     * Perform the upload
     *
     * @param string|null $folder
     * @return bool
     */
    public function upload($folder = null)
    {
        $path = $folder === null
            ? self::UPLOAD_DIRECTORY . $this->getFilename()
            : self::UPLOAD_DIRECTORY . $folder . '/' . $this->getFilename();

        $this->uploaded = @move_uploaded_file(
            $this->getTmpName(),
            $path
        );

        return $this->uploaded;
    }

    /**
     * @return array
     */
    public function getAllowedTypes()
    {
        return $this->allowed_types;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getTmpName()
    {
        return $this->tmp_name;
    }

    /**
     * @return string
     */
    public function getFileType()
    {
        return $this->file_type;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return bool
     */
    public function isUploaded()
    {
        return $this->uploaded;
    }
}