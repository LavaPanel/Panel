<?php
class JsonConfig
{
    function __construct()
    {
        $this->json = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/storage/config.json"), true);
    }

    /**
     * @param $path
     * @return mixed
     * @throws ElementNotFoundException
     */
    function getObject($path) {
        $elements = explode(".", $path);

        $currentObj = $this->json;

        foreach ($elements as $elm) {
            if(array_key_exists($elm, $currentObj)) {
                $currentObj = $currentObj[$elm];
            } else {
                throw new ElementNotFoundException("Config element not found", $path);
            }
        }

        return $currentObj;
    }

    /**
     * @param $path
     * @return boolean|null
     * @throws ElementNotFoundException
     * @throws ElementTypeMismatchException
     */
    function getBoolean($path)
    {
        $currentObj = $this->getObject($path);

        if(!is_bool($currentObj)) {
            throw new ElementTypeMismatchException("Element types mismatch", $path);
        } else {
            return $currentObj;
        }
    }

}

class ElementNotFoundException extends Exception {
    public function __construct(string $message = "", $path, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message . " at path " . $path, $code, $previous);
    }
}

class ElementTypeMismatchException extends Exception {
    public function __construct(string $message = "", $path, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message . " at path " . $path, $code, $previous);
    }
}