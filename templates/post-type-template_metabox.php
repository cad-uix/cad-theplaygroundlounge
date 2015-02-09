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
            <label for="player_list">Player List</label>
        </th>
        <td>
            <input type="text" id="player_list" name="player_list" value="<?php echo @get_post_meta($post->ID, 'player_list', true); ?>" />
        </td>
    </tr>           
</table>
