<?php
function validate($field, $reserved_keywords) {
    $is_valid = true;
    if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $field)) {
        $field_parts = preg_split('/\s+/', $field);
        foreach ($field_parts as $part) {
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


function sanitize_form($form) {
    $reserved_keywords = ['select','distinct','where','and','or','not','order by', 'insert into', 'null', 'update', 'delete', 'top', 'min', 'count', 'avg', 'sum', 'like', 'in',
                        'between', 'join', 'inner', 'left', 'right', 'full', 'self', 'union', 'group', 'having', 'exists', 'any', 'all', 'create', 'drop', 'alter', 'unique',
                         'primary', 'foreign', 'check', 'default' ,'index' ,'increment'];
    foreach($form as $key => $value) {
        $simple_field = strtolower(trim($value));
        if (validate($simple_field, $reserved_keywords)) {
            $form[$key] = $simple_field;
        } else {
            $form = [];
            break;
        }
    }
    return $form;
}
?>














































 ?>
