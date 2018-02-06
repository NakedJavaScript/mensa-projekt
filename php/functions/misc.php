<?php
function validate($field, $reserved_keywords) {
    $is_valid = true;
    $field_parts = preg_split('/\s+/', $field);
    if (count($field_parts)>1) {
        if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $field)) {
            foreach ($field_parts as $part) {
                echo $part;
                if (in_array($part, $reserved_keywords)) {
                    $is_valid = false;
                    break;
                }
            }
        } else {
            $is_valid = false;
        }
    }
    return $is_valid;
}


function sanitize_form($form) {
    $reserved_keywords = ['select','distinct','where','and','or','not','order by', 'insert into', 'null', 'update', 'delete', 'top', 'min', 'count', 'avg', 'sum', 'like', 'in',
                        'between', 'join', 'inner', 'left', 'right', 'full', 'self', 'union', 'group', 'having', 'exists', 'any', 'all', 'create', 'drop', 'alter', 'unique',
                         'primary', 'foreign', 'check', 'default' ,'index' ,'increment'];
    foreach($form as $key => $value) {
        echo $value;
        $simple_field = strtolower(trim($value));
        echo $simple_field;
        if (validate($simple_field, $reserved_keywords)) {
            $form[$key] = $value;
        } else {
            $form = [];
            break;
        }
    }
    return $form;
}
?>














































 ?>
