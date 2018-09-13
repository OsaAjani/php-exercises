<?php
function searchWord ($board, $str)
{
    $possibilities = [];

    #Create first possibilty
    foreach ($board as $board_line_index => $board_line)
    {
        $board_column_indexes = array_keys($board_line, $str[0]);
        foreach ($board_column_indexes as $board_column_index)
        {
            $possibilities[] = [
                'path' => [[$board_line_index, $board_column_index]],
            ];
        }
    }

    $original_str = $str;
    $str = mb_strcut($str, 1); #Remove first letter to not recalculate

    #Recalculate possibilities for each letter
    foreach (str_split($str) as $current_str)
    {
        $new_possibilities = [];
        foreach ($possibilities as $key => $possibility)
        {
            $line_index = end($possibility['path'])[0];
            $column_index = end($possibility['path'])[1];
            
            $line_up = $board[$line_index - 1][$column_index] ?? false;
            $line_up_index = [$line_index - 1, $column_index];
            if ($line_up == $current_str && !in_array($line_up_index, $possibility['path']))
            {
                $new_possibility = $possibility;
                $new_possibility['path'][] = $line_up_index;
                $new_possibilities[] = $new_possibility;
            }


            $line_down = $board[$line_index + 1][$column_index] ?? false;
            $line_down_index = [$line_index + 1, $column_index];
            if ($line_down == $current_str && !in_array($line_down_index, $possibility['path']))
            {
                $new_possibility = $possibility;
                $new_possibility['path'][] = $line_down_index;
                $new_possibilities[] = $new_possibility;
            }


            $column_left = $board[$line_index][$column_index - 1] ?? false;
            $column_left_index = [$line_index, $column_index - 1];
            if ($column_left == $current_str && !in_array($column_left_index, $possibility['path']))
            {
                $new_possibility = $possibility;
                $new_possibility['path'][] = $column_left_index;
                $new_possibilities[] = $new_possibility;
            }


            $column_right = $board[$line_index][$column_index + 1] ?? false;;
            $column_right_index = [$line_index, $column_index + 1];
            if ($column_right == $current_str && !in_array($column_right_index, $possibility['path']))
            {
                $new_possibility = $possibility;
                $new_possibility['path'][] = $column_right_index;
                $new_possibilities[] = $new_possibility;
            }
        }

        #Replace all possibilities by new onces
        $possibilities = $new_possibilities;
    }

    #Retourne true si on a des possibilities, false else
    return (bool) count($possibilities);
}
