<?php
#
# DTN_Widget
#

class DTN_Widget extends WP_Widget
{

    protected $plugin_slug = null;

    function __construct()
    {
        $pa = Date_Today_Nepali::get_instance();
        $this->plugin_slug = $pa->get_plugin_slug();

        $opts = array(
            'classname' => 'dtn_widget',
            'description' => __('Date Today Nepali Widget', $this->plugin_slug)
        );


        $this->WP_Widget('dtn-date-display-widget', '[DTN]   ' . __('Date Display Widget', $this->plugin_slug), $opts);
    }

    function widget($args, $instance)
    {

        //
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $display_language = $instance['display_language'];
        $date_format = $instance['date_format'];
        $date_separator_value = $instance['date_separator'];
        //
        switch ($date_separator_value)
        {
            case 'space':
                $date_separator = ' ';
                break;
            case 'dash':
                $date_separator = '-';
                break;
            default:
                break;
        }

        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;
        //
        //die(plugin_dir_path( __FILE__ ));
        include(plugin_dir_path(__FILE__) . '../includes/nepali_calendar.php');
        include(plugin_dir_path(__FILE__) . '../includes/date_functions.php');
        $cal = new Nepali_Calendar();
        $date_arr = explode('-', date('Y-m-d'));
        //print_r($date_arr);
        $newd = $cal->eng_to_nep($date_arr[0], $date_arr[1], $date_arr[2]);

        if ($display_language == 'np')
        {
            $newd = convertToNepali($newd);
        }
        //print_r($newd);
        $today_date = "";
        switch ($date_format)
        {
            case 1:
                //21 04 2070
                $today_date .= $newd['date'] . $date_separator . $newd['month']. $date_separator . $newd['year'];
                break;
            case 2:
                //2070 21 04
                $today_date .= $newd['year'] . $date_separator . $newd['date'] . $date_separator . $newd['month'];
                break;
            case 3:
                //2070 04 21
                $today_date .= $newd['year'] . $date_separator . $newd['month'] . $date_separator . $newd['date'] ;
                break;
            case 4:
                //21 Shrawan 2070
                $today_date .= $newd['date'] . $date_separator . $newd['month_name'] . $date_separator . $newd['year'] ;
                break;
            case 5:
                //2070 Shrawan 21
                $today_date .= $newd['year'] . $date_separator . $newd['month_name'] . $date_separator . $newd['date'] ;
                break;
            case 6:
                //21 Shrawan 2070, Monday
                $today_date .= $newd['date'] . $date_separator . $newd['month_name'] . 
                    $date_separator . $newd['year']. ', ' . $newd['day'] ;
                break;
            case 7:
                //Monday, 21 Shrawan 2070
                $today_date .= $newd['day'] . ', '. $newd['date'] . $date_separator . $newd['month_name'] . 
                    $date_separator . $newd['year'] ;
                break;
            case 8:
                //2070 Shrawan 21, Monday
                $today_date .= $newd['year'] . $date_separator . $newd['month_name'] . $date_separator . $newd['date'] . ', ' . $newd['day'] ;
                break;
            case 9:
                //Monday, 2070 Shrawan 21
                $today_date .=  $newd['day'].', '.$newd['year'] . $date_separator . $newd['month_name'] . $date_separator . $newd['date'] ;
                break;

            default:
                break;
        }
        echo $today_date;
        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['display_language'] = strip_tags($new_instance['display_language']);
        $instance['date_format'] = strip_tags($new_instance['date_format']);
        $instance['date_separator'] = strip_tags($new_instance['date_separator']);
        return $instance;
    }

    function form($instance)
    {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $display_language = isset($instance['display_language']) ? esc_attr($instance['display_language']) : '';
        $date_format = isset($instance['date_format']) ? esc_attr($instance['date_format']) : '';
        $date_separator = isset($instance['date_separator']) ? esc_attr($instance['date_separator']) : '';
        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', $this->plugin_slug); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>	
        <p><?php _e('Display Language', $this->plugin_slug); ?> :
            <select id="<?php echo $this->get_field_id('display_language'); ?>" name="<?php echo $this->get_field_name('display_language'); ?>">
                <option value="np" <?php echo selected($display_language, 'np'); ?>><?php _e('Nepali', $this->plugin_slug); ?></option>
                <option value="en" <?php echo selected($display_language, 'en'); ?>><?php _e('English', $this->plugin_slug); ?></option>                    </select></p>
        <p><?php _e('Date Format', $this->plugin_slug); ?> :
            <select id="<?php echo $this->get_field_id('date_format'); ?>" name="<?php echo $this->get_field_name('date_format'); ?>">
                <option value="1" <?php echo selected($date_format, '1'); ?>>21 04 2070</option>
                <option value="2" <?php echo selected($date_format, '2'); ?>>2070 21 04</option>
                <option value="3" <?php echo selected($date_format, '3'); ?>>2070 04 21</option>
                <option value="4" <?php echo selected($date_format, '4'); ?>>21 Shrawan 2070</option>
                <option value="5" <?php echo selected($date_format, '5'); ?>>2070 Shrawan 21</option>
                <option value="6" <?php echo selected($date_format, '6'); ?>>21 Shrawan 2070, Monday</option>
                <option value="7" <?php echo selected($date_format, '7'); ?>>Monday, 21 Shrawan 2070</option>
                <option value="8" <?php echo selected($date_format, '8'); ?>>2070 Shrawan 21, Monday</option>
                <option value="9" <?php echo selected($date_format, '9'); ?>>Monday, 2070 Shrawan 21</option>

            </select></p>
        <p><?php _e('Date Separator', $this->plugin_slug); ?> :
            <select id="<?php echo $this->get_field_id('date_separator'); ?>" name="<?php echo $this->get_field_name('date_separator'); ?>">
                <option value="space" <?php echo selected($date_separator, 'space'); ?>>&nbsp; (<?php _e('Space', $this->plugin_slug); ?>)</option>
                <option value="dash" <?php echo selected($date_separator, 'dash'); ?>>- (<?php _e('Dash', $this->plugin_slug); ?>)</option>
            </select></p>
        <?php
    }

}
?>