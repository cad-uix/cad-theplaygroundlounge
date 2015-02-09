<table> 
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="play_date">Date of Game</label>
        </th>
        <td>
            <input type="date" id="play_date" name="play_date" value="<?php echo @get_post_meta($post->ID, 'play_date', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="play_date">Time of Game</label>
        </th>
        <td>
            <input type="time" id="play_time" name="play_time" value="<?php echo @get_post_meta($post->ID, 'play_time', true); ?>" />
        </td>
    </tr>

    <tr valign="top">

        <td colspan="">
        <b>Player List</b>
            
        
    <?php
        // $player_list = @get_post_meta($post->ID, 'player_list', true);  

        // echo $player_list;


        $player_list_get = str_replace("'",'"', @get_post_meta($post->ID, 'player_list', true) );

        $player_list = json_decode('['.$player_list_get.']');

        //print_r($player_list) ;

        echo "<ul>";
        foreach ($player_list as $var) {
            echo "<li>";
            echo "User: ", $var[0], " <br> Chair: ", $var[1];
            echo "</li>";
        }
        echo "</ul>";

    ?>
        
        </td>
    
    </tr>           
</table>
