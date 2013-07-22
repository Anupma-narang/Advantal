<?php

function print_boolean($value) {
    return $value ? '<img src="/sf/sf_admin/images/tick.png" alt="si" />' : '<img src="/sf/sf_admin/images/cancel.png" alt="no" />';
}

function print_boolean_ok($value) {
    return $value ? '<img src="/sf/sf_admin/images/tick.png" alt="si" />' : '';

}