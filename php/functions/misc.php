<?php
$reserved_keywords = ['select','distinct','where','and','or','not','order by', 'insert into', 'null', 'update', 'delete', 'top', 'min', 'count', 'avg', 'sum', 'like', 'in',
                    'between', 'join', 'inner', 'left', 'right', 'full', 'self', 'union', 'group', 'having', 'exists', 'any', 'all', 'create', 'drop', 'alter', 'unique',
                     'primary', 'foreign', 'check', 'default' ,'index' ,'increment'];

function validate($input) {
    $is_valid = true;
    $trimmed_input = trim($input);
    $lowercase_input = strtolower($trimmed_input);
    if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $lowercase_input)) {
        $input_parts = preg_split('/\s+/', $lowercase_input);
        foreach ($input_parts as $part) {
            if (in_array($part, $reserved_keywords)) {
                $is_valid = false;
                break;
            }
        }
    } else {
        $is_valid = false;
    }
    return $is_valid;
}
?>














































 ?>
