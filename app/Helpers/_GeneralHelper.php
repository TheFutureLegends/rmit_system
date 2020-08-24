<?php

use App\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Modules\Backend\Clubs\Models\Clubs;

if (!function_exists('set_full_request_class')) {

    function set_full_request_class($path, $class)
    {
        return call_user_func_array('Request::is', (array) $path) ? $class : '';
    }
}

if (!function_exists('thousandsFormat')) {
    function thousandsFormat($num)
    {

        if ($num > 1000) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= ' ' . $x_parts[$x_count_parts - 1];

            return $x_display;

        }

        return $num;
    }
}

if (!function_exists('split_sentence')) {
    function split_sentence($input, int $len, string $end)
    {
        $str = $input;
        if (strlen($input) > $len) {
            $str = explode("\n", wordwrap($input, $len));
            $str = $str[0] . $end;
        }

        return $str;
    }
}

if (!function_exists('format_string')) {
    function format_string(string $string)
    {
        // Replaces all hyphens with space.
        $string = str_replace('-', ' ', $string);

        // Removes special chars.
        return preg_replace('/[^a-zA-Z0-9_.]/', ' ', ucwords($string));
    }
}

if (!function_exists('words')) {
    /**
     * Limit the number of words in a string.
     *
     * @param  string  $value
     * @param  int     $words
     * @param  string  $end
     * @return string
     */
    function words($value, $words = 100, $end = '...')
    {
        return Str::words(html_entity_decode(strip_tags($value)), $words, $end);
    }
}

if (!function_exists('check_even_integer')) {
    function check_even_integer(int $num)
    {
        return ($num % 2 == 0) ? true : false;
    }
}

if (!function_exists('render_conditional_class')) {
    function render_conditional_class($condition, $class, $sub_class)
    {
        return ($condition) ? $class : $sub_class;
    }
}

if (!function_exists('loadSelectedRole')) {
    function loadSelectedRole(array $roles)
    {
        $result = '';

        foreach ($roles as $key => $value) {
            $role = Role::query()
            ->where([
                ['name', '=', $value]
            ])
            ->first();

            $result .= '<option value="'.$role->id.'" selected="selected">'.format_string($role->name).'</option>';
        }

        return trim($result);
    }
}

if (!function_exists('loadSelectedPermission')) {
    function loadSelectedPermission(array $permissions)
    {
        $result = '';

        foreach ($permissions as $key => $value) {
            $permission = Permission::query()
            ->where([
                ['name', '=', $value]
            ])
            ->first();

            $result .= '<option value="'.$permission->id.'" selected="selected">' . ucwords(implode(" ", explode(".", $permission->name))) . '</option>';
        }

        return $result;
    }
}

if (!function_exists('loadSelectedUser')) {
    function loadSelectedUser($user_id)
    {
        $user = User::find($user_id);

        $result = '<option value="'.$user->id.'" selected="selected">'.$user->email.'</option>';

        return $result;
    }
}

if (!function_exists('loadSelectedClub')) {
    function loadSelectedClub($club_id)
    {
        $club = Clubs::find($club_id);

        return '<option value="'.$club->id.'" selected="selected">'.format_string($club->name).'</option>';
    }
}
