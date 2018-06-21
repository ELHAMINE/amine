<?php
/**
 * @param array $data array of data ($_GET, $_POST, ...).
 * @param array $keys array of keys.
 * @return boolean $all true: must all exists, false: at least one.
 */
function inArray($keys, $data, $all = true, $strict = false) {

    if(count($keys) === 0)
        return false;

    foreach($keys as $key) {
        if($all === true) {
            if(!in_array($key, $data, $strict) && !isset($data[$key])) {
                return false;
            }
        }
        else {
            if(in_array($key, $data, $strict) || isset($data[$key])) {
                return true;
            }
        }
    }

    return true;
}
?>