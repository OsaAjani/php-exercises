<?php
    function sortZeros ($array) 
    {
        $normal_array = [];
        $zeros_array = [];

        foreach ($array as $value)
        {
            if ($value === '0' or $value === 0)
            {
                $zeros_array[] = $value;
            }
            else
            {
                $normal_array[] = $value;
            }
        }

        return array_merge($normal_array, $zeros_array);
    }
